<div {{ $attributes->merge(['class' => 'flex flex-col space-y-1.5 p-6']) }}>
    <div class="text-2xl font-semibold leading-none tracking-tight">
        {{ $slot }}
    </div>
</div>
