<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/20
 * Time: 下午7:16
 */

namespace Cyinf\Presenters;


use Illuminate\Database\Eloquent\Collection;

class SearchResultFormatPresenter
{

    public function searchResultFormat( Collection $result  ){
        $cp = new CoursePresenter();

        $html = "";

        if( $result->count() == 0 ){
            $html .= "<tr>".
                     "  <td>1</td>".
                     "  <td>沒有課程</td>".
                     "  <td>阿飄教授</td>".
                     "  <td>幽靈學院</td>".
                     "  <td>沒有學分</td>".
                     "  <td>沒有評鑑</td>".
                     "  <td>1200</td>".
                     "  <td>X</td>".
                     "</tr>";
        }
        else{

            foreach( $result as $key => $course ){
                $counter = $key + 1;
                $html .= "<tr>".
                "  <td> $counter </td>".
                "  <td><a href='/course/" . $course->id . "'>" . $course->course_nameCH . "</a></td>".
                "  <td>" . $course->professor . "</td>".
                "  <td>";

                $html .= $cp->getDepartmantNameByCode( $course->course_department );

                $html .= "  </td>".
                         "  <td>";

                $html .= $cp->getGradeNameByNum( $course->course_grade );

                $html .= "  </td>".
                         "  <td>" . $course->judge_people . "</td>".
                         "  <td>" . $course->current_rank . "</td>".
                         "  <td>" . $course->time1 . "</td>".
                         "  <td>" . $course->time2 . "</td>".
                         "  <td>" . $course->place . "</td>".
                         "  <td id='pinArea". $course->id ."'><a href='#searching' class='glyphicon glyphicon-pushpin' onclick='pinAjax(". $course->id  .", 1)'></a></td>";
                $html .= "</tr>";
            }

            return $html;

        }

        return $html;

    }

}