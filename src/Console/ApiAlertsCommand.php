<?php

namespace Malek\ApiVersioning\Console;

use Illuminate\Console\Command;

class ApiAlertsCommand extends Command
{
    protected $signature = 'api:alerts';
    protected $description = 'Show API alerts';

    public function handle()
    {
        $this->info('API alerts status');
        return self::SUCCESS;
    }
}
