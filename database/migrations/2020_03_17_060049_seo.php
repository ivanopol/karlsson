<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Seo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url')->unique();
            $table->string('title');
            $table->string('header')->nullable();
            $table->string('description')->nullable();
            $table->string('og_locale')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_image')->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => SeoTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
}
