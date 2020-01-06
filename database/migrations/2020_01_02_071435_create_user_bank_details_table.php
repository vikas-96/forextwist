<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');                         // relation with user table
            $table->string('nick_name');
            $table->integer('bank_name');                       // relation with bank table
            $table->string('account_holder_name');
            $table->integer('account_number');
            $table->string('ifsc_code');
            $table->string('branch_name');
            $table->integer('country');                         // relation with country table
            $table->integer('state');                           // relation with state table
            $table->string('city');
            $table->string('status',10)->default('active');     // active or inactive
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
        Schema::dropIfExists('bank_details');
    }
}
