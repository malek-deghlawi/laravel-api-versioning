<?php

use Illuminate\Support\Facades\Route;
use Malek\ApiVersioning\Facades\ApiRoute;

it('allows versioned api routes', function () {
    ApiRoute::version('v1')->group(function () {
        Route::get('/test', fn () => 'ok');
    });

    $this->get('/v1/test')->assertOk();
});
