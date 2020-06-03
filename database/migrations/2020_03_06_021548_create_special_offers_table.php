<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('img_mobile')->nullable();
            $table->string('img_tablet')->nullable();
            $table->string('img_desktop')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('count')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('car_model_id')->nullable();
            $table->integer('car_type_id')->nullable();
            $table->string('utm_tags')->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => SpecialOffersTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offers');
    }
}
