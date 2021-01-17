<?php

namespace App\Exceptions;

use Exception;

class MethodNotAllowed extends Exception
{
  public function __construct($message, $code = 0, Exception $previous = null)
  {
    parent::__construct($message, $code, $previous);
    $this->code = 'METHOD_NOT_ALLOWED_ERROR';
  }
}
