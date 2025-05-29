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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('ruby',50);
            $table->string('password');
            $table->string('email',100);
            $table->string('tel',15);
            $table->string('company',50);
            $table->date('birthday');
            $table->string('address',100);
            $table->string('gender');
            $table->boolean('get_notice');
            $table->boolean('is_admin');
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
        Schema::dropIfExists('users');
    }
};
