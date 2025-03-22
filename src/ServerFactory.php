<?php

namespace Danielmadu\LaraKvStore;

use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;
use React\Socket\ServerInterface;
use React\Socket\SocketServer;

class ServerFactory
{
    public static function make(
        string $host,
        string $port,
        LoopInterface $loop = null,
    ): ServerInterface
    {
        $loop = $loop ?: Loop::get();
        $uri = "{$host}:{$port}";

        return new SocketServer(
            $uri,
            [],
            $loop
        );
    }
}
