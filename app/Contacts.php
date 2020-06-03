<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'city_id',
        'address',
        'phone',
        'email',
        'fb_url',
        'instagram_url',
        'vk_url',
        'youtube_url',
        'ok_url'
    ];

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'contacts';

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

}
