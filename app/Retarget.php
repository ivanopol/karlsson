<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retarget extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'img_mobile',
        'img_desktop',
        'title',
        'description',
        'count',
        'is_active',
        'city_id',
        'car_model_id',
        'car_type_id',
        'utm_tags',
    ];

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'special_offers';
}
