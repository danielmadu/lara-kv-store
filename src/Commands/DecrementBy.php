<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class DecrementBy
{
    public function __invoke(array $args): bool
    {
        App::get('kv:memory')->decrement($args[0], $args[1]);
        return true;
    }
}
