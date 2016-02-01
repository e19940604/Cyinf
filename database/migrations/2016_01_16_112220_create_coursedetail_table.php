<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursedetail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_nameCH');
            $table->string('course_nameEN');
            $table->string('course_department');
            $table->string('professor');
            $table->tinyInteger('unit');
            $table->tinyInteger('course_grade');
            $table->integer('current_rank')->default(1200);
            $table->integer('judge_people')->default(0);
            $table->integer('teach_quality')->default(50);
            $table->integer('time_cost')->default(50);
            $table->integer('sign_dif')->default(50);
            $table->integer('test_dif')->default(50);
            $table->integer('homework_dif')->default(50);
            $table->integer('grade_dif')->default(50);
            $table->integer('TA_rank')->default(50);
            $table->integer('practical_rank')->default(50);
            $table->integer('roll_freq')->default(50);
            $table->integer('nutrition_rank')->default(50);
            $table->string('time1');
            $table->string('time2');
            $table->string('place');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coursedetail');
    }
}
