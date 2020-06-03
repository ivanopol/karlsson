<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarModelTableSeeder extends Seeder
{
    public function run()
    {
        $models = [
            [
                'title' => 'Granta',
                'slug' => Str::slug('Granta'),
                'preview' => '/build/images/photos/models/granta/granta.png',
            ],
            [
                'title' => 'Vesta',
                'slug' => Str::slug('Vesta'),
                'preview' => '/build/images/photos/models/vesta/vesta.png',
            ],
            [
                'title' => 'XRAY',
                'slug' => Str::slug('XRAY'),
                'preview' => '/build/images/photos/models/xray/xray.png',
            ],
            [
                'title' => '4x4',
                'slug' => Str::slug('4x4'),
                'preview' => '/build/images/photos/models/4x4/4x4.png',
            ],
            [
                'title' => 'Largus',
                'slug' => Str::slug('Largus'),
                'preview' => '/build/images/photos/models/largus/largus.png',
            ],
        ];

        DB::table('car_models')->insert($models);
    }
}
