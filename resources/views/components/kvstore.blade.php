@use('Danielmadu\LaraKvStore\LaraKvStore')
@props(['cols' => 12, 'fullWidth' => false])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>Lara KV Store</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600" rel="stylesheet" />

    {!! LaraKvStore::css() !!}
    @livewireStyles

{{--    {!! Pulse::js() !!}--}}

</head>
<body class="bg-gray-50 dark:bg-gray-950 font-sans antialiased">
<div class="min-h-screen">
    <x-kvstore::header>
        Lara KV Store
    </x-kvstore::header>

    <x-kvstore::main>
        {{ $slot }}
    </x-kvstore::main>
</div>
@livewireScripts
</body>
</html>
