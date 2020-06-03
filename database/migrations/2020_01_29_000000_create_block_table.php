<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlockTable extends Migration
{
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('model_id')->nullable();
            $table->bigInteger('type_id')->nullable();
            $table->string('title');
            $table->integer('pointers');
            $table->boolean('show');
            $table->integer('pnum');
            $table->mediumText('text');
            $table->string('url');
            $table->string('trigger')->nullable();
        });
        Artisan::call('db:seed', [
            '--class' => BlockTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
