<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarModelCarTypeTable extends Migration
{
    public function up()
    {
        Schema::create('car_model_car_type', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigInteger('car_model_id')->unsigned();
            $table->foreign('car_model_id')->references('id')->on('car_models');
            $table->bigInteger('car_type_id')->unsigned();
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->boolean('preview');
            $table->integer('price');
            $table->integer('special_price');
            $table->integer('count');
            $table->tinyInteger('active');
        });
        Artisan::call('db:seed', [
            '--class' => CarModelCarTypeTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_model_car_type');
    }
}
