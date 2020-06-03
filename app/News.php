<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'text', 'text_short', 'preview', 'slug', 'city_id'];

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'news';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    /**
     * Получаем ключ роута для таблицы.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
