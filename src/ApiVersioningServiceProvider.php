<?php

namespace Malek\ApiVersioning;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Malek\ApiVersioning\Console\{
    ApiVersionsCommand,
    ApiDeprecatedCommand,
    ApiUsageCommand,
    ApiAlertsCommand
};
use Malek\ApiVersioning\Middleware\{
    ResolveApiVersion,
    DeprecationHeaders
};
use Malek\ApiVersioning\Routing\VersionedRouteRegistrar;
use Malek\ApiVersioning\Support\{
    ApiUsageTracker,
    ClientResolver,
    DeprecatedUsageMonitor
};

class ApiVersioningServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/api-versioning.php',
            'api-versioning'
        );

        $this->app->singleton(VersionedRouteRegistrar::class);
        $this->app->singleton(ApiUsageTracker::class);
        $this->app->singleton(ClientResolver::class);
        $this->app->singleton(DeprecatedUsageMonitor::class);
    }

    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__ . '/../config/api-versioning.php'
                => config_path('api-versioning.php'),
        ], 'api-versioning-config');

        $router->aliasMiddleware('api.version', ResolveApiVersion::class);
        $router->pushMiddlewareToGroup('api', DeprecationHeaders::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ApiVersionsCommand::class,
                ApiDeprecatedCommand::class,
                ApiUsageCommand::class,
                ApiAlertsCommand::class,
            ]);
        }
    }
}
