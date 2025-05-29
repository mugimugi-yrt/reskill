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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('address', 100);
            $table->string('station', 50);
            $table->string('tel', 15);
            $table->string('image');
            $table->string('start_time');
            $table->string('end_time');
            $table->boolean('hot_spring')->nullable();
            $table->string('genre', 50)->nullable();
            $table->integer('group_room')->nullable()->unsigned();
            $table->integer('cnt_contents')->unsigned()->default(0);
            $table->integer('cnt_star_users')->unsigned()->default(0);
            $table->integer('sum_stars')->unsigned()->default(0);
            $table->boolean('is_deleted');
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
        Schema::dropIfExists('hotels');
    }
};
