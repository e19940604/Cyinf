<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookApp;
use Illuminate\Http\Request;
use Facebook\FacebookRequest;
use Facebook\FacebookClient;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Services\FacebookService;

class FacebookController extends CyinfApiController
{
    /**
     * @var FacebookService
     */
    private $facebookService;

    /**
     * FacebookController constructor.
     * @param FacebookService $facebookService
     */
    public function __construct(FacebookService $facebookService)
    {
        parent::__construct();
        $this->facebookService = $facebookService;
    }

    protected function login( ){
        return $this->facebookService->fbLogin();
    }

    protected function loginCallBack(){
        return $this->facebookService->loginCallBack();
    }

    protected function testAccessToken( Request $request ){


        $fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID') ,
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.5',
        ]);

        $req = $fb->request('POST' , '/' . Auth::user()->FB_conn .  '/notifications' , [
            'href' => 'www.google.com',
            'template' => 'This is a test message',
        ] , env('FACEBOOK_APP_ID') . "|" . env('FACEBOOK_APP_SECRET') );

        // Send the request to Graph
        try {
            $response = $fb->getClient()->sendRequest( $req );
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();

        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }

    }

    protected function profile( Request $request ){
        $user = \Auth::user();

        $imageUrl = $this->facebookService->getPictureById( $user->FB_conn , "Profile" );
        $this->responseData['data'] = [
            'username' => $user->real_name,
            'imageUrl' => $imageUrl
        ];
        
        $this->responseCode = 200;
        
        if( $imageUrl === null)
            $this->responseData['status'] = "unlink";
        else
            $this->responseData['status'] = "success";

        return $this->send_response();
    }
    
    protected function logout(){

        $user = \Auth::user();
        $user->FB_conn = "";
        $user->save();

        $this->responseData['status'] = "success";
        $this->responseCode = 200;
        return $this->send_response();
    }
}
