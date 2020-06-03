<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlideTable extends Migration
{
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('model_id')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->string('class');
            $table->string('title');
            $table->string('reduction');
            $table->string('subtitle');
            $table->string('link');
        });
        Artisan::call('db:seed', [
            '--class' => SlideTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
    }
}
