<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/5/25
 * Time: 上午11:36
 */

namespace Cyinf\Services;


use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\FacebookApp;
use Facebook\Facebook;
use Facebook\FacebookRequest;
use Illuminate\Support\Facades\Log;

class FacebookService
{

    private $fb;

    public function __construct(){

        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID') ,
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.6',
        ]);

        $this->fb->setDefaultAccessToken( env('FACEBOOK_APP_ID') . "|" . env('FACEBOOK_APP_SECRET') );
        
        
    }

    public function getPictureById( $fb_user_id ){

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
            $imageUrl = "/curr/img/icon_c.svg";
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            Log::error( 'Facebook SDK returned an error: ' . $e->getMessage());
            $imageUrl = "/curr/img/icon_c.svg";
        }

        return $imageUrl;
    }
}