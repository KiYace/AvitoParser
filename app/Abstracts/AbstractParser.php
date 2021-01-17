<?php

namespace App\Abstracts;

abstract class AbstractParser
{
  /**
  * Get content from html.
  *
  * @param $link string link to html page
  *
  * @return array with parsing data
  * @throws \Exception
  */
  abstract public static function getPageData();
}


?>
