<?php

namespace Malek\ApiVersioning\Console;

use Illuminate\Console\Command;

class ApiVersionsCommand extends Command
{
    protected $signature = 'api:versions';
    protected $description = 'Show API versions summary';

    public function handle()
    {
        $this->info('API Versions available');
        return self::SUCCESS;
    }
}
