<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class Delete
{
    public function __invoke(array $args): bool
    {
        App::get('kv:memory')->forget($args[0]);
        return true;
    }
}
