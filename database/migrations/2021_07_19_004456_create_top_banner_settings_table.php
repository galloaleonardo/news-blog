<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopBannerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_banner_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->boolean('keep_on_top_when_scrolling');
            $table->timestamps();
        });

        DB::table('top_banner_settings')->insert([
            'active' => true,
            'keep_on_top_when_scrolling' => true,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_banner_settings');
    }
}
