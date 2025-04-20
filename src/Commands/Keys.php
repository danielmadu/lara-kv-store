<?php

namespace Danielmadu\LaraKvStore\Commands;

use Illuminate\Support\Carbon;
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
        foreach ($keys as $key => $item) {
            $expiresAt = $item['expiresAt'] ?? 0;
            if ($expiresAt !== 0 && (Carbon::now()->getPreciseTimestamp(3) / 1000) >= $expiresAt) {
                App::get('kv:memory')->forget($key);
            }
        }
        return [serialize($keys)];
    }

}
