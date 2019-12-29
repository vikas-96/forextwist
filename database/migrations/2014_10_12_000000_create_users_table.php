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

            $table->date('dob')->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode',8)->nullable();
            $table->longText('address')->nullable();
            $table->string('email_verified')->default('no')->nullable();
            $table->string('status')->default('active');
            $table->integer('deleted_at')->nullable();
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
