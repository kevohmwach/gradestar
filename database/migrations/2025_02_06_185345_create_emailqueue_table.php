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
        Schema::create('emailqueue', function (Blueprint $table) {
            $table->id();
            $table->string('email_email');
            $table->string('email_subject');
            $table->text('email_body');
            $table->string('email_type');
            $table->integer('email_status');
            $table->integer('email_retry');

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
        Schema::dropIfExists('emailqueues');
    }
};
