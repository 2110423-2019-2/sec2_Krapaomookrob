<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCoursesRequesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('courses_requester', 'course_requesters');

        Schema::table('course_requesters', function (Blueprint $table) {
            $table->dropColumn('created_at');
        });

        Schema::table('course_requesters', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->unsignedBigInteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->enum('status',['Accepted', 'Declined', 'Init', 'Pending'])->default('Init');
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
        Schema::table('courses_request', function (Blueprint $table) {
            //
        });
    }
}
