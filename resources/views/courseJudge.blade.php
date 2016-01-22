@extends('layout')

@section('title' , "Judge " . $course->course_nameEN )
@inject( 'coursePresenter' , 'Cyinf\Presenters\CoursePresenter' )

@section('content')
    <article role="main" >
        <h1>{{ $course->course_nameEN }}/</h1>

        <br />

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
                <td class="courseTitle">{{ $coursePresenter->getDepartmantNameByCode( $course->course_department) }}</td>
                <td class="courseTitle">{{ $course->unit }}</td>
                <td class="courseTitle">{{ $course->current_rank }}</td>
                <td class="courseTitle">{{ $course->judge_people }}</td>
            </tr>
            </tbody>
        </table>

        <form role="judgement" method="post" action="/course/judge/{{ $course->id }}" id="commentDetails" >
            <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
            <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
            <p>* 若對該項評論沒有意見的話，請維持 50 分的中間值。</p>
            <table class="table table-hover courseTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 10%"><i class="glyphicon glyphicon-edit"></i> &nbsp;項目</th>
                    <th><i class="glyphicon glyphicon-question-sign"></i> &nbsp;評鑑說明</th>
                    <th style="width:59%"><i class="glyphicon glyphicon-sort"></i> &nbsp;目前評價</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td class="courseTitle">教授品質</td>
                    <td>教材與授課品質，愈大愈優異</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgePassiveBtnGenerator( $i ) }}">
                                    <input type="radio" name="teach" id="teach" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="courseTitle">實用程度</td>
                    <td>課程應用實用度，愈大愈實用</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgePassiveBtnGenerator( $i ) }}">
                                    <input type="radio" name="practical" id="practical" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="courseTitle">助教強度</td>
                    <td>助教能力表現，愈大愈強</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgePassiveBtnGenerator( $i ) }}">
                                    <input type="radio" name="TA" id="TA" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td class="courseTitle">開放程度</td>
                    <td>緊繃與沈重度，愈大愈開放</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgePassiveBtnGenerator( $i ) }}">
                                    <input type="radio" name="nutrition" id="nutrition" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="courseTitle">考試難度</td>
                    <td>課程考試難度，愈大愈難</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="test" id="test" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="courseTitle">作業難度</td>
                    <td>課程作業難度，愈大愈難</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="homework" id="homework" value={{ ($i+1)*10 }}>{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="courseTitle">得分難度</td>
                    <td>高分總成績難度，愈大愈難</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="grade" id="grade" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="courseTitle">耗時程度</td>
                    <td>花費時間的比例，愈大愈耗時</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="time" id="time" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="courseTitle">點名頻率</td>
                    <td>上課時的點名頻率，愈大愈高</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="roll" id="roll" value={{ ($i+1)*10 }} >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="courseTitle">加簽難度</td>
                    <td>課程加簽難度，愈大愈難</td>
                    <td>
                        <div class="btn-group" data-toggle="buttons">
                            @for( $i = 0 ; $i < 10 ; $i++ )
                                <label class="btn {{ $coursePresenter->judgeNegativeBtnGenerator( $i ) }}">
                                    <input type="radio" name="sign" id="sign" value={{ ($i+1)*10 }}  >{{  ($i+1)*10 }}
                                </label>
                            @endfor
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

            <h3 class="textFix"><i class="glyphicon glyphicon-comment"></i> &nbsp;Comments </h3>

            <textarea class="form-control" rows="12" id="comments" name="comments" placeholder="請對自己的言論負責，顯示均為匿名，共可評鑑1500字。"></textarea>

            <br />
            <div id="loginMessage" class="loginMessage"></div>

            <a href="#loginMessage" onclick="courseJudgeAjax()"><h3 class="textFix" style="text-align: right"><i class="glyphicon glyphicon-send"></i> &nbsp;SEND COMMENT</h3></a>

        </form>

    </article><!-- /article -->
@endsection

@section('scriptArea')
    <script  type="text/javascript">
        @if(  session()->has('error'))
                    swal( "錯誤！" ,  {!! '"' . session('error') . '"' !!} , "error");
        @endif
    </script>
@endsection