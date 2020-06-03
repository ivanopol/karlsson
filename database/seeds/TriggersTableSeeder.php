<?php

use Illuminate\Database\Seeder;

class TriggersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $triggers = [
            [
                'text' => '90% клиентов рады, что выбрали отечественный авто и не переплачивают за обслуживание',
                'type' => 2,
            ],
            [
                'text' => 'Большинство клиентов считает :model лучшим автомобилем по соотношению цена/качество',
                'type' => 2,
            ],
            [
                'text' => '95% клиентов оставили положительные отзывы о :model',
                'type' => 3,
            ],
        ];

        DB::table('triggers')->insert($triggers);
    }
}
