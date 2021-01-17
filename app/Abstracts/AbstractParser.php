<?php

namespace App\Abstracts;

abstract class AbstractParser
{
  /**
  * Get content from html.
  *
  * @param $link string link to html page
  * @param $elementSelector string selector to DOM element
  * @param $linkSelector string selector to link element
  *
  * @return array with parsing data
  * @throws \Exception
  */
  abstract public static function getPageData($link, $elementSelector, $linkSelector);
}


?>
