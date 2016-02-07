<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

	Route::get('/', 'HomeController@index');

	Route::get('/course/{course}' , 'CourseController@showCourse');

    Route::get('/search' , function(){
        return view( 'search' );
    });

    Route::get('/faq' , function(){ return view('faq'); });

    Route::get('/about' , function(){ return view('about'); });

    Route::post('/search/{method}/{query_restrict}' , 'CourseController@getSearchResult');

    Route::get('/rank' , 'HomeController@showRank');

    Route::get('/users/active/{code}', 'UserController@active');

    Route::post('/api/updateRecommendation', 'RecommendationController@update');

    Route::group(['middleware' => 'guest'], function () {

		Route::get('/users/login',    function () { return view('usersLogin'); });
		Route::get('/users/register', function () { return view('usersRegister'); });
		Route::get('/users/forget',   function () { return view('usersForget'); });
		Route::post('/users/forget/{stu_id}', 'Password_resetsController@forget');
		Route::get('/users/resetForgetPassword/{token}', 'Password_resetsController@resetForgetPasswordView');
		Route::post('/users/resetForgetPassword/{token}', 'Password_resetsController@resetForgetPassword');
		
		Route::post('/login', 'UserController@login');
		Route::post('/register', 'UserController@register');

	});

	Route::group(['middleware' => 'auth'], function () {

		Route::get('/users/logout', 'UserController@logout');

		Route::get('/users/profile', function () { return view('usersProfile'); });

		Route::post('/users/update', 'UserController@update');

		Route::post('/users/resendActiveMail', 'UserController@resendActiveMail');

		Route::get('/users/changepwd', function () { return view('usersUpdatePwd'); });

		Route::post('/users/changepwd', 'UserController@changepwd');

        Route::get('/course/judge/{course}' , 'CourseController@showCourseJudgePage');

        Route::post('/course/judge/{course}' , 'CourseController@courseJudge');

		Route::post('/pin/{course_id}/{status}' , 'UserController@pin');

		Route::get( '/favorites' , 'CourseController@showFavorite');

		Route::post( '/love/{comment_id}/{option}' , 'CommentController@loveComment' );
	});
});

