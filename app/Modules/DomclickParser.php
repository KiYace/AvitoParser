<?php

namespace App\Modules;

use App\Abstracts\AbstractParser;
use App\Exceptions\PublicationsParserException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class DomclickParser extends AbstractParser
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
    $html = Http::withHeaders([
      'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
      'Accept-Encoding' => 'gzip, deflate, br',
      'Accept-Language' => 'ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
      'Cache-Control' => 'max-age=0',
      'Connection' => 'keep-alive',
      'Cookie' => 'PAINT_ACTIVE_MAP__COOKIE_VITRINA=%7B%22value%22%3A2%7D; qrator_jsid=1610901184.428.jtcyHLhp5ZxuxkMc-smjcd939ttk7qnp9a43ilob2vti9srui; qrator_ssid=1610901186.766.NhB4kR8XtaU2hxCU-86d5pctfmq54flv105n4igld120t74s8; ftgl_cookie_id=49c994fe9154f08946a323601aba83b9; RETENTION_COOKIES_NAME=e23233153a744354b08cb21720cc0cb5:4fQI6Md7GbcaywZEkaYBW_bM2p0; sessionId=5008f20844ad4c829ae396a5d6539aee:CTqOzqzgO6sFFC3cUkVgPLmUdxU; UNIQ_SESSION_ID=c7803e1d7796408d85df6efe76d0e8c1:-RhUp5oEGWCY1BivKd7_ED9ZD44; _ym_uid=161090118838190898; _ym_d=1610901188; autoDefinedRegionGuid=96d8dd6c-d7e9-4dd2-9da3-2a0532dba117; _gcl_au=1.1.947688980.1610901188; _ym_isad=1; _gid=GA1.2.1928723621.1610901189; _sa=SA1.747a3817-aec7-4f83-b8be-c1d2036d36e4.1610901188; mobile-region-shown=1; top100_id=t1.4513750.1424430025.1610901189799; last_visit=1610890389805::1610901189805; region={%22data%22:{%22name%22:%22%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0%22%2C%22kladr%22:%2277%22%2C%22guid%22:%220c5b2444-70a0-4932-980c-b4dc0d3f02b5%22}%2C%22isAutoResolved%22:true}; currentRegionGuid=6c86b638-ff05-49be-a3a2-83d868611524; currentLocalityGuid=26f533ee-f4c6-4fd8-9cb5-a1910250622e; currentSubDomain=kazan; regionName=26f533ee-f4c6-4fd8-9cb5-a1910250622e:%D0%9A%D0%B0%D0%B7%D0%B0%D0%BD%D1%8C; _ga=GA1.3.2033669933.1610901188; _gid=GA1.3.1928723621.1610901189; _ga_NP4EQL89WF=GS1.1.1610901188.1.1.1610902468.57; _ga=GA1.2.2033669933.1610901188; last_visit=1610891672722::1610902472722; _ubtcuid=ckk1dqn9q00003h7iu1scswps; _sp_id.67bd=a031a681-a092-4592-9a57-02c85010a0e8.1610901208.1.1610902473.1610901208.d224af59-f7a3-4829-a44d-8d58dfcdf964; SESSION=a34f48bb-6e0f-43fd-8215-fac2d1937226',
      'Host' => 'kazan.domclick.ru',
      'If-None-Match' => 'W/"58919-rrKVorHps7riUEujNoDNvNiaNVg"',
      'sec-ch-ua' => '"Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
      'sec-ch-ua-mobile' => '?0',
      'Sec-Fetch-Dest' => 'document',
      'Sec-Fetch-Mode' => 'navigate',
      'Sec-Fetch-Site' => 'none',
      'Sec-Fetch-User' => '?1',
      'Upgrade-Insecure-Requests' => '1',
      'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
    ])->get($link);

    $crawler = new Crawler(null, $link);
    $crawler->addHtmlContent($html, 'UTF-8');

    // make array for publications
    $publications = [];

    try {
      // Find element from Avito by classname
      $publications = $crawler->filter($elementSelector)->each(function(Crawler $node, $i) use($linkSelector){

        $publication = [
          'area_name' => 'domclick',
          'post_id' => $node->children()->attr('id'),
          'link' => $node->link()->getUri(),
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
