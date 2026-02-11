<?php

namespace Malek\ApiVersioning\Facades;

use Illuminate\Support\Facades\Facade;

class ApiRoute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Malek\ApiVersioning\Routing\VersionedRouteRegistrar::class;
    }
}
