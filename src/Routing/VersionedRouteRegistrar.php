<?php

namespace Malek\ApiVersioning\Routing;

use Illuminate\Support\Facades\Route;
use Malek\ApiVersioning\Support\DeprecationContext;

class VersionedRouteRegistrar
{
    protected ?DeprecationContext $deprecation = null;

    public function version(string $version): self
    {
        Route::prefix($version)
            ->middleware("api.version:$version");

        app()->instance('api.version', $version);

        return $this;
    }

    public function deprecated(string $sunset, ?string $message = null): self
    {
        $this->deprecation = new DeprecationContext($sunset, $message);
        app()->instance('api.deprecation', $this->deprecation);

        return $this;
    }

    public function group(\Closure $routes): void
    {
        Route::group([], $routes);

        app()->forgetInstance('api.deprecation');
    }
}
