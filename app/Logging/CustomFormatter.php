<?php

namespace App\Logging;

class CustomFormatter
{
  public function __invoke($logger)
  {
    foreach ($logger->getHandlers() as $handler) {
      $formatter = new ColorizedLineFormatter(
        "[%datetime%] %level_name% %message% %context% %extra%\n",
        'c',
        true,
        true
      );
      //   $formatter->setJsonPrettyPrint(true);
      $handler->setFormatter($formatter);
    }
  }
}
