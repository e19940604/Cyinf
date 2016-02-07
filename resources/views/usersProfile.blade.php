@extends('layout')

@section('title' , 'Facing Counrse | Profile')

@section('content')
	<article role="main">
		<h1 style="margin-bottom: -45px;">PROFILE /</h1>
        
		<form class="form-horizontal loginForm" role="form" id="memberForm">   
            <p style="padding-left: 0px;"><span class="textFix">Last Update : {!! \Auth::user()->updated_at !!}</span></p><br />
            <div class="form-group">
                <label for="studnet_id" class="col-sm-2 control-label">學號</label>
                <div class="col-sm-10">
                    <label class="radio-inline" id ="studnet_id" style="padding-left:0px; letter-spacing: 3px;">
                    {!! \Auth::user()->stu_id !!}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">信箱</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control holder" id="email" name="email" value={!! \Auth::user()->email !!} placeholder="archerwindy@gmail.com">
                </div>
            </div>                    
            <div class="form-group">
                <label for="real" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="real_name" name="real_name" value={!! \Auth::user()->real_name !!} >
                </div>
            </div>
            <div class="form-group">
                <label for="nick" class="col-sm-2 control-label">暱稱</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="nick_name" name="nick_name" value={!! \Auth::user()->nick_name !!} >
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
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" id="gender" name="gender" value="男" {!! (\Auth::user()->gender == "男") ? 'checked' : '' !!} disabled> 男
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="gender" name="gender" value="女" {!! (\Auth::user()->gender == "女") ? 'checked' : '' !!} disabled> 女
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="auth" class="col-sm-2 control-label">認證</label>
                <div class="col-sm-8">                    
                    <label class="radio-inline" style="padding-left:0px; letter-spacing: 3px;">
                    
                    @if(Auth::user()->auth == 0)
                    	未認證會員（ Limited ） <br>
                    	<span id="resent" ><a onclick="resentmail() " >重新寄送驗證信 ( Resent Confirmed Mail ) </a></span></br>
                    	如果還是收不到驗證信請參考 <a href="faq">F.A.Q頁面</a> 第二項
                    @else
                    	中山會員（ Authenticated )
                    @endif
                    <div id="mailMessage" class="loginMessage" style="padding-left: 0%; text-align: left;"></div>
                    </label>
                </div>
                
            </div>
            
            <div id="loginMessage" class="loginMessage"></div>
			<div class="form-group">
                <div class="col-sm-offset-10 col-sm-10">
                    <button type="button" class="btn" onclick="goReset()" >Reset &nbsp;&nbsp; Password</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-10 col-sm-10">
                    <button type="button" class="btn" onclick="memberAjax()" >Update</button>
                </div>
            </div>                
        </form>
        
        <h3 style="width:85%; margin: 0 auto"><span class="textFix">Your Comments /</span></h3><br />
		<div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="width:85%; margin: 0 auto">
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
                	@inject('usersProfilePresenter', 'Cyinf\Presenters\UsersProfilePresenter')
                    {!! $usersProfilePresenter->viewUserCommentCourses() !!}
                </tbody>
            </table>
        </div>
        <h3 style="width:85%; margin: 0 auto"><span class="textFix">Recommendation Course /</span></h3><br />
        <div data-spy="scroll" data-target="#navbarExample" data-offset="0" class="scrollspy-example" style="width:85%; margin: 0 auto">
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
                <tbody id="recommendation">
                    {!! $usersProfilePresenter->viewRecommendation() !!}
                </tbody>
            </table>
        </div>
		<div class="statistic" style="width:85%; margin: 0 auto">
            <h3><span class="textFix">Personal Statistics /</span></h3>
            <ul>
            	{!! $usersProfilePresenter->viewUserCommentJudgeList() !!}
            </ul>
        </div>

	</article><!-- /article -->

@endsection
