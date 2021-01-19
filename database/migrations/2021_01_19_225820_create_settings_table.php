<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    const ENGLISH = 1;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->string('company_name')->nullable();
            $table->string('company_logo_link')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert(
            [
                'language_id' => self::ENGLISH,
                'company_name' => null,
                'company_logo_link' => null
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
