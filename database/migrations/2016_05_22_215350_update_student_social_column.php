<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudentSocialColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {

            if (Schema::hasColumn('hobby', 'mobile_num' , 'introduction')) {
                $table->dropColumn('hobby');
                $table->dropColumn('mobile_num');
                $table->dropColumn('introduction');
            }

            
            $table->boolean('class_note')->default( true );
            $table->boolean('go_class_note')->default( true );
            $table->boolean('test_note')->default( true );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
