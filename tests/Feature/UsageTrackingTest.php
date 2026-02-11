<?php

use Illuminate\Support\Facades\Route;
use Malek\ApiVersioning\Facades\ApiRoute;

it('tracks api usage', function () {
    ApiRoute::version('v1')->group(function () {
        Route::get('/ping', fn () => 'pong');
    });

    $this->get('/v1/ping');
    $this->get('/v1/ping');

    expect(cache()->get('api_usage:v1:anonymous:' . md5('ping')))
        ->toBeGreaterThan(0);
});
