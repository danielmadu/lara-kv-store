@props(['cols' => 6, 'rows' => 1])
<div {{ $attributes->merge(['class' => 'flex flex-col p-3 sm:p-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl shadow-sm ring-1 ring-gray-900/5 default:col-span-full']) }}
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
