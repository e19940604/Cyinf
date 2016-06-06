<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/5/22
 * Time: 下午8:43
 */

namespace Cyinf\Repositories;

use Cyinf\Notification;
use Illuminate\Database\Eloquent\Collection;


class NotificationRepository
{
    /**
     * @var Notification
     */
    private $notification;

    /**
     * NotificationRepository constructor.
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @param string
     * @return Collection
     */
    public function getLatest10Notification($stu_id ){
        return $this->notification->where( 'stu_id' , $stu_id )->orderBy('id', 'desc' )->skip(0)->take(10)->get();
    }

    /**
     * @param $stu_id
     * @param $id
     * @param int $quantity
     * @return mixed
     */
    public function getNotificationFront($stu_id  , $id , $quantity = 10){
        return $this->notification
            ->where( 'stu_id' , $stu_id )
            ->where( 'id' , '<' , $id )
            ->orderBy('id', 'desc' )
            ->take( $quantity )
            ->get();
    }

    /**
     * @param $stu_id
     * @param $id
     * @param int $quantity
     * @return mixed
     */
    public function getNotificationBack($stu_id  , $id , $quantity = 10){
        return $this->notification
            ->where( 'stu_id' , $stu_id )
            ->where( 'id' , '>' , $id )
            ->orderBy('id', 'asc' )
            ->take( $quantity )
            ->get();
    }

    public function setAllNotifyRead( $stu_id ){
        return $this->notification
            ->where( 'stu_id' , $stu_id )
            ->where( 'is_read' , false )
            ->update([ 'is_read' => true ]);
    }

    public function create( $stu_id  , $sender , $course_id , $content , $type ){
        return $this->notification
            ->create([
                'stu_id' => $stu_id,
                'sender' => $sender,
                'course_id' => $course_id,
                'content' => $content,
                'type' => $type
            ]);
    }

}