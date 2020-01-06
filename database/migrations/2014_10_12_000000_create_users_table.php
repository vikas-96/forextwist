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
            $table->string('account_no',20)->unique();                  // unique number -> FT00000001
            $table->string('firstname',30);
            $table->string('lastname',30);
            $table->string('email')->unique();
            $table->longText('password');
            $table->string('contact',20);

            $table->date('dob')->nullable();
            $table->integer('country')->nullable();                     // relation with country
            $table->integer('state')->nullable();                       // relation with state
            $table->string('city')->nullable();
            $table->string('pincode',8)->nullable();
            $table->longText('address')->nullable();
            $table->string('email_verified')->default('no')->nullable();// yes or no
            $table->string('status')->default('active');                // active or inactive
            $table->softDeletes();                                      // if deleted
            $table->string('email_verification_token')->nullable();
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
