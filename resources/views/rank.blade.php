@extends('layout')

@section('title' , "Favorite Courses" )
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )

@section('content')
    <article role="main">
        <h1 id="top">RANK /</h1>

        <!-- Use ul and li with css to modify the tag area to a clean version -->
        <ul class="rankTag">
            <li><a href="#like" class="scroll"><i class="glyphicon glyphicon-tags"></i>Like&nbsp; Top 10</a></li>
            <li><a href="#rank" class="scroll"><i class="glyphicon glyphicon-tags"></i>Rank&nbsp; Top 10</a></li>
            <li><a href="#comment" class="scroll"><i class="glyphicon glyphicon-tags"></i>Comment&nbsp; Top 10</a></li>
        </ul>
        <ul class="rankTag">
            <li><a href="#universe" class="scroll"><i class="glyphicon glyphicon-tags"></i>通識博雅</a></li>
            <li><a href="#service" class="scroll"><i class="glyphicon glyphicon-tags"></i>服務學習</a></li>
            <li><a href="#cross" class="scroll"><i class="glyphicon glyphicon-tags"></i>跨院選修</a></li>
            <li><a href="#pipe" class="scroll"><i class="glyphicon glyphicon-tags"></i>管學院</a></li>
            <li><a href="#technology" class="scroll"><i class="glyphicon glyphicon-tags"></i>工學院</a></li>
            <li><a href="#science" class="scroll"><i class="glyphicon glyphicon-tags"></i>理學院</a></li>
            <li><a href="#arts" class="scroll"><i class="glyphicon glyphicon-tags"></i>文學院</a></li>
            <li><a href="#social" class="scroll"><i class="glyphicon glyphicon-tags"></i>社科院</a></li>
            <li><a href="#ocean" class="scroll"><i class="glyphicon glyphicon-tags"></i>海科院</a></li>
        </ul>

        <br /><br />

        <h3 id="like">Like / &nbsp;&nbsp; Top 10</h3>
        <!--div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 520px"-->
        <table class="table table-hover showSearchTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Professor</th>
                <th>Department</th>
                <th>Grade</th>
                <th>Comment description</th>
                <th>Like</th>
                <th>Dislike</th>
                <th>Rank</th>
            </tr>
            </thead>
            <tbody id="courseShow" >
                @foreach( $topLike as $key => $course )
                    <tr>
                        <td>{{ $key + 1  }}</td>
                        <td><a href="/course/{{ $course->id }}"> {{ $course->course_nameCH }}</a></td>
                        <td>{{ $course->professor  }}</td>
                        <td>{{ $coursePresenter->getDepartmantNameByCode( $course->course_department) }}</td>
                        <td>{{ $coursePresenter->getGradeNameByNum( $course->course_grade ) }}</td>
                        <td><div class=\"rankDescription\">{!!  nl2br( $course->description ) !!}</div></td>
                        <td>{{ $course->love }}</td>
                        <td>{{ $course->dislike }}</td>
                        <td>{{ $course->current_rank }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!--/div-->

        <br /><hr /><br />

        <h3 id="rank">Rank /&nbsp;&nbsp; Top 10 &nbsp;<a href="#top" class="scroll"><i class="glyphicon glyphicon-arrow-up"></i></a></h3>
        <!--div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 520px"-->
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
                <th>Pin</th>
            </tr>
            </thead>
            <tbody id="courseShow" >
                @foreach( $topRank as $key => $course )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="/course/{{ $course->id }}">{{ $course->course_nameCH }}</a></td>
                        <td>{{ $course->professor }}</td>
                        <td>{!! $coursePresenter->getDepartmantNameByCode( $course->course_department) !!}
                        <td>{{ $coursePresenter->getGradeNameByNum( $course->course_grade ) }}</td>
                        <td>{{ $course->judge_people }}</td>
                        <td>{{ $course->current_rank }}</td>
                        <td>{!! $coursePresenter->getPinBtn( $course->id ) !!}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>
        <!--/div-->

        <br /><hr /><br />

        <h3 id="comment">Comment /&nbsp;&nbsp; Top 10 &nbsp;<a href="#top" class="scroll"><i class="glyphicon glyphicon-arrow-up"></i></a></h3>
        <!--div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 520px"-->
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
                <th>Pin</th>
            </tr>
            </thead>
            <tbody id="courseShow" >
            @foreach( $topComment as $key => $course )
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="/course/{{ $course->id }}">{{ $course->course_nameCH }}</a></td>
                    <td>{{ $course->professor }}</td>
                    <td>{!! $coursePresenter->getDepartmantNameByCode( $course->course_department) !!}
                    <td>{{ $coursePresenter->getGradeNameByNum( $course->course_grade ) }}</td>
                    <td>{{ $course->judge_people }}</td>
                    <td>{{ $course->current_rank }}</td>
                    <td>{!! $coursePresenter->getPinBtn( $course->id ) !!}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <!--/div-->

        @foreach( $topDepartment as $key => $dep )
            <br /><hr /><br />

            <h3 id="{{ $key }}">{{ $coursePresenter->depNameMap( $key )  }} /&nbsp;&nbsp; Top 10 &nbsp;<a href="#top" class="scroll"><i class="glyphicon glyphicon-arrow-up"></i></a></h3>
            <!--div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 520px"-->
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
                    <th>Pin</th>
                </tr>
                </thead>
                <tbody id="courseShow">
                @foreach( $dep as $key => $course )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="/course/{{ $course->id }}">{{ $course->course_nameCH }}</a></td>
                        <td>{{ $course->professor }}</td>
                        <td>{!! $coursePresenter->getDepartmantNameByCode( $course->course_department) !!}
                        <td>{{ $coursePresenter->getGradeNameByNum( $course->course_grade ) }}</td>
                        <td>{{ $course->judge_people }}</td>
                        <td>{{ $course->current_rank }}</td>
                        <td>{!! $coursePresenter->getPinBtn( $course->id ) !!}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <!--/div-->

        @endforeach
    </article>
@endsection

@section('scriptArea')
    <script  type="text/javascript">

    </script>
@endsection