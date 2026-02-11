<?php

namespace Malek\ApiVersioning\Support;

use Illuminate\Support\Facades\Cache;

class ApiUsageTracker
{
    public function track(string $version, string $route, string $client): void
    {
        if (!config('api-versioning.usage.enabled')) {
            return;
        }

        $key = "api_usage:$version:$client:" . md5($route);

        Cache::increment($key);
        Cache::put($key . ':last', now(), config('api-versioning.usage.ttl'));
    }
}
