<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ads', function (Blueprint $table) {
            $table->id();
            $table->string('ads_name')->nullable();
            $table->string('ads_link')->nullable();
            $table->string('ads_display')->nullable();
            $table->integer('ads_set_date_status')->default(1);
            $table->string('ads_set_date_start')->nullable();
            $table->string('ads_set_date_end')->nullable();
            $table->string('ads_img')->nullable();
            $table->text('ads_note')->nullable();
            $table->integer('ads_show')->default(2);
            $table->integer('ads_position')->nullable();
            $table->integer('ads_sort')->default(0);
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('tb_ads');
    }
}
