<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $fillable = [
        'url',
        'title',
        'header',
        'description',
        'og_locale',
        'og_type',
        'og_title',
        'og_description',
        'og_url',
        'og_image',
    ];

    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'seo';
}
