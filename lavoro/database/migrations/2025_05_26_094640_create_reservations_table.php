<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();//外部キー追加
            $table->bigInteger('plan_id')->unsigned()->index();//外部キー追加
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('num_user');
            $table->text('content')->default('');
            $table->integer('num_star')->default(0);
            $table->boolean('is_deleted');
            $table->timestamps();

            //外部キー設定
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
