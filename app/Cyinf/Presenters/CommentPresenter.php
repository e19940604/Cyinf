<?php
namespace Cyinf\Presenters;

use Cyinf\DepartmentParser;
use Auth;

class CommentPresenter
{
    public function getCourseTableByCollection( $counter , $comment ){


        $course = $comment->course;

        $table_html = '<td>' . $counter.  '</td>'.
                '<td><a href="/course/' . $course->id . '">' . $course->course_nameCH . '</a></td>'.
                '<td>' . $course->professor . '</td>'.
                '<td>';

        if ( strlen( $course->course_department ) > 2 )
        {
            $prefix = substr(  $course->course_department, 0 , -3 );
            $postfix = substr( $course->course_department, -2 );
            $table_html .= DepartmentParser::parse( $prefix ) .
                            " + ".
                            DepartmentParser::parse( $postfix );
        }
        else
        {
            $table_html .= DepartmentParser::parse( $course->course_department );
        }

        $table_html .=  '</td><td>';

        if( $course->course_grade == 5 )
            $table_html .= "研究所";
        else if( $course->course_grade == 0 )
            $table_html .= "通識";
        else
            $table_html .= $course->course_grade;

        $table_html .= '</td><td>' . $course->judge_people . '</td>';
        $table_html .= '<td>' . $course->current_rank . '</td>';
        $table_html .= '<td>' . $comment->date . ' - ' . $comment->time . '</td>';


        $table_html .= "<td id='pinArea".$course->id."'><a href='#searching' class='glyphicon glyphicon-pushpin' onclick='pinAjax(". $course->id .", 1)'></a></td>";
        return $table_html;
    }
}
