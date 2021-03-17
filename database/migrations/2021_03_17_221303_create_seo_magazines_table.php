<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_magazines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_title')->nullable();
            $table->string('page_description')->nullable();
            $table->string('page_type')->nullable();
            $table->string('twitter_user')->nullable();
            $table->string('image_link')->nullable();
            $table->timestamps();
        });

        DB::table('seo_magazines')->insert(
            [
                'page_title' => 'Larazine',
                'page_description' => 'A open-source project developed in Laravel with the aim of contributing to the community, delivering a magazine site ready for use.',
                'page_type' => 'News',
                'twitter_user' => '@your-user-here',
                'image_link' => null
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
        Schema::dropIfExists('seo_magazines');
    }
}
