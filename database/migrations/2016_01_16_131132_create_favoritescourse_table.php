<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritescourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritescourse', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->string('stu_id');
            $table->timestamps();

            /*$table->foreign('course_id')->references('id')->on('coursedetail');
            $table->foreign('stu_id')->references('stu_id')->on('student');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favoritescourse');
    }
}
