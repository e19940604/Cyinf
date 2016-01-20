<?php
/**
 * Created by Xgnid.
 * User: e19940604
 * Date: 2016/1/20
 * Time: 下午12:57
 */

namespace Cyinf\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface CourseSearchInterface
{
    /* TODO// after updating PHP7 , adding return type hint here  */
    public function query( $query_restrict ); /* return Collections */
}