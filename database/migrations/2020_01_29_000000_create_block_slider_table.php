<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlockSliderTable extends Migration
{
    public function up()
    {
        Schema::create('block_sliders', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('id');
            $table->bigInteger('block_id');
            $table->string('text');
            $table->string('image');
            $table->integer('number');
        });

        Artisan::call('db:seed', [
            '--class' => BlockSliderTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block_sliders');
    }
}
