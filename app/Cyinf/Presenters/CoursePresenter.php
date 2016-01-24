<?php
namespace Cyinf\Presenters;

use Cyinf\DepartmentParser;
use Carbon\Carbon;

class CoursePresenter
{
    /**
     * find department name by map
     *
     * @param $code_str
     * @return string
     */
    public function getDepartmantNameByCode( $code_str ){

        if ( strlen( $code_str ) > 2 ) {
            $prefix = substr(  $code_str , 0 , -3 );
            $postfix = substr( $code_str , -2 );
            return DepartmentParser::parse( $prefix ) .
                " + ".
                DepartmentParser::parse( $postfix );
        }
        else {
            return DepartmentParser::parse( $code_str );
        }
    }

    /**
     * return grade name by number
     *
     * @param $num
     * @return string
     */
    public function getGradeNameByNum( $num ){
        if( $num == 5 )
            return "研究所";
        else if( $num == 0 )
            return "通識";
        else
            return $num;
    }

    /**
     * return class name by percent
     *
     * @param $percentage
     * @return string
     */
    public function positiveColor( $percentage ){

        if( ($percentage > 75) && ($percentage <= 100) ) {
            return "";
        }
        else if( ($percentage <= 75) && ($percentage > 50) ) {
            return "progress-bar-success";
        }
        else if( ($percentage <= 50) && ($percentage > 25) ) {
            return "progress-bar-waring";
        }
        else {
            return "progress-bar-danger";
        }
    }

    /**
     * return class name by percent
     *
     * @param $percentage
     * @return string
     */
    public function negativeColor( $percentage ){

        if( ($percentage > 75) && ($percentage <= 100) ) {
            return "progress-bar-danger";
        }
        else if( ($percentage <= 75) && ($percentage > 50) ) {
            return "progress-bar-waring";
        }
        else if( ($percentage <= 50) && ($percentage > 25) ) {
            return "progress-bar-success";
        }
        else {
            return "";
        }

    }

    /**
     * trigger the tab feature in course page
     *
     * @param $year
     * @return string
     */
    public function activeLatestCommentTab( $year ){

        if( "$year" === Carbon::now()->format("Y") ){
            return "active";
        }
        else{
            return "";
        }
    }

    /**
     * check specify year has comment
     *
     * @param $collection
     * @param $year
     * @return string
     */
    public function checkCommentExist( $collection , $year ){


        if( $collection === [] && "$year" === Carbon::now()->format("Y") ){
            return "<br /><p>還沒有人評鑑，趕快搶頭香吧！</p>";
        }
        else if( $collection === [] ){
            return "<br /><p>本年度沒有人評鑑這門課，請參考其他年度！</p>";
        }
        else{
            return "";
        }
    }

    public function judgePassiveBtnGenerator( $i ){

        if ( ($i+1) == 1 || ($i+1) == 2 ) {
            return "btn-danger";
        }
        else if ( ($i+1) == 3 || ($i+1) == 4 ) {
            return "btn-warning";
        }
        else if ( ($i+1) == 5 || ($i+1) == 6 ) {
            return "btn-success";
        }
        else {
            return "btn-primary";
        }
    }

    public function judgeNegativeBtnGenerator( $i ){
        if ( ($i+1) == 1 || ($i+1) == 2 ) {
            return "btn-primary";
        }
        else if ( ($i+1) == 3 || ($i+1) == 4 ) {
            return "btn-success";
        }
        else if ( ($i+1) == 5 || ($i+1) == 6 ) {
            return "btn-warning";
        }
        else {
            return "btn-danger";
        }
    }

    public function getCommentBtn( $course_id , $is_commented ){


        if( $is_commented ){
            return '<a href="#"><button type="button" class="btn btn-success btn-xs" disabled="disabled">已完成評鑑</button></a>';
        }
        else{
            return '<a href="/course/judge/' . $course_id . '"><button type="button" class="btn btn-primary btn-xs">我要評鑑</button></a>';
        }


    }
}