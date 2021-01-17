<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Formatter\LineFormatter;

class ColorizedLineFormatter extends LineFormatter
{
  const BLACK = 30;
  const RED = 91;
  const GREEN = 92;
  const YELLOW = 93;
  const BLUE = 94;
  const MAGENTA = 95;
  const CYAN = 96;
  const WHITE = 39;

  protected $defaultScheme = [
    Logger::DEBUG => ColorizedLineFormatter::CYAN,
    Logger::INFO => ColorizedLineFormatter::GREEN,
    Logger::NOTICE => ColorizedLineFormatter::BLUE,
    Logger::WARNING => ColorizedLineFormatter::YELLOW,
    Logger::ERROR => ColorizedLineFormatter::RED,
    Logger::CRITICAL => ColorizedLineFormatter::RED,
    Logger::ALERT => ColorizedLineFormatter::RED,
    Logger::EMERGENCY => ColorizedLineFormatter::RED,
  ];

  public function __construct(
    $format = null,
    $dateFormat = null,
    $allowInlineLineBreaks = false,
    $ignoreEmptyContextAndExtra = false
  ) {
    parent::__construct($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
  }

  protected function getColorByLevel($level)
  {
    return $this->defaultScheme[$level];
  }

  protected function getColoredString($string, $color)
  {
    return "\033[" . $color . 'm' . $string . "\033[0m";
  }

  public function format(array $record): string
  {
    $record['datetime'] = $record['datetime']->setTimezone(new \DateTimeZone(config('logging.timezone', 'UTC')));
    $message = parent::format($record);
    $color = $this->getColorByLevel($record['level']);
    $levelName = $record['level_name'];
    $message = str_replace($levelName, $this->getColoredString($levelName, $color), $message);
    return $message;
  }
}
