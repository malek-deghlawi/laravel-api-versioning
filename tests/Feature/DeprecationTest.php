<?php

use Illuminate\Support\Facades\Route;
use Malek\ApiVersioning\Facades\ApiRoute;

it('adds deprecation headers', function () {
    ApiRoute::version('v2')
        ->deprecated('2026-01-01', 'Upgrade')
        ->group(function () {
            Route::get('/old', fn () => 'old');
        });

    $this->get('/v2/old')
        ->assertHeader('Deprecation', 'true')
        ->assertHeader('Sunset', '2026-01-01');
});
