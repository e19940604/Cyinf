<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentjudgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentjudge', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned();
            $table->string('stu_id' , 10 );
            $table->tinyInteger('result');
            $table->timestamps();

            /*$table->foreign('comment_id')->references('id')->on('commentdetail');
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
        Schema::drop('commentjudge');
    }
}
