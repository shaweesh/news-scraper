<?php

namespace Shawish\NewsScraper\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Symfony\Component\BrowserKit\Browser;
use Shawish\NewsScraper\Models\News;

class NewsController extends Controller
{
    public $implement = ['Backend.Behaviors.ListController', 'Backend.Behaviors.FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['shawish.newsscraper.manage_news'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Shawish.NewsScraper', 'news-scraper');
    }

    public function scrape()
    {
        if (!Auth::check()) {
            return redirect()->to(Backend::url('backend/auth/login'));
        }

        $browser = new Browser();
        $browser->setClient(\Symfony\Component\BrowserKit\Client::createChrome(['args' => ['--headless']]));

        $url = 'https://www.maannews.net/news/1.html';
        $crawler = $browser->request('GET', $url);

        $articles = [];
        $nextLink = $crawler->filter('.prev-next-item-next')->attr('href');

        while ($nextLink) {
            $crawler = $browser->request('GET', $nextLink);

            $crawler->filter('.default__item')->each(function ($node) use (&$articles) {
                $title = $node->filter('.default__item--title')->text();
                $url = $node->filter('.default__item--title a')->attr('href');
                $image = $node->filter('.default__item--img img')->attr('data-src');
                $category = $node->filter('.default__item--category a')->text();
                $content = $node->filter('.default__item--content')->text();

                $news = News::firstOrCreate([
                    'url' => $url
                ], [
                    'title' => $title,
                    'image' => $image,
                    'category' => $category,
                    'content' => $content,
                    'scraped_at' => new \DateTime()
                ]);

                $articles[] = $news;
            });

            $nextLink = $crawler->filter('.prev-next-item-next')->attr('href');
        }

        \Flash::success('News articles scraped successfully.');

        return $this->listRefresh();
    }
    public function onScrape()
    {
        $this->scrape();
        \Flash::success('News scraping initiated.');
        return $this->listRefresh();
    }
}