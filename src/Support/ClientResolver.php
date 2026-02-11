<?php

namespace Malek\ApiVersioning\Support;

use Illuminate\Http\Request;

class ClientResolver
{
    public function resolve(Request $request): string
    {
        return match (config('api-versioning.client.resolver')) {
            'user' => optional($request->user())->id ?? 'guest',
            default => $request->header(
                config('api-versioning.client.header')
            ) ?? config('api-versioning.client.fallback'),
        };
    }
}
