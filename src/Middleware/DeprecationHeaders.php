<?php

namespace Malek\ApiVersioning\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Malek\ApiVersioning\Support\{
    ApiUsageTracker,
    ClientResolver,
    DeprecatedUsageMonitor
};

class DeprecationHeaders
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $version = app('api.version', 'unknown');
        $client = app(ClientResolver::class)->resolve($request);

        app(ApiUsageTracker::class)->track(
            $version,
            $request->route()?->uri() ?? $request->path(),
            $client
        );

        if (app()->bound('api.deprecation')) {
            $deprecation = app('api.deprecation');

            $response->headers->set('Deprecation', 'true');
            $response->headers->set('Sunset', $deprecation->sunset);

            if ($deprecation->message) {
                $response->headers->set(
                    'Warning',
                    '299 - "' . $deprecation->message . '"'
                );
            }

            app(DeprecatedUsageMonitor::class)->record($version);
        }

        return $response;
    }
}
