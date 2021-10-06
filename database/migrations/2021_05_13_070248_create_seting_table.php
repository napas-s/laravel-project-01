<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_setting', function (Blueprint $table) {
            $table->id();
            $table->string('set_logoweb')->nullable();
            $table->string('set_nameweb')->nullable();
            $table->string('set_detail')->nullable();
            $table->string('set_keyword')->nullable();
            $table->string('set_tel')->nullable();
            $table->string('set_fax')->nullable();
            $table->string('set_email')->nullable();
            $table->string('set_idline')->nullable();
            $table->string('set_youtube')->nullable();
            $table->string('set_twitter')->nullable();
            $table->string('set_instagram')->nullable();
            $table->string('set_facebook')->nullable();
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('seting');
    }
}
