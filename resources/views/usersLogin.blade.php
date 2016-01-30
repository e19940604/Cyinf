@extends('layout')

@section('title' , 'Facing Counrse | Login')

@section('content')

	<article role="main" class="courseDetailContainer">
        
            <form class="form-horizontal loginForm" role="form" id="loginForm">
                <legend>Login</legend>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">學號</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="stu_id" name="stu_id" placeholder="B993040017">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">密碼</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" onchange="loginAjax()">
                    </div>
                </div>
                <div id="loginMessage" class="loginMessage"></div>
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-10">
                        
                        <a href="/users/register" style="letter-spacing:1px; margin-left:-85px;">Register</a>
                        <a href="/users/forget" style="letter-spacing:1px; margin-left: -2px;">忘記密碼</a>
                        <button type="button" class="btn" onclick="loginAjax()" >Log In</button>
                    </div>
                </div>
            </form>
           
    </article><!-- /article -->

@endsection
