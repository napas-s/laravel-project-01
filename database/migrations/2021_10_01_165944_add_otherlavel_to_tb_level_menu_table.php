<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherlavelToTbLevelMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_level_menu', function (Blueprint $table) {
            $table->integer('l_banner')->after('l_ads')->default(0);
            $table->integer('l_setting_ads')->after('l_setting')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_level_menu', function (Blueprint $table) {
            //
        });
    }
}
