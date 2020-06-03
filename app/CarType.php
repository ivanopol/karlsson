<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = ['title_en', 'title_ru', 'slug'];
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'car_types';

    /**
     * Модели относящиеся к кузову.
     */
    public function models()
    {
        return $this->belongsToMany('App\CarModel');
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
}
