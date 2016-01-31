@extends('layout')

@section('title' , 'Facing Counrse | Reset Forget Password')

@section('content')

	<article role="main">
        <form class="form-horizontal loginForm" role="form" id="forgetForm">
            <legend>Reset Forget Password</legend>
            <div class="form-group">
                <label for="studnet_id" class="col-sm-2 control-label">學號</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control holder" id="stu_id" name="stu_id" placeholder="B993040017">
                </div>
            </div>
            <div id="loginMessage" class="loginMessage"></div>
            <div class="form-group">
                <div class="col-sm-offset-11 col-sm-1">
                    <button type="button" id="forgetReset" class="btn" onclick="forgetAjax()" >Sent</button>
                </div>
            </div>
        </form>
    </article>

@endsection
