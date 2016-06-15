<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/5/25
 * Time: 上午11:20
 */

namespace Cyinf\Presenters;


use Cyinf\User;

class NotificationPresenter
{
    /**
     * @param array $array
     * @return array
     */
    public static function db2api($array = [] ){

        $result = [];

        foreach( $array as $item ){

            if( $item['stu_id'] === null ){
                $imageUrl = "/curr/img/icon_c.svg";
            }
            else{
                $fbServ = new \Cyinf\Services\FacebookService( app()->make( \Cyinf\Repositories\NotificationRepository::class ) , app()->make( \Cyinf\Repositories\CourseRepository::class ) );
                $student = User::find( $item['stu_id'] );
                $imageUrl = $fbServ->getPictureById( $student->FB_conn , "Notification");
            }

            array_push( $result , [
                'id' => $item['id'],
                'imageUrl' => $imageUrl,
                'content' => $item['content'],
                'created_at' => substr( $item['created_at'], 0 , 10 )
            ] );
        }


        return $result;
    }
}