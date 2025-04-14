<div>
    <x-kvstore::card>
        <x-kvstore::card-header>
            List
        </x-kvstore::card-header>
        <x-kvstore::card-content>
            <x-kvstore::table>
                <x-kvstore::thead>
                    <tr>
                        <x-kvstore::th>Key</x-kvstore::th>
                        <x-kvstore::th>Value</x-kvstore::th>
                        <x-kvstore::th>Actions</x-kvstore::th>
                    </tr>
                </x-kvstore::thead>
                <tbody>
                {{--
                @foreach($items as $item)
                    <tr>
                        <x-kvstore::td>{{ $item->key }}</x-kvstore::td>
                        <x-kvstore::td>{{ $item->value }}</x-kvstore::td>
                        <x-kvstore::td>
                            <a href="{{ route('kv-store.edit', $item->id) }}" class="text-blue-500">Edit</a>
                            |
                            <form action="{{ route('kv-store.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </x-kvstore::td>
                    </tr>
                @endforeach
                --}}
                </tbody>
            </x-kvstore::table>
        </x-kvstore::card-content>
    </x-kvstore::card>
</div>
