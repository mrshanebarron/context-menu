<?php

namespace MrShaneBarron\ContextMenu;

use Illuminate\Support\ServiceProvider;

class ContextMenuServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-context-menu', Livewire\ContextMenu::class);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-context-menu');
    }
}
