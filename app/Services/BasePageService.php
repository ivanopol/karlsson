<?php


namespace App\Services;


use App\Retarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BasePageService
{
    public function get_base_page_data($car_model, $car_type, $city)
    {
        $condition = [
            ['model_id', '=', $car_model->id],
            ['type_id', '=', $car_type->id],
        ];

        // Получаем информацию по блокам
        $blocks_ids = [];
        $blocks = DB::table('blocks')->select('*')->where($condition)->get();

        if ($blocks) {
            foreach ($blocks as $block) {
                $blocks_ids[] = $block->id;
            }
        }

        $blocks_slider = DB::table('block_sliders')->select('*')->whereIn('block_id', $blocks_ids)->orderBy('id', 'asc')->get();

        if ($blocks && $blocks_slider) {
            foreach ($blocks as &$block) {
                $block->slider = [];

                foreach ($blocks_slider as $slider) {
                    if ($block->id == $slider->block_id) {
                        $block->slider[$slider->number] = $slider;
                    }
                }
            }
        }

        // Получаем информацию по слайдам
        $slides = DB::table('slides')->select('*')->where($condition)->get();


        foreach ($slides as &$slide) {
            $slide->link = '/' . $city . '/' . $car_model->slug . '/' . $car_type->slug . $slide->link;
        }



        $slide_mini = DB::table('slide_mini')->select('*')->where([
            ['model_id', '=', $car_model->id],
            ['active', '=', true],
        ])->get();

        // Создаем ссылки и формируем массив для мини слайдера
        // с ссылками и указываем активный слайд
        $car_types = DB::select('SELECT `ct`.`slug`, `ct`.`id`
                                FROM `car_types` as `ct`
                                INNER JOIN `car_model_car_type` as `cmct` ON `cmct`.`car_type_id`=`ct`.`id`
                                 WHERE `cmct`.`car_model_id`=:model_id ORDER BY `ct`.`id` ASC', ['model_id' => $car_model->id]);

        $active_slide = 0;
        foreach ($slide_mini as $key => &$slide) {
            foreach ($car_types as $type) {
                if ($slide->type_id == $type->id) {
                    $slide->url = '/' . $city . '/' . $car_model->slug . '/' . $type->slug;
                }

                if ($slide->type_id == $car_type->id && $slide->model_id == $car_model->id) {
                    $slide->active = 1;
                    $active_slide = $key;
                } else {
                    $slide->active = 0;
                }
            }
        }

        // Получаем информацию по отзывам и по цветам
        $reviews = DB::table('reviews')->select('*')->where($condition)->get();
        $colors = DB::table('colors')->select('*')->where($condition)->get();

        if (count($slides)) {
            $slides = $slides[0];
        }

        $model_full = '';
        if (strtolower($car_model->title) === 'xray') {
            $model_full = $car_model->title;
        } else {
            $model_full = $car_model->title . ' ' . $car_type->title_ru;
        }

        $data = [
            'slider' => [
                'slides_mini' => $slide_mini,
                'slides' => $slides,
                'active' => $active_slide,
            ],
            'blocks' => $blocks,
            'reviews' => $reviews,
            'colors' => $colors,
            'model' => $car_model->title,
            'type' => $car_type->title_ru,
            'model_id' => $car_model->id,
            'type_id' => $car_type->id,
            'model_full' => $model_full,
        ];

        return $data;
    }

    /**
     * Получаем путь к изображению кузова
     *
     * @param integer $model_id ID модели
     * @param integer $type_id ID кузова
     *
     * @return array
     */
    public function getCarPreviewPath(int $model_id, int $type_id) {
        $path = [];

        $row = DB::table('slide_mini')
                        ->select(['image', 'alt'])
                        ->where([
                            ['model_id', '=', $model_id],
                            ['type_id', '=', $type_id],
                        ])
                        ->limit(1)
                        ->get()
                        ->toArray();

        if ($row[0]) {
            $path = $row[0];
            $path->image = str_replace('mobile/', '', $path->image);
        }
        return $path;
    }

    /**
     * Получаем данные для ретаргетинговой страницы
     *
     * @param Retarget $retarget
     * @param Request $request Параметры запроса
     *
     * @return array
     */
    public function getRetargetOffers(Retarget $retarget, Request $request) : object
    {
        $result = [];
        $params = $request->all();

        if (isset($params['utm_campain'])) {
            switch($params['utm_campain']) {
                case 'test':
                    $result = $retarget->find(2);
                    break;
                default:
                    $result = $retarget->find(1);
                    break;
            }

        } else {
            $result = $retarget->find(1);
        }

        return $result;
    }
}
