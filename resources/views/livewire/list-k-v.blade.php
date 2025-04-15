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
                        <x-kvstore::th>Expires At</x-kvstore::th>
                        <x-kvstore::th>Actions</x-kvstore::th>
                    </tr>
                </x-kvstore::thead>
                <tbody>
                @foreach($keys as $key => $value)
                    <tr>
                        <x-kvstore::td>{{ $key }}</x-kvstore::td>
                        <x-kvstore::td>{{ $value['value'] }}</x-kvstore::td>
                        <x-kvstore::td>{{ $value['expiresAt'] === 0 ? 'Never' : date('Y-m-d H:i:s', $value['expiresAt']) }}</x-kvstore::td>
                        <x-kvstore::td>
    {{--                        <a href="{{ route('kvstore.edit', $key) }}" class="text-blue-500">Edit</a>
                            |
                            <form action="{{ route('kvstore.destroy', $key) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>--}}
                        </x-kvstore::td>
                    </tr>
                @endforeach
                </tbody>
            </x-kvstore::table>
        </x-kvstore::card-content>
    </x-kvstore::card>
</div>
