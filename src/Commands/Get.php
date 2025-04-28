<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class Get
{
    public function __invoke(array $args): string | null
    {
        return App::get('kv:memory')->get($args[0]);
    }
}
