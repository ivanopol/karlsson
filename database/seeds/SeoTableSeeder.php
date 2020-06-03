<?php

use Illuminate\Database\Seeder;

class SeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seo = [
/*            'url' => 'perm',
            'title' => 'Тест Тест Тест',
            'header' => 'Test Test Test',
            'description' => 'Описание'*/
        ];

        DB::table('seo')->insert($seo);
    }
}
