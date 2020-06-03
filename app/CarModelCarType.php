<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CarModelCarType extends Pivot
{
    protected $fillable = ['car_model_id', 'car_type_id', 'preview', 'price', 'special_price', 'count'];

    protected $table = 'car_model_car_type';

}
