@extends('layout')
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )


@section('title' , $course->course_nameEN )

@section('content')

    <article role="main">
        <h1 style="width:900px">{{ $course->course_nameEN  }} /</h1><br />
        <div class="back-to-search">
            <a href="search#slide-3" style="font-size:16px">Back To Search &nbsp;<i class="glyphicon glyphicon-circle-arrow-left"></i></a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th><i class="glyphicon glyphicon-book"></i> &nbsp;課程名稱</th>
                <th><i class="glyphicon glyphicon-user"></i> &nbsp;開課教授</th>
                <th><i class="glyphicon glyphicon-globe"></i> &nbsp;開課系所</th>
                <th><i class="glyphicon glyphicon-plus"></i> &nbsp;課程學分</th>
                <th><i class="glyphicon glyphicon-sort"></i> &nbsp;目前評價</th>
                <th><i class="glyphicon glyphicon-search"></i> &nbsp;評分人數</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="courseTitle">{{ $course->course_nameCH }}</td>
                <td class="courseTitle">{{ $course->professor }}</td>
                <td class="courseTitle">
                    {{ $coursePresenter->getDepartmantNameByCode( $course->course_department ) }}
                </td>
                <td class="courseTitle">{{ $course->unit }}</td>
                <td class="courseTitle">{{ $course->current_rank }}</td>
                <td class="courseTitle">{{ $course->judge_people }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table table-hover">
            <thead>
            <tr>
                <th><i class="glyphicon glyphicon-calendar"></i> &nbsp;上課星期</th>
                <th><i class="glyphicon glyphicon-time"></i> &nbsp;上課時間</th>
                <th><i class="glyphicon glyphicon-map-marker"></i> &nbsp;教室位置</th>
                <th><i class="glyphicon glyphicon-heart"></i> &nbsp;&nbsp;&nbsp;Pin&nbsp;&nbsp;</th>
                <th><i class="glyphicon glyphicon-repeat"></i> &nbsp;評鑑狀況</th>

            </tr>
            </thead>
            <tbody>
            <tr>

                <td class="courseTitle">{{ $course->time1 }}</td>
                <td class="courseTitle">{{ $course->time2 }}</td>
                <td class="courseTitle">{{ $course->place }}</td>
                <!-- todo fix pin function -->
                <td id="pinArea{{ $course->id }}">{!! $coursePresenter->getPinBtn( $course->id ) !!}</td>
                <!-- todo fix comment function -->
                <td class="coursTitle">{!!  $coursePresenter->getCommentBtn( $course->id ,$is_commented ) !!}</td>

            </tr>
            </tbody>
        </table>


        <table class="table table-hover courseTable">
            <thead>
            <tr>
                <th>#</th>
                <th><i class="glyphicon glyphicon-edit"></i> &nbsp;評鑑項目</th>
                <th><i class="glyphicon glyphicon-question-sign"></i> &nbsp;項目說明</th>
                <th style="width:45%"><i class="glyphicon glyphicon-sort"></i> &nbsp;目前評價</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td class="courseTitle">教材與講授品質</td>
                <td>教材準備與授課品質，愈大愈優異。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->positiveColor( $course->teach_quality )  }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:{{ $course->teach_quality }}%">
                            {{ $course->teach_quality . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td class="courseTitle">實用程度</td>
                <td>課程的應用與實用程度，愈大愈實用。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->positiveColor( $course->practical_rank ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->practical_rank }}%">
                            {{ $course->practical_rank . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td class="courseTitle">助教強度</td>
                <td>助教的能力與表現，愈大愈強。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->positiveColor( $course->TA_rank ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->TA_rank }}%">
                            {{ $course->TA_rank. '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td class="courseTitle">開放程度</td>
                <td>上課緊繃與沈重度，愈大愈開放。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->positiveColor( $course->nutrition_rank ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->nutrition_rank }}%">
                            {{ $course->nutrition_rank . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td class="courseTitle">考試難度</td>
                <td>課程考試難度，愈大愈難。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->test_dif ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->test_dif }}%">
                            {{ $course->test_dif . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td class="courseTitle">作業難度</td>
                <td>課程作業難度，愈大愈難。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->homework_dif ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->homework_dif }}%">
                            {{ $course->homework_dif . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td class="courseTitle">得分難度</td>
                <td>取得高分總成績的難度，愈大愈難。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->grade_dif ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{  $course->grade_dif }}%">
                            {{ $course->grade_dif . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td class="courseTitle">耗時程度</td>
                <td>所花費時間的比例程度，愈大愈耗時。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->time_cost) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{  $course->time_cost}}%">
                            {{ $course->time_cost . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td class="courseTitle">點名頻率</td>
                <td>上課時的點名頻率，愈大愈高。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->roll_freq ) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{  $course->roll_freq}}%">
                            {{ $course->roll_freq . '%'}}
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td class="courseTitle">加簽難度</td>
                <td>課程加簽難度，愈大愈難。</td>
                <td>
                    <div class="progress progress-striped active">
                        <div class="progress-bar {{ $coursePresenter->negativeColor( $course->sign_dif) }}"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{  $course->sign_dif }}%">
                            {{ $course->sign_dif . '%' }}
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <h3 class="textFix"><i class="glyphicon glyphicon-comment"></i> &nbsp;Comments</h3>

        <ul id="myTab" class="nav nav-tabs">
            <li><a href="#2013" data-toggle="tab"><span class="textFix">2013</span></a></li>
            <li><a href="#2014" data-toggle="tab"><span class="textFix">2014</span></a></li>
            <li><a href="#2015" data-toggle="tab"><span class="textFix">2015</span></a></li>
            <li class="active"><a href="#2016" data-toggle="tab"><span class="textFix">2016</span></a></li>
        </ul>

        <div class="tab-content">

            @foreach( $comments as $year => $per_year_comments )
            <div class="fade tab-pane fade in {{ $coursePresenter->activeLatestCommentTab($year) }}" id="{{ $year }}">
                <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example">
                    {!!  $coursePresenter->checkCommentExist( $per_year_comments , $year )  !!}
                    @foreach( $per_year_comments as $comment )
                    <br />
                    <p>
                        <span class="textFixRaleway">{{ $comment->date . '   ' . $comment->time  }}</span> &nbsp;&nbsp;&nbsp;

                        <span class="textFixRaleway" id="loveArea{{ $comment->id }}">{{ $comment->love }}</span>
                        <a class="glyphicon glyphicon-thumbs-up" onclick="commentJudge({{ $comment->id }}, 1)"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="textFixRaleway" id="dislikeArea{{ $comment->id }}">{{ $comment->dislike }}</span>
                        <a class="glyphicon glyphicon-thumbs-down" onclick="commentJudge({{ $comment->id }}, 0)"></a>
                    </p>
                    <p>{!!   nl2br( $comment->description ) !!}</p>
                    @endforeach

                </div><!-- /scrollspy -->
            </div><!-- /tab-pane -->
            @endforeach

        </div><!-- /tab-content -->
        <p style="height:300px;"></p>
    </article><!-- /article -->

@endsection

@section('scriptArea')
    <script  type="text/javascript">

        @if(  session()->has('success') )
            swal( "恭喜！" , {!! '"' . session('success') . '"' !!} , "success");
        @elseif(  session()->has('error'))
            swal( "錯誤！" ,  {!! '"' . session('error') . '"' !!} , "error");
        @endif


    </script>
@endsection