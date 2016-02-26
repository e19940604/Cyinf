<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/21
 * Time: 下午8:15
 */

namespace Cyinf\Services;

use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Repositories\CourseRepository;
use Illuminate\Support\Facades\Validator;
class CourseService
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CourseService constructor.
     * @param CourseRepository $courseRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(CourseRepository $courseRepository, CommentRepository $commentRepository){
        $this->courseRepository = $courseRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * validate judge form
     *
     * @param $request
     * @return bool
     */
    public function validateJudgeRequest( $request ){

        $item_rule = 'required|numeric|between:0,100';

        $rule = [
            'teach' => $item_rule,
            'practical' => $item_rule,
            'TA' => $item_rule,
            'nutrition' => $item_rule,
            'test' => $item_rule,
            'homework' => $item_rule,
            'grade' => $item_rule,
            'time' => $item_rule,
            'roll' => $item_rule,
            'sign' => $item_rule,
            'comments' => 'required|string|max:1500',
        ];

        $validate = Validator::make( $request ,$rule );

        if( $validate->fails() ){
            \Log::error( $validate->errors() );
            return false;
        }
        else{
            return true;
        }

    }

    public function UpdateCurrentRank( Course $course , Comment $comment ){

        $c = $course->comments;
        $total_comment = $course->comments->count();

        $teach = $comment->teach_q;
        $time = $comment->time_c;
        $sign = $comment->sign_d;
        $test = $comment->test_d;
        $homework = $comment->homework_d;
        $grade = $comment->grade_d;
        $TA = $comment->TA_r;
        $practical = $comment->practical_r;
        $roll = $comment->rollCall_r;
        $nutrition = $comment->nutrition_r;

        $Pasitive = $teach + $practical + $TA + $nutrition;
        $Negative = $test + $homework + $grade + $time + $roll + $sign;

        $test = 100 - $test;
        $homework = 100 - $homework;
        $grade = 100 - $grade;
        $time = 100 - $time;
        $roll = 100 - $roll;
        $sign = 100 - $sign;

        $total = ($Pasitive + $test + $homework + $grade + $time + $sign + $roll) / 100;

        // If Negative == Pasitive, current_rank won't be changed
        $rank = $course->current_rank;
        if ( $Negative > ($Pasitive*1.5) ) {
            $rank -= $total;
        } else if ( $Negative < ($Pasitive*1.5) ) {
            $rank += $total;
        }

        $course->current_rank = $rank;
        $course->teach_quality = ( $c->sum('teach_q') + 50 ) / ( $total_comment + 1 );
        $course->time_cost = ( $c->sum('time_c') + 50 ) / ( $total_comment + 1 );
        $course->sign_dif = ( $c->sum('sign_d') + 50 ) / ( $total_comment + 1 );
        $course->test_dif = ( $c->sum('test_d') + 50 ) / ( $total_comment + 1 );
        $course->homework_dif = ( $c->sum('homework_d') + 50 ) / ( $total_comment + 1 );
        $course->grade_dif = ( $c->sum('grade_d') + 50 ) / ( $total_comment + 1 );
        $course->TA_rank = ( $c->sum('TA_r') + 50 ) / ( $total_comment + 1 );
        $course->practical_rank = ( $c->sum('practical_r') + 50 ) / ( $total_comment + 1 );
        $course->roll_freq = ( $c->sum('rollCall_r') + 50 ) / ( $total_comment + 1 );
        $course->nutrition_rank = ( $c->sum('nutrition_r') + 50 ) / ( $total_comment + 1 );
        $course->judge_people = $total_comment;

        $course->save();

    }

    public function addCourse($data){

        $course = $this->courseRepository->getCourse($data['course_nameCH'], $data['professor']);

        if($course != NULL){
            $course->unit =  $data['unit'];
            $course->time1 = $data['time1'];
            $course->time2 = $data['time2'];
            $course->place = $data['place'];

            if($data['course_department'] < 10 || $data['course_department'] > 16){
                $course->course_grade = $data['course_grade'];
            }

            if( $data['course_department'] >= 10 && $data['course_department'] <= 16 && strlen($course->course_department) <= 2 && $course->course_department != $data['course_department']){
                $course->course_department = $course->course_department.','.$data['course_department'];
            }

            if(isset($data['course_dimensions'])){
                $course->course_dimensions = $data['course_dimensions'];
            }

            $course->save();
        }
        else{
            
            $initData = [
                'current_rank' => 1200, 
                'judge_people' => 0, 
                'teach_quality' => 50, 
                'time_cost' => 50,
                'sign_dif' => 50, 
                'test_dif' => 50, 
                'homework_dif' => 50, 
                'grade_dif' => 50, 
                'TA_rank' => 50, 
                'practical_rank' => 50, 
                'roll_freq' => 50, 
                'nutrition_rank' => 50
            ];
            
            $data = array_merge($data, $initData);
            $course = $this->courseRepository->create($data);
        }
    }

    public function autoAddCourse($D0, \Symfony\Component\Console\Output\OutputInterface $output){

        $NormalD1Collect = [
            [ "AC1C" ] ,            //case 0: echo '國語文'; break;
            [ "AC2K" ] ,            //case 1: echo '英文初級'; break;
            [ "AC2L" ] ,            //case 2: echo '英文中級'; break;
            [ "AC2M" ] ,            //case 3: echo '英文中高級'; break;
            [ "AC2N" ] ,            //case 4: echo '英文高級'; break;
            [  ] ,          //case 5: echo '運動與健康'; break;
            [  ] ,          //case 6: echo '興趣選修'; break;
            [ "AE01" , "AE02" ] ,           //case 7: echo '通識教育'; break;
            [ "AH01" ] ,            //case 8: echo '應用性課程'; break;
            [ "AG01" ] ,            //case 9: echo '普通物理小組'; break;
            [  ] ,          //case 10: echo '跨院（通）'; break;
            [  ] ,          //case 11: echo '跨院（文）'; break;
            [  ] ,          //case 12: echo '跨院（理）'; break;
            [  ] ,          //case 13: echo '跨院（工）'; break;
            [  ] ,          //case 14: echo '跨院（管）'; break;
            [  ] ,          //case 15: echo '跨院（海）'; break;
            [  ] ,          //case 16: echo '跨院（社）'; break;
            [ "ASE2" ] ,            //case 17: echo '服務學習'; break;
            [ "B101" ] ,            //case 18: echo '中文系（CL）'; break;
            [ "B102" ] ,            //case 19: echo '外文系（DFLL）'; break;
            [ "B10A" ] ,            //case 20: echo '文學院（LIBA）'; break;
            [ "B103" ] ,            //case 21: echo '音樂系（MUSI）'; break;
            [ "M105" ] ,            //case 22: echo '哲學碩（PHIL）'; break;
            [ "B106" ] ,            //case 23: echo '劇藝系（TA）'; break;
            [ "B201" ] ,            //case 24: echo '生科系（BIOS）'; break;
            [ "M205" ] ,            //case 25: echo '生醫碩（IMBS）'; break;
            [ "B202" ] ,            //case 26: echo '化學系（CHE）'; break;
            [ "B203" ] ,            //case 27: echo '物理系（PHYS）'; break;
            [ "B204" ] ,            //case 28: echo '應數系（MATH）'; break;
            [ "B301" ] ,            //case 29: echo '電機系（EE）'; break;
            [ "M361" ] ,            //case 30: echo '電力碩（IMPE）'; break;
            [ "M307" ] ,            //case 31: echo '通訊碩（ICE）'; break;
            [ "B302" ] ,            //case 32: echo '機電系（MEME）'; break;
            [ "B304" ] ,            //case 33: echo '資工系（CSE）'; break;
            [ "B309" ] ,            //case 34: echo '光電系（EO）'; break;
            [ "B310" ] ,            //case 35: echo '材光系（MOES）'; break;
            [ "M303" ] ,            //case 36: echo '環工碩（ENVE）'; break;
            [ "B401" ] ,            //case 37: echo '企管系（BM）'; break;
            [ "B402" ] ,            //case 38: echo '資管系（MIS）'; break;
            [ "B403" ] ,            //case 39: echo '財管系（FM）'; break;
            [ "M405" ] ,            //case 40: echo '人管所（HRM）'; break;
            [  ] ,          //case 41: echo '傳管所（ICM）'; break;
            [ "B606" ] ,            //case 42: echo '政經系（PE）'; break;
            [ "M404" ] ,            //case 43: echo '公事碩（PAM）'; break;
            [ "M602" ] ,            //case 44: echo '政治碩（IPS）'; break;
            [ "M604" ] ,            //case 45: echo '經濟碩（ECON）'; break;
            [ "B609" ] ,            //case 46: echo '社會系（SOC）'; break;
            [ "M605" ] ,            //case 47: echo '教育碩（IOE）'; break;
            [ "M607" ] ,            //case 48: echo '亞太碩（CAPS）'; break;
            [ "B60A" ] ,            //case 49: echo '社科院（CSS）'; break;
            [ "B504" ] ,            //case 50: echo '海工系（MAEV）'; break;
            [ "B502" ] ,            //case 51: echo '海資系（MBR）'; break;
            [  ] ,          //case 52: echo '（MRBI）'; break;
            [  ] ,          //case 53: echo '海地化碩（IMGC）'; break;
            [ "M507" ] ,            //case 54: echo '海事碩（MA）'; break;
            [  ] ,          //case 55: echo '海下物碩（UTAO）'; break;
            [  ] ,          //case 56: echo 'BPM'; break;
            [  ] ,          //case 57: echo 'STP'; break;
            [ "M462" ] ,            //case 58: echo '醫管學程（IHCM）'; break;
            [  ] ,          //case 59: echo 'IB'; break;
            [ "B509" ] ,           //case 60: echo '海科系（OO）'; break;
        ];

        $SpecialD1Collect = [
            10 => "AI00",           //case 10: echo '跨院（通）'; break;
            11 => "AI01",           //case 11: echo '跨院（文）'; break;
            12 => "AI02",           //case 12: echo '跨院（理）'; break;
            13 => "AI03",           //case 13: echo '跨院（工）'; break;
            14 => "AI04",           //case 14: echo '跨院（管）'; break;
            15 => "AI05",           //case 15: echo '跨院（海）'; break;
            16 => "AI06",           //case 16: echo '跨院（社）'; break;
            18 => "M101",           //case 18: echo '中文系（CL）'; break;
            19 => "M102",           //case 19: echo '外文系（DFLL）'; break;
            21 => "M103",           //case 21: echo '音樂系（MUSI）'; break;
            23 => "M107",           //case 23: echo '劇藝系（TA）'; break;
            24 => "M201",           //case 24: echo '生科系（BIOS）'; break;
            26 => "M202",           //case 26: echo '化學系（CHE）'; break;
            27 => "M203",           //case 27: echo '物理系（PHYS）'; break;
            28 => "M204",           //case 28: echo '應數系（MATH）'; break;
            29 => "M301",           //case 29: echo '電機系（EE）'; break;
            32 => "M302",           //case 32: echo '機電系（MEME）'; break;
            33 => "M304",           //case 33: echo '資工系（CSE）'; break;
            34 => "M309",           //case 34: echo '光電系（EO）'; break;
            35 => "M310",           //case 35: echo '材光系（MOES）'; break;
            37 => "M411",           //case 37: echo '企管系（BM）'; break;
            38 => "M402",           //case 38: echo '資管系（MIS）'; break;
            39 => "M403",           //case 39: echo '財管系（FM）'; break;
            42 => "M606",           //case 42: echo '政經系（PE）'; break;
            46 => "M609",           //case 46: echo '社會系（SOC）'; break;
            50 => "M504",           //case 50: echo '海工系（MAEV）'; break;
            51 => "M502",           //case 51: echo '海資系（MBR）'; break;
            60 => "M509"            //case 60: echo '海科系（OO）'; break;
        ];

        $this->initCourse();

        $bar = new \Symfony\Component\Console\Helper\ProgressBar($output, count($NormalD1Collect) + count($SpecialD1Collect));
        $bar->start();

        foreach ($NormalD1Collect as $course_department => $course_value) {
            foreach ($course_value as $key => $D1) {
                $this->fectch($D0, $D1, $course_department);
            }
            $bar->advance();
        }

        foreach ($SpecialD1Collect as $course_department => $D1) {
            $this->fectch($D0, $D1, $course_department, true);
            $bar->advance();
        }

        $bar->finish();
    }

    private function fectch($D0, $D1, $course_department, $is_special = false){
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $page = 1;
        $basicUrl = "http://selcrs.nsysu.edu.tw/menu1/dplycourse.asp?D0=".$D0."&D1=".$D1."&TYP=1";
        $flag = true;
        $need_course_dimensions_department = [7];
        $convert_course_dimensions = [
            '一' => 1, '二' => 2, '三' => 3, 
            '四' => 4, '五' => 5, '六' => 6
        ];

        while($flag){
            $url = $basicUrl."&page=".$page;
            $html = new \Htmldom($url);
            $trCollect = $html->find('tr');
            $totalTr   = count($trCollect);
            for($i = 3; $i < $totalTr - 2; ++$i){
                $data = [];
                $tr = $trCollect[$i];
                @$course = preg_split( "/\r\n/" , $tr->children[7]->plaintext);
                @$data['course_nameCH'] = $course[0];
                @$data['course_nameEN'] = $course[1]; 
                @$data['course_grade'] =  str_replace("</small>", "", $tr->children[5]->plaintext);
                @$data['unit']         =  $tr->children[8]->plaintext;
                @$data['professor']    =  $tr->children[15]->plaintext;
                @$data['place']        =  $tr->children[16]->plaintext;
                @$data['course_department'] = $course_department;
                
                $time1 = array();
                $time2 = array();

                foreach ($days as $key => $value) {
                    @$time = $tr->children[17+$key]->plaintext;;
                    if($time != "&nbsp"){
                        array_push( $time1 , $value );
                        array_push( $time2 , $time );
                    }
                }

                if(in_array($data['course_department'], $need_course_dimensions_department)){
                    @$course_dimensions = $tr->children[3]->plaintext;
                    foreach ($convert_course_dimensions as $key => $value) {
                        if(mb_stripos($course_dimensions, $key, 0, 'UTF-8') !== FALSE){
                            $data['course_dimensions'] = $value;
                            break;
                        }
                    }
                }

                if($is_special && $data['course_department'] >= 18){
                    $data['course_grade'] = 5;
                }

                if(array_search("", $data) !== false)
                    continue;

                $data['time1'] = implode( "," , $time1 );
                $data['time2'] = implode( "," , $time2 );
                $this->addCourse($data);
                //print_r($data);
            }
            ++$page;
            if(mb_stripos($trCollect[$totalTr - 2]->plaintext, "下一頁", 0, 'UTF-8') === FALSE)
                $flag = false;
        }
    }

    private function initCourse(){
        $this->courseRepository->initCourse();
    }

}