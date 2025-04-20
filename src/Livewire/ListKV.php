<?php

namespace Danielmadu\LaraKvStore\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class ListKV extends Component
{
    public function render()
    {
        $connection = App::get('redis')->connection();
        $keys = unserialize(
            $connection->command(
                'keys',
                ['']
            )[0]
        );
        return view('kvstore::livewire.list-k-v', ['keys' => $keys]);
    }
}
