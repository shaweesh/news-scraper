<?php

namespace Shawish\NewsScraper\Models;

use Model;

class News extends Model
{`
    public $table = 'shawish_newsscraper_news';

    public $fillable = [
        'title', 'url', 'content', 'scraped_at'
    ];

    public $dates = ['scraped_at'];
}