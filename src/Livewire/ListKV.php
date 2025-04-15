<?php

namespace Danielmadu\LaraKvStore\Livewire;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class ListKV extends Component
{

    public $keys = [];

    public function mount()
    {
        $connection = App::get('redis')->connection();
        $this->keys = unserialize(
            $connection->command(
                'keys',
                ['']
            )[0]
        );
    }
    public function render()
    {
        return view('kvstore::livewire.list-k-v');
    }
}
