<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarModelTable extends Migration
{
    public function up()
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->string('preview');
        });
        Artisan::call('db:seed', [
            '--class' => CarModelTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_models');
    }
}
