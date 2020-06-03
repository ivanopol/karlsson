<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarTypeTable extends Migration
{
    public function up()
    {
        Schema::create('car_types', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('slug')->nullable();
        });
        Artisan::call('db:seed', [
            '--class' => CarTypeTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_types');
    }
}
