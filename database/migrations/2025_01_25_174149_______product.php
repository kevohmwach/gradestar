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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('prod_title');
            $table->string('slug')->unique()->nullable();
            $table->text('prod_description');
            $table->string('prod_category');
            $table->string('prod_isbn')->nullable();
            $table->string('prod_course');
            $table->string('prod_file');
            $table->string('prod_image');
            $table->string('prod_preview');
            //$table->text('prod_preview');
            $table->float('prod_actualPrice',4,2);
            $table->float('prod_Percent_discount',4,2)->nullable();
            //$table->integer('prod_disctPrice')->nullable();
            $table->string('prod_keywords');
            // $table->string('prod_keyword2');
            // $table->string('prod_keyword3');
            $table->text('prod_extraContent');
            $table->string('prod_views')->nullable();

            $table->string('prod_meta_title');
            $table->text('prod_meta_description');

            $table->string('prod_overview1_h2')->nullable();
            $table->text('prod_overview1_descriprion')->nullable();

            $table->string('prod_overview2_h2')->nullable();
            $table->text('prod_overview2_descriprion')->nullable();

            $table->string('prod_overview3_h2')->nullable();
            $table->text('prod_overview3_descriprion')->nullable();

            $table->string('prod_overview4_h2')->nullable();
            $table->text('prod_overview4_descriprion')->nullable();

            $table->string('prod_overview5_h2')->nullable();
            $table->text('prod_overview5_descriprion')->nullable();

            $table->string('prod_overview6_h2')->nullable();
            $table->text('prod_overview6_descriprion')->nullable();

            $table->string('prod_overview7_h2')->nullable();
            $table->text('prod_overview7_descriprion')->nullable();


            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
