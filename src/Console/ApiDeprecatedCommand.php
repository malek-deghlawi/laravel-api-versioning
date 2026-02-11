<?php

namespace Malek\ApiVersioning\Console;

use Illuminate\Console\Command;

class ApiDeprecatedCommand extends Command
{
    protected $signature = 'api:deprecated';
    protected $description = 'List deprecated APIs';

    public function handle()
    {
        $this->info('Deprecated APIs');
        return self::SUCCESS;
    }
}
