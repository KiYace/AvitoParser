<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class LogListener extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'log:listen {--type=}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Listen log';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $type = 'api';
    if ($this->option('type') == 'sql') {
      $type = 'sql';
    }
    if ($this->option('type') == 'laravel') {
      $type = 'laravel';
    }
    Process::fromShellCommandline(
      'tail -f ' . $type . ($type != 'laravel' ? '-' . date('Y-m-d') : '') . '.log',
      storage_path('logs')
    )
      ->setTty(true)
      ->setTimeout(null)
      ->run(function ($type, $line) {
        $this->output->write($line);
      });
  }
}
