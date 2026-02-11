<?php

namespace Malek\ApiVersioning\Support;

class DeprecationContext
{
    public function __construct(
        public string $sunset,
        public ?string $message = null
    ) {}
}
