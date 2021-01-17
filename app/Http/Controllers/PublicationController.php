<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Modules\AvitoParser;
use App\Modules\CianParser;
use App\Modules\DomclickParser;

class PublicationController extends Controller
{

  /**
  * Get content from html.
  *
  * @param $link string link to html page
  *
  * @return array with parsing data
  * @throws \Exception
  */
  public function loadDataFromAvito()
  {
    $publications = AvitoParser::getPageData(
      'https://www.avito.ru/kazan/kvartiry/prodam-ASgBAgICAUSSA8YQ',
      'div.iva-item-root-G3n7v',
      'a.title-root-395AQ'
    );

    if(!empty($publications))
    {
      try
      {
        Publication::publicationsSave($publications);
      }
      catch (\Exception $e) {
        // throw new PublicationsParserException("Can't parse the page", 0);
      }
    }
  }

  public function loadDataFromCian()
  {
    $publications = CianParser::getPageData(
      'https://kazan.cian.ru/cat.php?deal_type=sale&engine_version=2&offer_type=flat&region=4777&room1=1&room2=1&room3=1&room4=1&room5=1&room6=1&room7=1&room9=1',
      'article._93444fe79c--container--2pFUD',
      'a._93444fe79c--link--39cNw'
    );

    if(!empty($publications))
    {
      try
      {
        Publication::publicationsSave($publications);
      }
      catch (\Exception $e) {
        // throw new PublicationsParserException("Can't parse the page", 0);
      }
    }
  }

  public function loadDataFromDomclick()
  {
    $publications = DomclickParser::getPageData(
      'https://kazan.domclick.ru/search?address=26f533ee-f4c6-4fd8-9cb5-a1910250622e&category=living&deal_type=sale&ne=55.930791%2C49.379394%20&sw=55.603125%2C48.820561',
      'a._12VP9',
      'a._93444fe79c--link--39cNw'
    );

    if(!empty($publications))
    {
      try
      {
        Publication::publicationsSave($publications);
      }
      catch (\Exception $e) {
        // throw new PublicationsParserException("Can't parse the page", 0);
      }
    }
  }
}
