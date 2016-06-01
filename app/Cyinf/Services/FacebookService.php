<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/5/25
 * Time: 上午11:36
 */

namespace Cyinf\Services;
session_start();

use Carbon\Carbon;
use Cyinf\Repositories\CourseRepository;
use Cyinf\Repositories\NotificationRepository;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookApp;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Illuminate\Support\Facades\Log;

class FacebookService
{

    private $course_start_map = [
        'A' => '5:50',
        '1' => '7:00',
        '2' => '8:00',
        '3' => '9:00',
        '4' => '10:00',
        'B' => '11:00',
        '5' => '12:00',
        '6' => '13:00',
        '7' => '14:00',
        '8' => '15:00',
        '9' => '16:00',
        'C' => '17:10',
        'D' => '18:05',
        'E' => '19:00',
        'F' => '20:55',
    ];

    private $course_end_map = [
        'A' => '7:50',
        '1' => '9:00',
        '2' => '10:00',
        '3' => '11:00',
        '4' => '12:00',
        'B' => '13:00',
        '5' => '14:00',
        '6' => '15:00',
        '7' => '16:00',
        '8' => '17:00',
        '9' => '18:00',
        'C' => '19:10',
        'D' => '20:05',
        'E' => '21:00',
        'F' => '21:55',
    ];

    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * @var CourseRepository
     */
    private $courseRepository;
    private $fb;

    public function __construct(NotificationRepository $notificationRepository, CourseRepository $courseRepository ){

        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID') ,
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.5',
        ]);

        $this->fb->setDefaultAccessToken( env('FACEBOOK_APP_ID') . "|" . env('FACEBOOK_APP_SECRET') );
        $this->notificationRepository = $notificationRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param $fb_user_id
     * @return mixed|string
     * @throws string
     */
    public function getPictureById($fb_user_id , $type ){

        $req = $this->fb->request(
            'GET' ,
            '/' . $fb_user_id . '/picture',
            [
                'redirect' => false
            ] ,
            $this->fb->getDefaultAccessToken()  );

        // Send the request to Graph
        try {
            $response = $this->fb->getClient()->sendRequest( $req );
            $imageUrl = $response->getGraphNode()->getField('url');
        } catch( FacebookResponseException $e) {
            // When Graph returns an error
            Log::error( 'Graph returned an error: ' . $e->getMessage() );
            if( $type === "Notification")
                $imageUrl = "/curr/img/icon_c.svg";
            else
                $imageUrl = null;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            Log::error( 'Facebook SDK returned an error: ' . $e->getMessage());
            if( $type === "Notification")
                $imageUrl = "/curr/img/icon_c.svg";
            else
                $imageUrl = null;
        }

        return $imageUrl;
    }

    public function fbLogin(){

        $helper = $this->fb->getRedirectLoginHelper();

        $loginUrl = $helper->getLoginUrl( env('FACEBOOK_LOGIN_CALLBACK_URL'));

        return redirect(  $loginUrl  );
    }

    public function loginCallBack(){

        $helper = $this->fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            Log::error( 'Graph returned an error: ' . $e->getMessage());
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            Log::error( 'Facebook SDK returned an error: ' . $e->getMessage());
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }

        }
        else{
            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $this->fb->getOAuth2Client();

            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);

            $user = \Auth::user();
            $user->FB_conn = $tokenMetadata->getUserId();
            $user->image_url = $this->getPictureById( $user->FB_conn , "Profile");
            $user->FB_token = (string) $accessToken;
            $user->save();



            return redirect('/curriculum');
        }
    }
    
    public function sendNotification( $sender  , $course , $content , $type ){
        
        $students = $course->students;

        $todayWeek = substr( Carbon::now()->format("l") , 0 , 3 );

        $courseDay = explode(",", $course->time1 );
        $courseTime = explode(",", $course->time2 );

        if( ($index = array_search( $todayWeek , $courseDay ) )!== false  ){
            $courseTime = $courseTime[$index];
            $courseStartTime = $this->course_start_map[ min( str_split( $courseTime ))];
            $courseLatestTime = $this->course_end_map[ max( str_split( $courseTime ) ) ];
            
            if( Carbon::now()->between( Carbon::createFromFormat("H:i" , $courseStartTime ) , Carbon::createFromFormat("H:i" , $courseLatestTime )) ){
                foreach( $students as $student ){
                    $notification = $this->notificationRepository->create( $student->stu_id , $sender->stu_id , $course->id , $content , $type );
                    if( $student->FB_conn  && $this->checkConfig( $student , $type ) ) {
                        $this->sendFBNotification($student, $notification);
                    }
                }
            }
            else{
                throw new \Exception("目前非上課時間");
            }
        }
        else{
            throw new \Exception("目前非上課時間");
        }
    }

    private function checkConfig( $student , $type ){
        if( $type === "0" )
            return $student->class_note;
        else if( $type === "1" )
            return $student->go_class_note;
        else if( $type === "2" )
            return $student->test_note;

        return false;
    }
    
    
    public function sendFBNotification( $student , $notification ){

        $req = $this->fb->request('POST' , '/' . $student->FB_conn .  '/notifications' , [
            'href' => "?course_id=" . $notification->course_id ,
            'template' => $notification->content,
            'access_token' => $this->fb->getDefaultAccessToken()->getValue()
        ] , $this->fb->getDefaultAccessToken()->getValue() );

        // Send the request to Graph
        try {
            $response = $this->fb->getClient()->sendRequest( $req );
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            Log::error( 'Graph returned an error: ' . $e->getMessage() );

        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            Log::error(  'Facebook SDK returned an error: ' . $e->getMessage() );
        }
        
    }
    
    
}