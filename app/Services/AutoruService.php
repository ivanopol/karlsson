<?php


namespace App\Services;


use App\Helpers\BrandModelsOrderHelper;
use Illuminate\Support\Facades\DB;
use Exception;
use Cache;


class AutoruService
{
    private $token = 'Vertis alphagarantPredict-280fe74a7d767b4f146e906ce90ce40b016838dd';

    private $cache;

    public $isError = false;

    private $error;

    private $url = 'https://apiauto.ru/1.0/';

    private $headers;

    public function __construct()
    {
    }

    /**
     * Получаем список брендов
     *
     * @return array
     */
    public function getBrands(): array
    {
        return $this->getCached('brands', function () {
            $brands = [];

            $rows = DB::select('select `id`, code, `title` FROM `brands` order by `order` desc, code');

            if ($rows) {
                foreach ($rows as $row) {
                    $brands[] = [
                        'id' => $row->id,
                        'label' => $row->title,
                        'code' => $row->code
                    ];
                }
            }

            return $brands;
        });
    }

    public function fetchBrands(): array
    {
        $brands = [];
        $res = $this->request('GET', 'search/cars/breadcrumbs', [
            'rid' => 50,
            'state' => 'USED',
        ]);

        if (!$this->isError && !empty($res['breadcrumbs'][0]['entities'])) {
            foreach ($res['breadcrumbs'][0]['entities'] as $brand) {
                DB::insert('insert into brands (code, title, logo) values(?, ?, ?)',
                    [
                        $brand['id'],
                        $brand['name'],
                        $brand['mark']['logo']['sizes']['logo'],
                    ]);
            }
        } else {
            throw new Exception('Brands collecting failed!');
        }

        $rows = DB::select('select `id`, `title` FROM `brands`');

        if ($rows) {
            foreach ($rows as $row) {
                $brands[] = [
                    'code' => $row->id,
                    'label' => $row->title,
                ];
            }
        }

        return $brands;
    }

    /**
     *
     * return array
     * @param $brand_id
     * @return array
     * @throws Exception
     */
    public function getModels($brand_id): array
    {
        $brand_list = DB::select('select id, code, title from brands where id = :brand_id', ['brand_id' => $brand_id]);

        if (sizeof($brand_list) == 0) {
            return [];
        }

        $brand = $brand_list[0];

        $model_list = DB::select('select * from brand_models where brand_id = :brand_id order by `order` desc ', ['brand_id' => $brand_id]);
        if (sizeof($model_list) == 0) {
            $res = $this->request('GET', 'search/cars/breadcrumbs', [
                'rid' => 50,
                'state' => 'USED',
                'bc_lookup' => $brand->code
            ]);

            if (!$this->isError && !empty($res['breadcrumbs'])) {
                foreach ($res['breadcrumbs'] as $level) {
                    if ($level['meta_level'] == 'MODEL_LEVEL') {
                        foreach ($level['entities'] as $model) {

                            $order = BrandModelsOrderHelper::setOrder($model['id']);

                            DB::insert('insert into brand_models(brand_id, code, title, `order`) values(?, ?, ?, ?)',
                                [
                                    $brand->id,
                                    $model['id'],
                                    $model['name'],
                                    $order
                                ]);
                        }
                    }
                }
            } else {
                throw new Exception('Models collecting failed!');
            }
        }
        $res = DB::select('select id, title as `label`, code from brand_models where brand_id = :brand_id order by `order` desc LIMIT 30', ['brand_id' => $brand_id]);

        $i = 1;
        foreach($res as &$row) {
            $row->number = $i;
            $i++;
        }

        return $res;
    }

