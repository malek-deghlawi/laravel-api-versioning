<?php

namespace Malek\ApiVersioning\Support;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DeprecatedUsageMonitor
{
    public function record(string $version): void
    {
        if (!config('api-versioning.alerts.enabled')) {
            return;
        }

        $window = now()->format('YmdHi');
        $key = "api_deprecated_hits:$version:$window";

        $count = Cache::increment($key);

        if ($count === config('api-versioning.alerts.threshold')) {
            Log::critical('Deprecated API usage spike detected', [
                'version' => $version,
                'hits' => $count,
            ]);
        }
    }
}
