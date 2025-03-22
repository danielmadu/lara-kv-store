<?php

namespace Danielmadu\LaraKvStore\Console;

use Danielmadu\LaraKvStore\Commands\DecrementBy;
use Danielmadu\LaraKvStore\Commands\Delete;
use Danielmadu\LaraKvStore\Commands\FlushDB;
use Danielmadu\LaraKvStore\Commands\Get;
use Danielmadu\LaraKvStore\Commands\IncrementBy;
use Danielmadu\LaraKvStore\Commands\Select;
use Danielmadu\LaraKvStore\Commands\Set;
use Clue\Redis\Protocol\Factory as ProtocolFactory;
use Clue\Redis\Protocol\Model\Request;
use Clue\Redis\Protocol\Parser\RequestParser;
use Danielmadu\LaraKvStore\ServerFactory;
use Illuminate\Console\Command;
use React\EventLoop\Loop;
use React\Socket\ConnectionInterface;
use function Laravel\Prompts\intro;

class Start extends Command
{
    protected $signature = 'kv:start
                {--host= : The IP address the server should bind to}
                {--port= : The port the server should listen on}';

    protected $description = 'Start the KV server';

    public function handle()
    {
        intro('Starting KV store...');

        $this->info('Press CTRL+C to exit.');

        $loop = Loop::get();

        $config = $this->laravel['config']['kvstore'];

        $server = ServerFactory::make(
            $host = $this->option('host') ?: $config['host'],
            $port = $this->option('port') ?: $config['port'],
            $loop
        );
        $protocol = new ProtocolFactory();
        $parser = new RequestParser();
        $serializer = $protocol->createSerializer();
        $server->on('connection', function (ConnectionInterface $connection) use ($parser, $serializer) {
            $connection->on('data', function ($data) use ($connection, $parser, $serializer) {
                $messages = $parser->pushIncoming($data);
                foreach ($messages as $message) {
                    /* @var Request $message */
                    $response = $this->command($message);
                    $connection->write(
                        match ($response) {
                            is_bool($response) => $serializer->getStatusMessage('OK'),
                            1 => $serializer->getStatusMessage('PONG'),
                            0 => $serializer->getErrorMessage('ERR Unknown or disabled command \'' . $message->getCommand() . '\''),
                            default =>  $serializer->getReplyMessage($response),
                        }
                    );
                }
            });

            $connection->on('close', function () {
                $this->components->info('Closed connection.');
            });
        });
        $this->components->info("Server started at {$host}:{$port}");
        $loop->run();
    }

    public function command(Request $request): string|int|bool|null
    {
//        $this->components->info('Command received: ' . $request->getCommand());
        $args = $request->getArgs();

        return match ($request->getCommand()) {
            'GET' => (new Get)($args),
            'SET', 'SETEX' => (new Set)($args),
            'SELECT' => (new Select)($args),
            'INCRBY' => (new IncrementBy)($args),
            'DECRBY' => (new DecrementBy)($args),
            'DEL' => (new Delete)($args),
            'FLUSHDB' => (new FlushDB)(),
            'PING' => 1,
            default => 0,
        };
    }
}
