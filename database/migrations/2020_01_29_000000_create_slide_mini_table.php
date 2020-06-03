<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlideMiniTable extends Migration
{
    public function up()
    {
        Schema::create('slide_mini', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('model_id')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->string('image');
            $table->string('alt');
            $table->string('title');
            $table->boolean('active');
        });
        Artisan::call('db:seed', [
            '--class' => SlideMiniTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide_mini');
    }
}
