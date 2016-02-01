<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/24
 * Time: 下午9:55
 */

namespace Cyinf\Services;

use Cyinf\Repositories\FavoriteRepository;

class PinService
{

    /**
     * @var FavoriteRepository
     */
    private $favoriteRepository;

    /**
     * PinService constructor.
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    public function pinCourse( $course_id , $status ){

        // pin
        $checkCourse = $this->favoriteRepository->checkCoursePined( $course_id );

        if( $status == 1 ){
            if( !$checkCourse ){
                $this->favoriteRepository->addFavorite( $course_id );
                return true;
            }
            else{
                return false;
            }
        }
        // unpin
        else{
            if( $checkCourse ){
                $this->favoriteRepository->deleteFavorite( $course_id );
                return true;
            }
            else{
                return false;
            }
        }
    }


}