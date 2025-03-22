<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class IncrementBy
{
    public function __invoke(array $args): bool
    {
        App::get('kv:memory')->increment($args[0], $args[1]);
        return true;
    }
}
