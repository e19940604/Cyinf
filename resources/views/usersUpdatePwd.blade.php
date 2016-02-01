@extends('layout')

@section('title' , 'Facing Counrse | Reset Password')

@section('content')

	<article role="main">
        <form class="form-horizontal loginForm" role="form" id="resetForm">
            <legend>Update Password</legend>
            <div class="form-group">
                <label for="old_password" class="col-sm-2 control-label">舊密碼</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control holder" id="old_password" name="old_password" placeholder="old password">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密碼</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control holder" id="password" name="password" placeholder="password">
                </div>
            </div>
            <div class="form-group">
                <label for="password_check" class="col-sm-2 control-label">密碼確認</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control holder" id="password_check" name="password_check" placeholder="type password again">
                </div>
            </div>
            <div id="loginMessage" class="loginMessage"></div>
            <div class="form-group">
                <div class="col-sm-offset-11 col-sm-1">
                    <button type="button" id="forgetReset" class="btn" onclick="resetPassword()" >Sent</button>
                </div>
            </div>
        </form>
    </article>

@endsection
