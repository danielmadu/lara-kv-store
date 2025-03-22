<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class Set
{
    public function __invoke(array $args): bool
    {
        count($args) > 2
            ? App::get('kv:memory')->put($args[0], $args[2], $args[1])
            : App::get('kv:memory')->put($args[0], $args[1], 0);
        return true;
    }
}
