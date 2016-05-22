<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculum extends Migration
{
    /**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
        Schema::create('curriculum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stu_id' , 10 );
            $table->integer('course_id')->unsigned();
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
        Schema::drop('curriculum');
    }
}
