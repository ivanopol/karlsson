<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCityTable extends Migration
{
    public function up(){
        Schema::create('cities', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->collation = 'utf8mb4_general_ci';
            $table->bigIncrements('id');
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('alias');
            $table->string('city_dative');
            $table->string('callback_emails');
            $table->string('callback_service_emails');
            $table->string('coordinates');
            $table->string('jivosite_token');
            $table->text('open_script')->nullable();
            $table->text('begin_script')->nullable();
            $table->text('end_script')->nullable();
            $table->integer('bitrix_responsible_id');
        });
        Artisan::call('db:seed', [
            '--class' => CityTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
