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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hotel_id')->unsigned()->index();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 0)->unsigned();
            $table->integer('max_guest')->unsigned();
            $table->boolean('meal');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_deleted');
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
