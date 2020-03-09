<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('amount');
            $table->enum('status',['init','failed', 'expired', 'pending', 'reversed', 'successful'])->default('init');
            $table->string('omise_id')->nullable();
            $table->unsignedBigInteger('transferred_by')->nullable();
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('bank_account');
            $table->timestamps();
            $table->foreign('requested_by')->references('id')->on('users');
            $table->foreign('transferred_by')->references('id')->on('users');
            $table->foreign('bank_account')->references('id')->on('bank_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_requests');
    }
}
