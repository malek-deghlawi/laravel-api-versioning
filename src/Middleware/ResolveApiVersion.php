<?php

namespace Malek\ApiVersioning\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResolveApiVersion
{
    public function handle(Request $request, Closure $next, string $version)
    {
        $requested =
            $request->header(config('api-versioning.resolver.header')) ??
            $request->query(config('api-versioning.resolver.query')) ??
            $version;

        if ($requested !== $version) {
            abort(404, 'API version mismatch');
        }

        return $next($request);
    }
}
