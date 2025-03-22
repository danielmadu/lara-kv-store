<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class FlushDB
{
    public function __invoke(): bool
    {
        App::get('kv:memory')->flush();
        return true;
    }
}
