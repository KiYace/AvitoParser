<?php

namespace App\Modules;

use App\Abstracts\AbstractParser;
use App\Exceptions\PublicationsParserException;
use Illuminate\Support\Facades\Http;
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
  public static function getPageData($link, $elementSelector, $linkSelector)
  {
    $html = Http::get($link);

    $crawler = new Crawler(null, $link);
    $crawler->addHtmlContent($html, 'UTF-8');

    // make array for publications
    $publications = [];

    try {
      // Find element from Avito by classname
      $publications = $crawler->filter($elementSelector)->each(function(Crawler $node, $i) use($linkSelector){
        $publication = [
          'area_name' => 'avito',
          'post_id' => $node->attr('id'),
          'link' => $node->filter($linkSelector)->link()->getUri(),
        ];

        return $publication;
      });
    } catch (\Exception $e) {
      throw new PublicationsParserException("Can't parse the page", 0);
    }

    return $publications;
  }
}


?>
