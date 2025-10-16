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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('payment_id');
            $table->string('bill_name');
            $table->string('bill_email');
            $table->string('bill_orderid');
            $table->string('bill_prodid');
            $table->string('bill_authorid');
            $table->string('bill_status');
            $table->string('bill_address');
            $table->string('downloadlink');
            $table->integer('downloadlink_status');
            $table->integer('downloadlink_views');

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
        Schema::dropIfExists('billings');
    }
};
