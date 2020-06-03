<?php


use App\Services\AutoruService;
use Illuminate\Database\Seeder;

class ModelModificationsTableSeeder extends Seeder
{
    public function run()
    {
        $path = str_replace('/database/seeds', '/resources/data', __DIR__);

        $brands = DB::select('select code from brands');
        foreach ($brands as $brand) {
            $files = glob($path . '/packages_' . $brand->code . '#*');
            foreach ($files as $file) {
                $handle = fopen($file, 'r');

                $model_code = explode('#', $file)[1];

                $content = fread($handle, filesize($file));

                $json_array = json_decode($content);

                foreach ($json_array as $json) {
                    DB::insert('insert into model_modifications (model_code, brand_code, modification, tech_param_id) values (?, ?, ?, ?)',
                        [
                            $model_code,
                            $brand->code,
                            $json->text,
                            $json->id
                        ]);
                }
            }
        }
    }
}
