# danielmadu/lara-kv-store

<a href="https://packagist.org/packages/danielmadu/lara-kv-store"><img src="https://img.shields.io/packagist/dt/danielmadu/lara-kv-store" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/danielmadu/lara-kv-store"><img src="https://img.shields.io/packagist/v/danielmadu/lara-kv-store" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/danielmadu/lara-kv-store"><img src="https://img.shields.io/packagist/l/danielmadu/lara-kv-store" alt="License"></a>

Lara KV Store is a simple in-memory key-value
datastore for development purpose, implemented in PHP using Redis protocol.

## Introduction

### Supported commands
The following list of commands are implemented:
* GET
* SET
* SETEX
* INCRBY
* DECRBY
* DEL
* FLUSHDB
* PING

## Quickstart example

Once [installed](#install), you can start the server by running the follow command inside your project:

```bash
$ php artisan kv:start
```

## Install

You may install Lara KV Store using the Composer package manager:

```bash
$ composer require danielmadu/lara-kv-store
```
By default, the Lara KV Store will be started at `0.0.0.0:6379`, to change the host and the port you should publish 
the Lara KV Store configuration using the `vendor:publish` Artisan command:

```bash
$ php artisan vendor:publish --provider="DanielMadu\LaraKvStore\KVStoreServiceProvider"
```

## Dashboard

To access the dashboard that you can visualize all the keys stored you may access via `/kvstore` route.


## License

MIT