    public function getGenerations($model_id)
    {
        return $this->getCached('generations' . $model_id, function () use ($model_id) {
            $brand_models = DB::select("SELECT brands.code AS brand_code, brand_models.code AS model_code
                FROM  brand_models
                JOIN brands ON brands.id = brand_models.brand_id
                WHERE brand_models.id = :model_id", ['model_id' => $model_id]);

            if (sizeof($brand_models) == 0) {
                return [];
            }

            $raw = $this->request('GET', 'search/cars/breadcrumbs', [
                'bc_lookup' => $brand_models[0]->brand_code . '#' . $brand_models[0]->model_code,
                'rid' => 50,
                'state' => 'USED',
            ]);


            $result = [];

            if (!$this->isError && !empty($raw['breadcrumbs'])) {
                foreach ($raw['breadcrumbs'] as $level) {
                    if ($level['meta_level'] == 'GENERATION_LEVEL') {
                        foreach ($level['entities'] as $row) {
                            $years = $row['super_gen']['year_from'] . '-' . (!empty($row['super_gen']['year_to']) ? $row['super_gen']['year_to'] : 'наст.время');

                            $result[] = [
                                'id' => implode('#', $brand_models) . '#' . $row['id'],
                                'text' => !empty($row['name']) ? $row['name'] . ' (' . $years . ')' : $years,
                            ];
                        }
                    }
                }
            } else {
                throw new Exception('Generations collecting failed!');
            }

            return $result;
        });
    }

    /**
     * @param $brand_code
     * @param $model_code
     * @return array
     */
    public function getComplectations($brand_code, $model_code)
    {
        return DB::select('select id, modification as label, tech_param_id from model_modifications where brand_code = :brand_code and model_code = :model_code limit 5',
            ['brand_code' => $brand_code, 'model_code' => $model_code]);
    }

    public function getEstimations($data)
    {
        return [
            'min' => 500000,
            'max' => 650000
        ];
    }

    public function getMileageRange()
    {
        return [
            1 => 'До 10 000',
            2 => '10 000 - 30 000',
            3 => '30 000 - 50 000',
            4 => '50 000 - 75 000',
            5 => '75 000 - 100 000',
            6 => '100 000 - 150 000',
            7 => '150 000 - 200 000',
            8 => 'более 200 000'
        ];
    }

    public function getYearsRange()
    {
        return range(2000, date("Y"), $step = 1);
    }


    /**
     * Запрос к Auto.ru
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @return array|mixed
     */
    private
    function request(string $method, string $url, array $data)
    {
        $this->headers = [
            'Content-Type: application/json; charset=utf-8',
            'x-authorization: ' . $this->token,
        ];

        $this->url .= $url;

        if ($method == 'GET') {
            $this->url .= '?' . http_build_query($data);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $result = curl_exec($ch);
        $json = json_decode($result, true);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if (empty($json) || $code != 200) {
            $this->error = $code . ' Unprocessed error';
            $this->isError = true;
            return [];
        }

        if ($json['status'] != 'SUCCESS') {
            $this->error = $code . ' ' . $json['detailed_error'];
            $this->isError = true;
        }

        return $json;
    }

    /**
     *
     *
     * @param $key
     * @param $callback
     * @return array
     */
    private
    function getCached($key, $callback): array
    {
        if (Cache::has($key)) {
            $data = json_decode(Cache::get($key), true);
        } else {
            $data = call_user_func($callback);
            Cache::put($key, json_encode($data));
        }

        return $data;
    }

    public function getCreditPrograms()
    {
        return DB::select('select name, percent_rate from credit_programs');
    }


    public
    function getEstimation($data)
    {
        $owners_count = 1;
        $data = json_decode($data);
        $owning_time = (int)date('Y') - $data->year;
        //$color['hex'] = 'CACECB';
        $params = [
            'rid' => 50,
            'tech_param_id' => $data->tech_param_id,
            'km_age' => (int)$data->km_age,
            'dealer_org_type' => 4,
            'owning_time' => $owning_time * 12,
            'owners_count' => $owners_count,
            'year' => $data->year,
        ];

        $res = $this->request('POST', 'stats/predict', $params);
        return $res;
    }
}
