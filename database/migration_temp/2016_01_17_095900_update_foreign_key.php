<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commentdetail' ,  function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('coursedetail');
            $table->foreign('commenter')->references('stu_id')->on('student');
        });

        Schema::table('commentjudge' ,  function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('commentdetail');
            $table->foreign('stu_id')->references('stu_id')->on('student');
        });

        Schema::table('favoritescourse' ,  function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('coursedetail');
            $table->foreign('stu_id')->references('stu_id')->on('student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
