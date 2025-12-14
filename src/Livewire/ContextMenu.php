<?php

namespace MrShaneBarron\ContextMenu\Livewire;

use Livewire\Component;

class ContextMenu extends Component
{
    public array $items = [];
    public bool $dividers = true;

    public function mount(
        array $items = [],
        bool $dividers = true
    ): void {
        $this->items = $items;
        $this->dividers = $dividers;
    }

    public function selectItem(string $action): void
    {
        $this->dispatch('context-menu-action', action: $action);
    }

    public function render()
    {
        return view('ld-context-menu::livewire.context-menu');
    }
}
