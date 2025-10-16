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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('billing_id');
            $table->string('pay_transactionid');
            $table->string('bill_orderid');
            $table->double('pay_paidamount');
            $table->string('pay_currency');
            $table->double('pay_netpay');
            $table->string('pay_payerid');
            $table->string('pay_payername');
            $table->string('pay_payerEmail');
            $table->string('pay_payercountry');
            $table->string('pay_paymentsource');
            $table->string('pay_paymentstatus');

            $table->timestamps();
            // $table->index('billing_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
