<?php

namespace App\Exceptions;

use Exception;

class PostsParserException extends Exception
{
  public function __construct($message, $code = 0, Exception $previous = null)
  {
    parent::__construct($message, $code, $previous);
    $this->code = 'PARSER_ERROR_';
  }
}
