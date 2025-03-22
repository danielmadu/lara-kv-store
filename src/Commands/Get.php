<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;
use function Laravel\Prompts\info;

class Get
{
    public function __invoke(array $args): string | null
    {
        $value = App::get('kv:memory')->get($args[0]);
        return $value;
    }
}
