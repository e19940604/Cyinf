<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('commentdetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->string('commenter', 10);
            $table->tinyInteger('teach_q');
            $table->tinyInteger('sign_d');
            $table->tinyInteger('test_d');
            $table->tinyInteger('time_c');
            $table->tinyInteger('homework_d');
            $table->tinyInteger('grade_d');
            $table->tinyInteger('TA_r');
            $table->tinyInteger('practical_r');
            $table->tinyInteger('rollCall_r');
            $table->tinyInteger('nutrition_r');
            $table->string('date');
            $table->string('time');
            $table->string('description');
            $table->tinyInteger('read');
            $table->tinyInteger('love');
            $table->tinyInteger('dislike');
            $table->timestamps();

            /*$table->foreign('course_id')->references('id')->on('coursedetail');
            $table->foreign('commenter')->references('stu_id')->on('student');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('commentdetail');
    }
}
