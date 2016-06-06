<?php
use Cyinf\User;
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\Favorite;
use Cyinf\Notification;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define( User::class, function (Faker\Generator $faker) {
    return [
        'stu_id'       => $faker->regexify('[BMD][0-9]{9}'),
        'passwd'       => sha1($faker->uuid),
        'real_name'    => $faker->name,
        'nick_name'    => $faker->name,
        'grade'        => $faker->numberBetween($min = 105, $max = 150),
        'department'   => $faker->numberBetween( 0 , 60 ),
        'gender'       => $faker->randomElement(array('男','女')),
        'email'        => $faker->email,
        'auth'         => $faker->numberBetween(0, 1),
        'FB_conn'      => $faker->url,
        'update_date'  => $faker->date,
        'update_time'  => $faker->time,
        'thecode'      => $faker->word,
        'remember_token' => str_random(10),
    ];
});

$factory->define( Course::class , function (Faker\Generator $faker) {
   return [
       'course_nameCH' => $faker->name,
       'course_nameEN' => $faker->name,
       'course_department' => $faker->numberBetween( 0 , 60 ),
       'professor' => $faker->name,
       'unit' => $faker->numberBetween( 0 , 4 ),
       'course_grade' => $faker->numberBetween( 0 , 6 ),
       'judge_people' => $faker->numberBetween( 0 , 1 ),
       'time1' => $faker->dayOfWeek,
       'time2' => $faker->randomElement(['234' , '567' , '12' , '34' , '56' , '78' , 'CDE' ]),
       'place' => $faker->cityPrefix,
       'course_dimensions' => 1
   ];
});

$factory->define( Comment::class, function (Faker\Generator $faker) {
    $courses = Course::all()->pluck('id');
    $users = User::all()->pluck('stu_id');

    return [
        'course_id' => $courses->random(),
        'commenter' => $users->random(),
        'teach_q' => 5 * $faker->numberBetween( 0 , 20 ),
        'time_c' => 5 * $faker->numberBetween( 0 , 20 ),
        'sign_d' => 5 * $faker->numberBetween( 0 , 20 ),
        'test_d' => 5 * $faker->numberBetween( 0 , 20 ),
        'homework_d' => 5 * $faker->numberBetween( 0 , 20 ),
        'grade_d' => 5 * $faker->numberBetween( 0 , 20 ),
        'TA_r' => 5 * $faker->numberBetween( 0 , 20 ),
        'practical_r' => 5 * $faker->numberBetween( 0 , 20 ),
        'rollCall_r' => 5 * $faker->numberBetween( 0 , 20 ),
        'nutrition_r' => 5 * $faker->numberBetween( 0 , 20 ),
        'date' => $faker->date(),
        'time' => $faker->time(),
        'description' => $faker->sentence(),
        'read' => 0,
        'love' => $faker->randomDigit,
        'dislike' => $faker->randomDigit
    ];
});


$factory->define( Favorite::class , function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define( Notification::class , function( Faker\Generator $faker ){
    $users = User::all()->pluck('stu_id');
    $courses = Course::all()->pluck('id');
    return [
        'stu_id' => $users->random(),
        'course_id' => $courses->random(),
        'content' => $faker->text('50'),
        'type' => $faker->numberBetween( 0 , 2 ),
        'is_read' => $faker->boolean(),
    ];
});

$factory->define( Curriculum::class , function( Faker\Generator $faker ){
    $users = User::all()->pluck('stu_id');
    $courses = Course::all()->pluck('id');    
    return [
        'stu_id' => $users->random(),
        'course_id' => $courses->random(),
    ];
} );