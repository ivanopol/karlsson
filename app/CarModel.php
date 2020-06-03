<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'preview',
        'price',
        'special_price',
        'count',
        'active',
    ];
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'car_models';

    /**
     * Кузовы относящиеся к модели авто c превью.
     */
    public function types_preview()
    {
        return $this->belongsToMany('App\CarType')->using('App\CarModelCarType')->withPivot('preview')->wherePivot('preview', 1);
    }

    /**
     * Кузовы относящиеся к модели авто без превью.
     */
    public function types()
    {
        return $this->belongsToMany('App\CarType')->using('App\CarModelCarType')->withPivot('preview', 'price')->wherePivot('active', 1);
    }

    /**
     * Получить модели с ценам по кузовам.
     */
    public function prices()
    {
        return $this->hasOne('App\CarType');
    }

    /**
     * Получаем ключ роута для таблицы.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Получаем список автомобилей с ценой
     *
     * @return array
     */
    public function getAllCars() : array
    {
        $car_list_tmp = $this::with('types')->get();
        return $this->formatCarList($car_list_tmp);
    }


    /**
     * Приводим массив автомобилей в удобный формат
     *
     * @param $car_list_tmp
     * @return array
     */
    private function formatCarList($car_list_tmp) : array
    {
        if (!$car_list_tmp) {
            return [];
        }

        $car_list_formatted = [];

        $i=0;
        foreach ($car_list_tmp as $car) {
            foreach ($car->types as $info) {
                $label = strtolower($car->title) === strtolower($info->title_ru) ? $car->title : $car->title . ' ' . $info->title_ru;

                $car_list_formatted[] = [
                    'id' => $i,
                    'label' => $label,
                    'code' => $info->pivot->price,
                    'number' => $i,
                ];
                $i++;
            }


        }

        return $car_list_formatted;
    }
}
