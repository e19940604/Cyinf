@extends('layout')

@section('title' , "Favorite Courses" )
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )

@section('content')
    <article role="main">
        <h1>FAVORITES /</h1>
        <p><strong>功能說明：</strong><br />Pin 功能可以幫助使用者於茫茫課海中新增想關注的課程，就不用每次都重新搜尋。</p>
        <br />
        <div>
            <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="height: 600px; padding:0 20px 0 20px">
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

                    @foreach( $favorites as $key => $course )
                    <tr id="courseArea{{ $course->id }}">
                        <td>{{ intval( $key + 1 ) }}</td>
                        <td><a href="/course/{{ $course->id }}">{{ $course->course_nameCH }}</a></td>
                        <td>{{ $course->professor }}</td>
                        <td>
                            {{ $coursePresenter->getDepartmantNameByCode( $course->course_department ) }}
                        </td>
                        <td>
                            {{ $coursePresenter->getGradeNameByNum( $course->course_grade ) }}
                        </td>
                        <td>{{ $course->judge_people }}
                        <td>{{ $course->current_rank }}
                        <td id='pinArea"{{ $course->id }}"'><a href='#searching' class='glyphicon glyphicon-remove' onclick='favoriteAjax( {{ $course->id }} )'></a></td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </article><!-- /article -->
@endsection

@section('scriptArea')
    <script  type="text/javascript">

    </script>
@endsection