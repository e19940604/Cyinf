<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/5/25
 * Time: 上午11:36
 */

namespace Cyinf\Services;
session_start();

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

        foreach( $students as $student ){
            $notification = $this->notificationRepository->create( $student->stu_id , $sender->stu_id , $course->id , $content , $type );
            if( $student->FB_conn  && $this->checkConfig( $student , $type ) ) {
                $this->sendFBNotification($student, $notification);
            }
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
            'href' => env('FACEBOOK_NOTIFICATION_URL') . "?course_id=" . $notification->id ,
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