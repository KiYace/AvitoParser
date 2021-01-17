<?php

namespace App\Modules;

use App\Abstracts\AbstractParser;
use App\Exceptions\PostsParserException;
use Symfony\Component\DomCrawler\Crawler;

class AvitoParser extends AbstractParser
{

  /**
  * Get content from html.
  *
  * @param $link string link to html page
  *
  * @return array with parsing data
  * @throws \Exception
  */
  public static function getPageData()
  {
    $html = file_get_contents('https://www.avito.ru/kazan/kvartiry/prodam-ASgBAgICAUSSA8YQ');

    $crawler = new Crawler(null, 'https://www.avito.ru/kazan/kvartiry/prodam-ASgBAgICAUSSA8YQ');
    $crawler->addHtmlContent($html, 'UTF-8');

    // make array for posts
    $posts = [];

    try {
        // Find element from Avito by classname
        $posts = $crawler->filter('div.items-items-38oUm > div.iva-item-root-G3n7v')->each(function(Crawler $node, $i){
          $publication = [
            'area_name' => 'avito',
            'post_id' => $node->attr('id'),
            'link' => $node->filter('a.title-root-395AQ')->getUri()
          ];

          return $publication;
        });
    } catch (\Exception $e) {
        throw new PostsParserException("Can't parse the page", 0);
    }

    dd($posts);
  }
}


?>
