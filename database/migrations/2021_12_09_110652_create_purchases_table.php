<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('specification');
            $table->integer('approved_by_department')->default(0);
            $table->integer('approved_by_store')->default(0);
            $table->integer('authorized')->default(0);
            $table->integer('quantity')->nullable();
            $table->integer('estimated_cost')->nullable();
            $table->string('project_name')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->boolean('is_purchased')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('approve_by_department_id')->nullable()->references('id')->on('users');
            $table->foreignId('authorized_id')->nullable()->references('id')->on('users');
            $table->foreignId('approve_by_store_id')->nullable()->references('id')->on('users');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('approved')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
