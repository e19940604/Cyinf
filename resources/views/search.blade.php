@extends('layout')

@section('title' , "Course Search")

@section('style')

    <style type="text/css">
        .search-footer{
            float: none;
            padding-top: 40px;
            margin-top: 560px;
        }
    </style>
@endsection

@section('content')

    <article role="main">
        <h1>SEARCH /</h1>
    </article>

    <section class="cn-container">
        <div class="cn-slide" id="slide-main">
            <div class="cn-content">
                <a href="#slide-1">
                    <div class="courseName">
                        <img src="img/courseName-white.png" title="Course Name" alt="Course Name"/>
                    </div>
                </a>
                <a href="#slide-2">
                    <div class="professor">
                        <img src="img/professor-white.png" title="Professor" alt="Professor"/>
                    </div>
                </a>
                <a href="#slide-3">
                    <div class="department">
                        <img src="img/department-white.png" title="Department" alt="Department"/>
                    </div>
                </a>
                <a href="#slide-4">
                    <div class="advance">
                        <img src="img/advance-white.png" title="Advance search" alt="Advance search"/>
                    </div>
                </a>
            </div>
        </div>

        <!-- Slide 1 and Sub-slides -->
        <div class="cn-slide cn-slide-sub courseEnter" id="slide-1">
            <a href="#slide-main" class="textFix cn-back">BACK /</a>
            <a href="#slide-main"><img src="img/courseName.png" title="courseName" /></a>
            <form role="courseSearch" action="#searching" id="courseForm" onsubmit="return (function(){courseSearch();return false;})();">
                <div class="col-lg-13">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter the course name" id="courseInput" name="courseName" />
                                  <span class="input-group-btn">
                                    <button class="btn" type="submit">Go!</button>
                                  </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-13 -->
            </form>
        </div>

        <div class="cn-slide cn-slide-sub" id="searching">
            <a href="#slide-main" id="back" class="textFix cn-back" >BACK /</a>
            <div class="cn-content">
                你知道嗎？點一下各項的表格標題可以進行排序喔。<br /><br />
                <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 520px">
                    <table class="table table-hover showSearchTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Professor</th>
                            <th>Department</th>
                            <th>Grade</th>
                            <th>Judge People</th>
                            <th>Rank</th>
                            <th>Week</th>
                            <th>Time</th>
                            <th>Place</th>
                            <th>Pin</th>
                        </tr>
                        </thead>
                        <tbody id="courseShow">
                        <tr>
                            <td>請進行搜尋</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /cn-content -->
        </div><!-- /cn-slide-searching -->


        <!-- Slide 2 and Sub-slides -->
        <div class="cn-slide cn-slide-sub professorEnter" id="slide-2">
            <a href="#slide-main" class="textFix cn-back">BACK /</a>
            <a href="#slide-main"><img src="img/professor.png" title="professorName" /></a>
            <form role="professorSearch" action="#searching" id="professorForm" onsubmit="return (function(){professorSearch();return false;})();">
                <div class="col-lg-13">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter the professor's name" id="professorInput" name="professorName" />
                                  <span class="input-group-btn">
                                    <button class="btn" type="submit">Go!</button>
                                  </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-13 -->
            </form>
        </div>

        <!-- Slide 3 and Sub-slides -->
        <div class="cn-slide cn-slide-sub" id="slide-3">
            <a href="#slide-main" class="textFix cn-back" onclick="backRemind()">BACK /</a>
            <nav>
                <a href="#slide-3-1" onclick="setDepartment(0)">國語文</a>
                <a href="#slide-3-1" onclick="setDepartment(1)">英文初級</a>
                <a href="#slide-3-1" onclick="setDepartment(2)">英文中級</a>
                <a href="#slide-3-1" onclick="setDepartment(3)">英文中高級</a>
                <a href="#slide-3-1" onclick="setDepartment(4)">英文高級</a>
                <a href="#slide-3-1" onclick="setDepartment(5)">運動與健康</a>
                <a href="#slide-3-1" onclick="setDepartment(6)">興趣選修</a>
                <a href="#slide-3-1" onclick="setDepartment(7)">通識(博雅)</a>
                <a href="#slide-3-1" onclick="setDepartment(8)">應用性課程</a>
                <a href="#slide-3-1" onclick="setDepartment(10)">跨院(通)</a>
                <a href="#slide-3-1" onclick="setDepartment(11)">跨院(文)</a>
                <a href="#slide-3-1" onclick="setDepartment(12)">跨院(理)</a>
                <a href="#slide-3-1" onclick="setDepartment(13)">跨院(工)</a>
                <a href="#slide-3-1" onclick="setDepartment(14)">跨院(管)</a>
                <a href="#slide-3-1" onclick="setDepartment(15)">跨院(海)</a>
                <a href="#slide-3-1" onclick="setDepartment(16)">跨院(社)</a>
                <a href="#slide-3-1" onclick="setDepartment(17)">服務學習</a>
                <a href="#slide-3-1" onclick="setDepartment(9)">普物小組</a>
                <a href="#slide-3-1" onclick="setDepartment(18)">中文系</a>
                <a href="#slide-3-1" onclick="setDepartment(19)">外文系</a>
                <a href="#slide-3-1" onclick="setDepartment(20)">文學院</a>
                <a href="#slide-3-1" onclick="setDepartment(21)">音樂系</a>
                <a href="#slide-3-1" onclick="setDepartment(23)">劇藝系</a>
                <a href="#slide-3-1" onclick="setDepartment(24)">生科系</a>
                <a href="#slide-3-1" onclick="setDepartment(26)">化學系</a>
                <a href="#slide-3-1" onclick="setDepartment(27)">物理系</a>
                <a href="#slide-3-1" onclick="setDepartment(28)">應數系</a>
                <!--a href="#slide-3-1" onclick="setDepartment()">理學院</a-->
                <a href="#slide-3-1" onclick="setDepartment(29)">電機系</a>
                <a href="#slide-3-1" onclick="setDepartment(33)">資工系</a>
                <a href="#slide-3-1" onclick="setDepartment(32)">機電系</a>
                <a href="#slide-3-1" onclick="setDepartment(35)">材光系</a>
                <a href="#slide-3-1" onclick="setDepartment(34)">光電系</a>
                <a href="#slide-3-1" onclick="setDepartment(50)">海工系</a>
                <a href="#slide-3-1" onclick="setDepartment(51)">海資系</a>
                <a href="#slide-3-1" onclick="setDepartment(60)">海科系</a>
                <a href="#slide-3-1" onclick="setDepartment(37)">企管系</a>
                <a href="#slide-3-1" onclick="setDepartment(39)">財管系</a>
                <a href="#slide-3-1" onclick="setDepartment(38)">資管系</a>
                <a href="#slide-3-1" onclick="setDepartment(42)">政經系</a>
                <a href="#slide-3-1" onclick="setDepartment(46)">社會系</a>
                <a href="#slide-3-1" onclick="setDepartment(49)">社科院</a>
                <a href="#slide-3-1" onclick="setDepartment(22)">哲學碩</a>
                <a href="#slide-3-1" onclick="setDepartment(40)">人管碩</a>
                <a href="#slide-3-1" onclick="setDepartment(41)">傳管碩</a>
                <a href="#slide-3-1" onclick="setDepartment(58)">醫管學程</a>
                <a href="#slide-3-1" onclick="setDepartment(48)">亞太碩</a>
                <a href="#slide-3-1" onclick="setDepartment(43)">公事碩</a>
                <a href="#slide-3-1" onclick="setDepartment(44)">政治碩</a>
                <a href="#slide-3-1" onclick="setDepartment(45)">經濟碩</a>
                <a href="#slide-3-1" onclick="setDepartment(47)">教育碩</a>
                <a href="#slide-3-1" onclick="setDepartment(25)">生醫碩</a>
                <a href="#slide-3-1" onclick="setDepartment(36)">環工碩</a>
                <a href="#slide-3-1" onclick="setDepartment(31)">通訊碩</a>
                <a href="#slide-3-1" onclick="setDepartment(30)">電力碩</a>
                <a href="#slide-3-1" onclick="setDepartment(53)">海地化碩</a>
                <a href="#slide-3-1" onclick="setDepartment(54)">海事碩</a>
                <a href="#slide-3-1" onclick="setDepartment(55)">海下物碩</a>
                <a href="#slide-main" onclick="">F</a>
                <a href="#slide-main" onclick="">A</a>
                <a href="#slide-main" onclick="">.</a>
                <a href="#slide-main" onclick="">C</a>
                <a href="#slide-main" onclick="">O</a>
                <a href="#slide-main" onclick="">U</a>
                <a href="#slide-main" onclick="">R</a>
                <a href="#slide-main" onclick="">S</a>
                <a href="#slide-main" onclick="">E</a>
            </nav>
        </div>

        <div class="cn-slide cn-slide-sub" id="slide-3-1">
            <a href="#slide-3" class="textFix cn-back">BACK /</a>
            <div class="cn-content">
                <nav id="gradeContent">
                    <a href="#searching" onclick="departmentSearch(1)">一年級</a>
                    <a href="#searching" onclick="departmentSearch(2)">二年級</a>
                    <a href="#searching" onclick="departmentSearch(3)">三年級</a>
                    <a href="#searching" onclick="departmentSearch(4)">四年級</a>
                    <a href="#searching" onclick="departmentSearch(5)">研究所</a>
                    <a href="#searching" onclick="departmentSearch(6)">全年級</a>
                </nav>
            </div>
        </div>

        <!-- Slide 4 and Sub-slides -->
        <div class="cn-slide cn-slide-sub professorEnter" id="slide-4">
            <a href="#slide-main" class="textFix cn-back">BACK /</a>
            <a href="#slide-main"><img src="img/advance.png" title="professorName" /></a>
            <form class="form-horizontal" role="advance-Search" action="#searching" id="advanceForm">

                <div class="form-group" id="add-rule">
                    <div class="col-sm-offset-9 col-sm-2">
                        <span class="add-rule-icon" onclick="addRule();"><i class="fa fa-plus-circle fa-3x"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-2">
                        <button type="button" id="advance" class="btn" onclick="advanceSearch()" >GO!</button>
                    </div>
                </div>
            </form>
        </div>

    </section>

