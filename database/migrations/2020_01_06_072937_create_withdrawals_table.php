<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');                                     // relation with user table
            $table->integer('bank_account_id');                             // relation with user bank detail table
            $table->decimal('amount', 15, 2);
            $table->longText('remark');
            $table->string('ref_no')->unique();                             // Unique Key - FTWD000001
            $table->string('paid_transaction_id')->nullable()->unique();    // if status is paid -> Unique transaction id
            $table->string('status')->default('pending');                   // pending, paid or closed
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
        Schema::dropIfExists('withdrawals');
    }
}
