<?php

use Illuminate\Database\Seeder;

class CarModelCarTypeTableSeeder extends Seeder
{
    public function run()
    {
        $model_types = [
            ['car_model_id' => '1', 'car_type_id' => '1', 'preview' => true, 'price' => 444900, 'special_price' => 378810, 'count'=>333, 'active' => 1],
            ['car_model_id' => '1', 'car_type_id' => '2', 'preview' => false, 'price' => 461900, 'special_price' => 394110, 'count'=>333, 'active' => 1],
            ['car_model_id' => '1', 'car_type_id' => '3', 'preview' => false, 'price' => 471900, 'special_price' => 403110, 'count'=>333, 'active' => 0],
            ['car_model_id' => '1', 'car_type_id' => '4', 'preview' => false, 'price' => 499410, 'special_price' => 499410, 'count'=>333, 'active' => 1],
            ['car_model_id' => '1', 'car_type_id' => '5', 'preview' => false, 'price' => 580900, 'special_price' => 580900, 'count'=>333, 'active' => 1],
            ['car_model_id' => '1', 'car_type_id' => '6', 'preview' => false, 'price' => 461900, 'special_price' => 394110, 'count'=>333, 'active' => 0],
            ['car_model_id' => '2', 'car_type_id' => '1', 'preview' => true, 'price' => 606900, 'special_price' => 530910, 'count'=>333, 'active' => 1],
            ['car_model_id' => '2', 'car_type_id' => '7', 'preview' => false, 'price' => 688900, 'special_price' => 595710, 'count'=>333, 'active' => 1],
            ['car_model_id' => '2', 'car_type_id' => '4', 'preview' => false, 'price' => 444900, 'special_price' => 378810, 'count'=>333, 'active' => 0],
            ['car_model_id' => '2', 'car_type_id' => '8', 'preview' => false, 'price' => 791900, 'special_price' => 692010, 'count'=>333, 'active' => 1],
            ['car_model_id' => '2', 'car_type_id' => '9', 'preview' => false, 'price' => 821900, 'special_price' => 717210, 'count'=>333, 'active' => 0],
            ['car_model_id' => '2', 'car_type_id' => '10', 'preview' => false, 'price' => 1021900, 'special_price' => 893610, 'count'=>333, 'active' => 0],
            ['car_model_id' => '3', 'car_type_id' => '4', 'preview' => false, 'price' => 759900, 'special_price' => 655110, 'count'=>333, 'active' => 1],
            ['car_model_id' => '3', 'car_type_id' => '20', 'preview' => true, 'price' => 614900, 'special_price' => 521910, 'count'=>333, 'active' => 1],
            ['car_model_id' => '4', 'car_type_id' => '11', 'preview' => true, 'price' => 523900, 'special_price' => 471510, 'count'=>333, 'active' => 1],
            ['car_model_id' => '4', 'car_type_id' => '12', 'preview' => false, 'price' => 586900, 'special_price' => 539910, 'count'=>333, 'active' => 0],
            ['car_model_id' => '4', 'car_type_id' => '13', 'preview' => false, 'price' => 510210, 'special_price' => 510210, 'count'=>333, 'active' => 0],
            ['car_model_id' => '4', 'car_type_id' => '14', 'preview' => false, 'price' => 578610, 'special_price' => 578610, 'count'=>333, 'active' => 0],
            ['car_model_id' => '4', 'car_type_id' => '15', 'preview' => false, 'price' => 727900, 'special_price' => 722900, 'count'=>333, 'active' => 0],
            ['car_model_id' => '5', 'car_type_id' => '3', 'preview' => false, 'price' => 597900, 'special_price' => 495810, 'count'=>333, 'active' => 1],
            ['car_model_id' => '5', 'car_type_id' => '4', 'preview' => false, 'price' => 757900, 'special_price' => 639810, 'count'=>333, 'active' => 0],
            ['car_model_id' => '5', 'car_type_id' => '16', 'preview' => false, 'price' => 897900, 'special_price' => 897900, 'count'=>333, 'active' => 0],
            ['car_model_id' => '5', 'car_type_id' => '17', 'preview' => false, 'price' => 962900, 'special_price' => 944900, 'count'=>333, 'active' => 0],
            ['car_model_id' => '5', 'car_type_id' => '18', 'preview' => false, 'price' => 571900, 'special_price' => 476910, 'count'=>333, 'active' => 0],
            ['car_model_id' => '5', 'car_type_id' => '19', 'preview' => true, 'price' => 495810, 'special_price' => 597900, 'count'=>333, 'active' => 0],
        ];

        DB::table('car_model_car_type')->insert($model_types);
    }
}
