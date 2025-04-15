<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Facades\App;

class Keys
{

    public function __invoke(): array
    {
        $reflectionObject = new \ReflectionObject(App::get('kv:memory'));
        $reflectionObject
            ->getProperty('storage')
            ->setAccessible(true);
        $keys = $reflectionObject->getProperty('storage')->getValue(App::get('kv:memory'));
        return [serialize($keys)];
    }

}
