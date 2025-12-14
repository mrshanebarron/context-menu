<?php

namespace MrShaneBarron\ContextMenu\Livewire;

use Livewire\Component;

class ContextMenu extends Component
{
    public array $items = [];
    public bool $show = false;
    public int $x = 0;
    public int $y = 0;

    protected $listeners = ['openContextMenu', 'closeContextMenu'];

    public function mount(array $items = []): void
    {
        $this->items = $items;
    }

    public function openContextMenu(int $x, int $y): void
    {
        $this->x = $x;
        $this->y = $y;
        $this->show = true;
    }

    public function closeContextMenu(): void
    {
        $this->show = false;
    }

    public function selectItem(int $index): void
    {
        $this->dispatch('contextMenuSelected', index: $index, item: $this->items[$index] ?? null);
        $this->show = false;
    }

    public function render()
    {
        return view('ld-context-menu::livewire.context-menu');
    }
}
