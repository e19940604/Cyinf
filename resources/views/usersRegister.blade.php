@extends('layout')

@section('title' , 'Facing Counrse | Register')

@section('content')

    <article role="main" class="courseDetailContainer">
        
        <div class="registerLaw">
            <h2>Terms of Service</h2>
            <p><h5>註冊即視為已閱讀且同意下列須知事項，若有疑義，歡迎聯絡我們。</h5><br />
                <!-- １、限中山大學學生申請註冊。<br /> -->
                １、註冊資料信箱一欄不一定要填學校信箱，但為確認身分，註冊認證信會寄至學校信箱（學號@student.nsysu.edu.tw）。<br />
                ２、未註冊者也可檢視課程及評論，但欲評論課程必須註冊且完成認證程序。<br />
                ３、所有評論皆為匿名，但請對自己的言論負責。<br />
                ４、曾在Airstage課程評鑑評論過者不需也不可再次評論同一門課。<br />
                ５、會員的個人資料不會在會員沒有同意的情況下為第三者所見。<br />
                ６、為求最佳瀏覽體驗，建議不要使用Internet Explorer各版本瀏覽器。</p>
        </div>
        
        <!--div class="selectIdentity" id="checkIdentity">
            <p>請選擇身分：</p>
            <button type="button" id="nsysuStudent" class="btn" onclick="showNsysuForm()">中山學生</button>
            <button type="button" id="teacher" class="btn" onclick="showTeacherForm()">教授、教職員</button>
            <button type="button" id="otherStudent" class="btn" onclick="showOtherForm()">外校學生</button>
        </div>
        <button id="registerBack" class="btn backBtn" onclick="registerBack()">back</button-->
        <form class="form-horizontal loginForm" role="form" id="registerForm">
            
            <legend>Register</legend>
            <div class="form-group">
                <label for="studnet_id" class="col-sm-2 control-label">學號</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="stu_id" name="stu_id" placeholder="B993040017">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">信箱</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control holder" id="email" name="email" placeholder="b993040017@student.nsysu.edu.tw">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密碼</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control holder" id="password" name="password" placeholder="Password" >
                </div>
            </div>
            <div class="form-group">
                <label for="passwordCheck" class="col-sm-2 control-label">驗證</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control holder" id="password_check" name="password_check" placeholder="Type password again" >
                </div>
            </div>
            <div class="form-group">
                <label for="real" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="real_name" name="real_name" placeholder="Real name">
                </div>
            </div>
            <div class="form-group">
                <label for="nick" class="col-sm-2 control-label">暱稱</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="nick_name" name="nick_name" placeholder="Nick name">
                </div>
            </div>
            <div class="form-group">
                <label for="department" class="col-sm-2 control-label">系所</label>
                <div class="col-sm-10">
                    <select class="form-control holder" name="department" id="department">
                        @inject('departmentPresenter', 'Cyinf\Presenters\DepartmentPresenter')
                        {!! $departmentPresenter->viewDepartmentOption() !!}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="grade" class="col-sm-2 control-label">級數</label>
                <div class="col-sm-10">
                    <select class="form-control holder" name="grade" id="grade">
                        @inject('gradePresenter', 'Cyinf\Presenters\GradePresenter')
                        {!! $gradePresenter->viewGradeOption() !!}
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="gender" class="col-sm-2 control-label">性別</label>
                <div class="col-sm-10" id="gender" >
                    <label class="radio-inline">
                        <input type="radio"  name="gender" value="男"> Male（男）
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value="女"> Female（女）
                    </label>
                </div>
            </div>
            
            <div id="loginMessage1" class="loginMessage"></div>
            <div class="form-group">
                <div class="col-sm-offset-10 col-sm-10">
                    <button type="button" id="registerBtn" class="btn" onclick="registerAjax(1)" >Register</button>
                </div>
            </div>
        </form><!-- /form1 -->

    </article>
@endsection

@section('scriptArea')
    <script  type="text/javascript">
        $(function() {

            $("input").bind("focusout", function(){
                $(this).removeClass("error_field");
            })

        });
    </script>
@endsection
