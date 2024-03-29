<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutGoingLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_going_letters', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->unsignedBigInteger('uploader_user_id');
            $table->unsignedBigInteger('project_id');
            $table->string('ref_no');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('remark')->nullable();
            $table->unsignedBigInteger('department_id');

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('uploader_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('out_going_letters');
    }
}
