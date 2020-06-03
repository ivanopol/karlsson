<?php

namespace App\Http\Router;

use \Illuminate\Contracts\Routing\UrlRoutable as UrlRoutable;
use App\CarModel;
use App\CarType;
use App\City;


class CityPath implements UrlRoutable
{
    public $city;
    public $car_model;
    public $car_type;

    public function withCity(?City $city): self
    {
        $clone = clone $this;
        $clone->city = $city;
        return $clone;
    }

    public function withModel(?CarModel $car_model): self
    {
        $clone = clone $this;
        $clone->car_model = $car_model;
        return $clone;
    }

    public function withType(?CarType $car_type): self
    {
        $clone = clone $this;
        $clone->car_type = $car_type;
        return $clone;
    }

    public function getRouteKey()
    {

    }

    public function getRouteKeyName() : string
    {
        return 'car_path';
    }

    public function resolveRouteBinding($value) {
        $chunks = explode('/', $value);

        /** @var City|null $city */
        $city = null;
        do {
            $slug = reset($chunks);
            if ($slug && $next = City::where('alias', $slug)->first()) {
                $city = $next;
                array_shift($chunks);
            }
        } while (!empty($slug) && !empty($next));

        /** @var CarModel|null $car_model */
        $car_model = null;
        do {
            $slug = reset($chunks);
            if ($slug && $next = CarModel::where('slug', $slug)->first()) {
                $car_model = $next;
                array_shift($chunks);
            }
        } while (!empty($slug) && !empty($next));

        /** @var CarType|null $car_type */
        $car_type = null;
        do {
            $slug = reset($chunks);
            if ($slug && $next = CarType::where('slug', $slug)->first()) {
                $car_type = $next;
                array_shift($chunks);
            }
        } while (!empty($slug) && !empty($next));

        if (!empty($chunks)) {
            abort(404);
        }

        return $this
            ->withCity($city)
            ->withModel($car_model)
            ->withType($car_type);
    }
}