@endsection

@section('scriptArea')
    <script  type="text/javascript">

        rule = {};

        function addRule(){
            html = '<div class="form-group">'+
                        '<label for="rule" class="col-sm-offset-1 col-sm-2 control-label advancelabel">條件</label>'+
                        '<div class="col-sm-3">'+
                            '<select class="form-control holder rule-key">'+
                                '<option value=""></option>'+
                                '<option value="de">系所</option>'+
                                '<option value="ti1">星期</option>'+
                                '<option value="ti2">節次</option>'+
                                '<option value="gr">年級</option>'+
                                '<option value="pl">教室(大樓)</option>'+
                                '<option value="di">向度(通識教育)</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                            '<select class="form-control holder rule-value">'+
                                '<option value=""></option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                            '<span class="add-rule-icon remove-rule" ><i class="fa fa-minus-circle fa-3x"></i></span>'+
                        '</div>'+
                    '</div>';
            $("#add-rule").before(html);
        }

        $("#advanceForm").on("change", ".rule-key", function(){
            value  = $(this).val();
            target = $(this).parent().next().children(".rule-value");
            html = '<option value=""></option>';

            switch(value){
                case "de":  html += getDeHtml(); break;
                case "ti1": html += getTi1Html();break;
                case "ti2": html += getTi2Html();break;
                case "gr":  html += getGrHtml(); break;
                case "pl":  html += getPlHtml(); break;
                case "di":  html += getDiHtml(); break;
            }

            target.html(html);

        });

        $("#advanceForm").on("change", ".rule-value", function(){
            rule_value = $(this).val();
            rule_key   = $(this).parent().prev().children(".rule-key").val();
            
            if(!(rule_key in rule)){
                rule[rule_key] = [rule_value];
            }
            else {
                if($.inArray(rule_value, rule[rule_key]) >= 0){
                    swal( "" , "重複條件" , "warning");
                }
                else{
                    rule[rule_key].push(rule_value);
                }
            }
        });

        $("#advanceForm").on("click", ".remove-rule", function(){
            rule_key   = $(this).parent().prev().prev().children(".rule-key").val();
            rule_value = $(this).parent().prev().children(".rule-value").val();

            if(rule_key in rule){
                found = $.inArray(rule_value, rule[rule_key]);
                if(found >=0 ){
                    rule[rule_key].splice(found, 1);
                }
            }

            $(this).parent().parent().remove();
        });

        function getDeHtml(){
            @inject('departmentPresenter', 'Cyinf\Presenters\DepartmentPresenter')
            return '{!! $departmentPresenter->viewAllDepartmentOption() !!}';
        }

        function getTi1Html(){
            ti1 = ["Mon", "Tue" ,"Wed", "Thu", "Fri", "Sat", "Sun"];
            html = '';
            ti1.forEach(function(day){
                html += '<option value="'+day+'">'+day+'</option>'
            }, html);
            return html;
        }

        function getTi2Html(){
            ti2 = ["A", "1" ,"2", "3", "4", "B", "5", "6", "7", "8", "9", "C", "D", "E", "F"];
            html = '';
            ti2.forEach(function(time){
                html += '<option value="'+time+'">'+time+'</option>'
            }, html);
            return html;
        }

        function getGrHtml(){
            gr = ["一年級", "二年級", "三年級", "四年級", "研究所"];
            html = '';
            gr.forEach(function(grade, index){
                html += '<option value="'+(index+1)+'">'+grade+'</option>'
            }, html);
            return html;
        }

        function getPlHtml(){
            pl = [
                "社SS", "管CM", "理SC", "理BI", "理PH", "理CH",
                "工EN", "工MS", "工EV", "工EC", "通GE",
                "海ME", "海MA", "海MB", "文FA", "文LA"
            ];

            html = '';
            pl.forEach(function(place){
                html += '<option value="'+place+'">'+place+'</option>'
            }, html);
            return html;
        }

        function getDiHtml(){
            di = ["向度一", "向度二", "向度三", "向度四", "向度五", "向度六"];
            html = '';
            di.forEach(function(dimensions, index){
                html += '<option value="'+(index+1)+'">'+dimensions+'</option>'
            }, html);
            return html;
        }

        function advanceSearch(){

            var url = "/search/rule/" + JSON.stringify(rule);

            $.post( url , "avoid_deprecated=true", function(result) {
                courseShow.empty();
                courseShow.append( result );
                location.href = "search#searching";
            } );
        }

    </script>
@endsection