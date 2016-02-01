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

    </section>

@endsection

@section('scriptArea')
    <script  type="text/javascript">

    </script>
@endsection