@props(['cols' => 6, 'rows' => 1])
<div {{ $attributes->merge(['class' => 'rounded-lg border bg-card text-card-foreground shadow-sm px-2 py-5']) }}
     x-data="{
        loading: false,
        init() {
            @if (isset($_instance))
                Livewire.hook('commit', ({ component, succeed }) => {
                    if (component.id === $wire.__instance.id) {
                        succeed(() => this.loading = false)
                    }
                })
            @endif
        }
    }"
>
    {{ $slot }}
</div>
