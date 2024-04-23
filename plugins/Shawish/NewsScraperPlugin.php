<?php

namespace Shawish\NewsScraper;

use Backend;
use System\Classes\PluginBase;

class NewsScraperPlugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'Shawish.news-scraper',
            'description' => 'A plugin for scraping news articles',
            'author' => 'Shawish',
            'icon' => 'icon-leaf',
        ];
    }

    public function registerNavigation()
    {
        return [
            'news-scraper' => [
                'label' => 'News Scraper',
                'url' => Backend::url('shawish/newsscraper/news'),
                'icon' => 'icon-leaf',
                'permissions' => ['shawish.newsscraper.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            \Shawish\NewsScraper\Components\NewsList::class => 'newsList',
        ];
    }

    public function registerPermissions()
    {
        return [
            'shawish.newsscraper.manage_news' => [
                'tab' => 'News Scraper',
                'label' => 'Manage news articles',
            ],
        ];
    }
}