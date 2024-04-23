# News Scraper Plugin

A plugin for scraping news articles from various sources.

## Features

- Scrape news articles from multiple sources
- Save scraped articles to a database
- View and manage scraped articles in the backend
- Set up and customize scraping sources and frequency

## Requirements

- PHP 7.4 or higher
- October CMS 2.1 or higher
- Symfony/BrowserKit 5.4 or higher

## Installation

1. Install the plugin via the October CMS backend or by running the following command in your terminal:

   ```
   composer require shawish/news-scraper
   ```

2. Add the plugin to your `plugins.yaml` file:

   ```yaml
   shawish/news-scraper:
     enabled: true
   ```

3. Run the following command in your terminal to install the plugin's database schema:

   ```
   php artisan october:migrate
   ```

## Configuration

1. Add the following code to your `config/app.php` file to configure the plugin's environment variables:

   ```php
   'shawish' => [
       'news_scraper' => [
           'sources' => [
               'source1' => [
                   'url' => 'https://example.com/news',
                   'interval' => 60,
               ],
               // Add more sources as needed
           ],
       ],
   ],
   ```

2. Configure the plugin's backend menu and reports by adding the following code to your `config/backend.php` file:

   ```php
   'backend' => [
       'menu' => [
           'shawish' => [
               'label' => 'Shawish',
               'icon' => 'icon-news',
               'url' => Backend::url('shawish/news-scraper/news'),
               'permissions' => ['shawish.news_scraper.manage_news'],
               'order' => 500,
               'group' => 'system',
               'sideMenu' => [
                   'news' => [
                       'label' => 'News',
                       'icon' => 'icon-news',
                       'url' => Backend::url('shawish/news-scraper/news'),
                       'permissions' => ['shawish.news_scraper.manage_news'],
                   ],
               ],
           ],
       ],
       'reports' => [
           'shawish' => [
               'last_scrape' => [
                   'label' => 'Last Scrape',
                   'context' => 'shawish.news_scraper',
                   'permissions' => ['shawish.news_scraper.manage_news'],
               ],
           ],
       ],
   ],
   ```

## Usage

1. Navigate to the backend and go to the `Shawish` menu, then click on `News` to view and manage scraped articles.
2. Click on the `Scrape News` button to start scraping news articles from the configured sources.
3. The plugin will automatically scrape articles according to the configured interval.

## Contributing

We welcome contributions to the project. Please fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License.

## Support

If you encounter any issues or have any questions, please open an issue on the project's GitHub page.

## Acknowledgements

Thanks to the October CMS community for their support and contributions.

## Maintainers

- Shawish
