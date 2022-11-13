<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInComingLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_coming_letters', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->unsignedBigInteger('secretary_added_department');
            $table->unsignedBigInteger('department_user')->nullable();
            $table->unsignedBigInteger('other_department_user')->nullable();
            $table->unsignedBigInteger('uploader_user_id');
            $table->unsignedBigInteger('action_taker_user_id')->nullable();
            $table->unsignedBigInteger('other_action_taker_user_id')->nullable();
            $table->unsignedBigInteger('gm_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('first_department_id')->nullable();
            $table->unsignedBigInteger('second_department_id')->nullable();
            $table->string('ref_no');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('remark')->nullable();
            $table->text('gm_description')->nullable();
            $table->text('head_description')->nullable();
            $table->text('other_head_description')->nullable();
            $table->text('team_description')->nullable();
            $table->text('other_team_description')->nullable();
            $table->timestamp('gm_created_at')->nullable();
            $table->timestamp('dept_created_at')->nullable();
            $table->timestamp('other_dept_created_at')->nullable();
            $table->timestamps();

            $table->foreign('secretary_added_department')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('department_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('other_department_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('uploader_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('gm_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('action_taker_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('other_action_taker_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_coming_letters');
    }
}
