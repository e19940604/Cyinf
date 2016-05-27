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

class FacebookController extends Controller
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
        $this->facebookService = $facebookService;
    }

    protected function login( Request $request ){
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
}
