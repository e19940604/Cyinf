<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->string('stu_id')->unique()->primary();
            $table->string('passwd', 60);
            $table->string('real_name');
            $table->string('nick_name');
            $table->tinyInteger('grade');
            $table->tinyInteger('department');
            $table->enum('gender' , [ '男' , '女' ]);
            $table->string('email')->unique();
            $table->string('FB_conn');
            $table->string('hobby');
            $table->string('mobile_num');
            $table->string('introduction');
            $table->string('update_date');
            $table->string('update_time');

            $table->tinyInteger('auth');
            $table->string('thecode');
            $table->rememberToken();
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
        Schema::drop('student');
    }
}
