<?php

namespace Danielmadu\LaraKvStore;

class LaraKvStore
{

    public static function css(): string|self
    {
        $css = __DIR__.'/../dist/larakvstore.css';

        if (($contents = @file_get_contents($css)) === false) {
            throw new RuntimeException("Unable to load Lara KV Store dashboard CSS path [$css].");
        }

        return "<style>{$contents}</style>".PHP_EOL;
    }

    public static function js(): string
    {
        if (
            ($livewire = @file_get_contents(__DIR__.'/../../../livewire/livewire/dist/livewire.js')) === false &&
            ($livewire = @file_get_contents(__DIR__.'/../vendor/livewire/livewire/dist/livewire.js')) === false) {
            throw new RuntimeException('Unable to load the Livewire JavaScript.');
        }

        if (($larakvstore = @file_get_contents(__DIR__.'/../dist/larakvstore.js')) === false) {
            throw new RuntimeException('Unable to load the Lara KV Store dashboard JavaScript.');
        }

        return "<script>{$livewire}</script>".PHP_EOL."<script>{$larakvstore}</script>".PHP_EOL;
    }
}
