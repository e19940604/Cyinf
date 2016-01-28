<?php
namespace Cyinf\Repositories;

use Cyinf\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteRepository
{
    /** @var Favorite 注入的 Favorite model */
    protected $favorite;

    /**
     * UserRepository constructor.
     *
     * @param Favorite $favorite
     */
    public function __construct( Favorite $favorite)
    {
        $this->favorite = $favorite;
    }

    public function checkCoursePined( $course_id ){
        return $this->favorite
            ->where( 'course_id' , $course_id )
            ->where( 'stu_id' , Auth::getUser()->stu_id )
            ->count() > 0 ? true : false;
    }

    public function addFavorite( $course_id ){

        return $this->favorite
            ->create([
                'course_id' => $course_id,
                'stu_id' => Auth::getUser()->stu_id
            ]);
    }

    public function deleteFavorite( $course_id ){
        return $this->favorite
            ->where('course_id' , $course_id )
            ->where('stu_id' , Auth::getUser()->stu_id )
            ->delete();
    }
}