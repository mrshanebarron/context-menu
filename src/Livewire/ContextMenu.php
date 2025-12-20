<?php

namespace MrShaneBarron\ContextMenu\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ContextMenu extends Component
{
    public array $items = [];
    public bool $show = false;
    public int $x = 0;
    public int $y = 0;

    public function mount(array $items = []): void
    {
        $this->items = $items;
    }

    #[On('open-context-menu')]
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
        $this->dispatch('context-menu-selected', index: $index, item: $this->items[$index] ?? null);
        $this->show = false;
    }

    public function render()
    {
        return view('sb-context-menu::livewire.context-menu');
    }
}
