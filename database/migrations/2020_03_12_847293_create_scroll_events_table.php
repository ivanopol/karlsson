<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrollEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scroll_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('previous_position')->nullable();
            $table->integer('position');
            $table->integer('page_height');
            $table->dateTime('timestamp');
            $table->string('location');
            $table->string('user_ip');
            $table->string('bp_uid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scroll_events');
    }
}
