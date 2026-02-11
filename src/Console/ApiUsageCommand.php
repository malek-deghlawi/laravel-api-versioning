<?php

namespace Malek\ApiVersioning\Console;

use Illuminate\Console\Command;

class ApiUsageCommand extends Command
{
    protected $signature = 'api:usage';
    protected $description = 'Show API usage';

    public function handle()
    {
        $this->info('API usage data');
        return self::SUCCESS;
    }
}
