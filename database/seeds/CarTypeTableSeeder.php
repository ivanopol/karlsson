<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CarTypeTableSeeder extends Seeder
{
    public function run()
    {
        $model_types = [
            [
                'title_ru' => 'Седан',
                'title_en' => 'Sedan',
                'slug' => Str::slug('Sedan'),
            ],
            [
                'title_ru' => 'Лифтбек',
                'title_en' => 'Liftback',
                'slug' => Str::slug('Liftback'),
            ],
            [
                'title_ru' => 'Универсал',
                'title_en' => 'Universal',
                'slug' => Str::slug('Universal'),
            ],
            [
                'title_ru' => 'Cross',
                'title_en' => 'Cross',
                'slug' => Str::slug('Cross'),
            ],
            [
                'title_ru' => 'Drive Active',
                'title_en' => 'Drive Active',
                'slug' => Str::slug('Drive Active'),
            ],
            [
                'title_ru' => 'Хэтчбек',
                'title_en' => 'Hatchback',
                'slug' => Str::slug('Hatchback'),
            ],
            [
                'title_ru' => 'SW',
                'title_en' => 'SW',
                'slug' => Str::slug('SW'),
            ],
            [
                'title_ru' => 'SW Cross',
                'title_en' => 'SW Cross',
                'slug' => Str::slug('SW Cross'),
            ],
            [
                'title_ru' => 'CNG',
                'title_en' => 'CNG',
                'slug' => Str::slug('CNG'),
            ],
            [
                'title_ru' => 'Sport',
                'title_en' => 'Sport',
                'slug' => Str::slug('Sport'),
            ],
            [
                'title_ru' => '3 дв.',
                'title_en' => '3 doors',
                'slug' => Str::slug('Three Doors'),
            ],
            [
                'title_ru' => '3 Urban дв.',
                'title_en' => 'Urban 3 doors',
                'slug' => Str::slug('Urban Three Doors'),
            ],
            [
                'title_ru' => '5 дв.',
                'title_en' => '5 doors',
                'slug' => Str::slug('Five Doors'),
            ],
            [
                'title_ru' => '5 Urban дв.',
                'title_en' => 'Urban 5 doors',
                'slug' => Str::slug('Urban Five Doors'),
            ],
            [
                'title_ru' => 'Bronto',
                'title_en' => 'Bronto',
                'slug' => Str::slug('Bronto'),

            ],
            [
                'title_ru' => 'Универсал CNG',
                'title_en' => 'Universal CNG',
                'slug' => Str::slug('Universal CNG'),
            ],
            [
                'title_ru' => 'Cross CNG',
                'title_en' => 'Cross CNG',
                'slug' => Str::slug('Cross CNG'),
            ],
            [
                'title_ru' => 'Фургон',
                'title_en' => 'Minivan',
                'slug' => Str::slug('Minivan'),
            ],
            [
                'title_ru' => 'Фургон CNG',
                'title_en' => 'Minivan CNG',
                'slug' => Str::slug('Minivan CNG'),
            ],
            [
                'title_ru' => 'XRAY',
                'title_en' => 'XRAY',
                'slug' => Str::slug('XRAY'),
            ],
            [
                'title_ru' => null, 'title_en' => null, 'slug' => null],
        ];

        DB::table('car_types')->insert($model_types);
    }
}
