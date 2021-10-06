<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetBannerShowToTbSettingAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_setting_ads', function (Blueprint $table) {
            $table->integer('set_banner_show')->default(2)->after('set_head_show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_setting_ads', function (Blueprint $table) {
            //
        });
    }
}
