<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',30);
            $table->string('lastname',30);
            $table->string('email')->unique();
            $table->longText('password');

            $table->string('contact',20);
            $table->string('dob');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->string('pincode',10);
            $table->longText('address');
            $table->string('email_verified')->default('no');
            $table->string('status')->default('active');
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
}
