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
            $table->unsignedBigInteger('department_user')->nullable();
            $table->unsignedBigInteger('uploader_user_id');
            $table->unsignedBigInteger('action_taker_user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('gm_id');
            $table->string('project_name');
            $table->string('ref_no');
            $table->string('letter_type');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('remark')->nullable();
            $table->text('description')->nullable();
            $table->text('head_description')->nullable();
            $table->timestamp('gm_created_at')->nullable();
            $table->timestamp('dept_created_at')->nullable();


            $table->foreign('department_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('uploader_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gm_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('action_taker_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
