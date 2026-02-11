<?php

namespace Malek\ApiVersioning\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Malek\ApiVersioning\ApiVersioningServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [ApiVersioningServiceProvider::class];
    }
}
