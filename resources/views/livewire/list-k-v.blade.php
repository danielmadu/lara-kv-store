@use(Carbon\Carbon)
<div wire:poll>
    <x-kvstore::card>
        <x-kvstore::card-header>
            List
        </x-kvstore::card-header>
        <x-kvstore::card-content>
            <x-kvstore::table>
                <x-kvstore::thead>
                    <tr>
                        <x-kvstore::th>Key</x-kvstore::th>
                        <x-kvstore::th>Expires At</x-kvstore::th>
                        <x-kvstore::th>Actions</x-kvstore::th>
                    </tr>
                </x-kvstore::thead>
                <tbody>
                @foreach($keys as $key => $value)
                    <tr :key="$key">
                        <x-kvstore::td>{{ Str::after($key, Cache::getPrefix()) }}</x-kvstore::td>
                        <x-kvstore::td>{{ $value['expiresAt'] === 0 ? 'Never' : Carbon::parse($value['expiresAt'])->format('Y-m-d H:i:s') }}</x-kvstore::td>
                        <x-kvstore::td>

                            <button @click="$dispatch('openModal', { key: '{{ $key }}' })">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </x-kvstore::td>
                    </tr>
                @endforeach
                </tbody>
            </x-kvstore::table>
        </x-kvstore::card-content>
    </x-kvstore::card>
    <livewire:larakvstore.modal />
</div>
