<?php

namespace Danielmadu\LaraKvStore\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public bool $isOpen = false;

    public string $content = '';

    #[On('openModal')]
    public function openModal(?string $key): void
    {
        $key = Str::after($key, Cache::getPrefix());
        $this->content = '<pre>' . print_r(Cache::get($key), true) . '</pre>';
        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    public function render(): View
    {
        return view('kvstore::livewire.modal');
    }
}
