<?php
use Cyinf\User;
use Cyinf\Comment;
use Cyinf\Course;
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
        'hobby'        => $faker->word,
        'mobile_num'   => $faker->randomNumber(9),
        'introduction' => 'B'.$faker->randomNumber(9),
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
   ];
});

$factory->define( Comment::class, function (Faker\Generator $faker) {
   return [
       'course_id' => $faker->randomDigit,
       'commenter' => $faker->randomElement( ['B' , 'M' , 'I'] ). $faker->randomNumber(9),
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
