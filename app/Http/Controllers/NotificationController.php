<?php

namespace App\Http\Controllers;

use Cyinf\Repositories\NotificationRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Presenters\NotificationPresenter;

class NotificationController extends CyinfApiController
{

    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    /**
     * NotificationController constructor.
     * @param NotificationRepository $notificationRepository
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }


    /**
     * get notification
     *
     * default => the newset 10
     *
     * @param Request $request
     * @return Response
     */
    protected function show(Request $request ){
        
        $user = \Auth::User();
        
        if( $this->vaild_data_format( $request->all() , ['range' , 'item_id']) === true ){

            $item_id = $request->get("item_id");
            $range = $request->get("range");

            if( $range > 0 ){
                $notis = $this->notificationRepository->getNotificationBack($user->stu_id , $item_id, $range );
            }
            else{
                $notis = $this->notificationRepository->getNotificationFront($user->stu_id , $item_id, $range * -1 );
            }

        }
        else{
            $notis = $this->notificationRepository->getLatest10Notification( $user->stu_id );
        }

        $this->responseData['status'] = "success";
        $this->responseData['data'] = NotificationPresenter::db2api( $notis->toArray() );
        $this->responseCode = 200;

        return $this->send_response();
    }

    protected function config( Request $request ){
        $valid = $this->vaild_data_format( $request->all() , ['type']);

        if( $valid !== true ){
            $this->responseData['status'] = "failure";
            $this->responseData['error'] = $valid;
            $this->responseCode = 400;
            return $this->send_response();
        }

        $type = $request->get('type');

        if( $type !== "1" && $type !== "2" && $type !== "0") {
            $this->responseData['status'] = "failure";
            $this->responseData['error'] = "type field format error";
            $this->responseCode = 400;
            return $this->send_response();
        }

        $user = \Auth::user();
        $type === "1" ? $user->go_class_note = !$user->go_class_note : $user->test_note = !$user->test_note;

        $user->save();

        $this->responseCode = 200;
        $this->responseData['status'] = "success";

        return $this->send_response();

    }

    protected function readAll(){
        
        $user = \Auth::user();
        $this->notificationRepository->setAllNotifyRead( $user->stu_id );

        $this->responseCode = 200;
        $this->responseData['status'] = "success";

        return $this->send_response();
        
    }
}
