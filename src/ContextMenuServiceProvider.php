<?php

namespace MrShaneBarron\ContextMenu;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\ContextMenu\Livewire\ContextMenu;
use MrShaneBarron\ContextMenu\View\Components\ContextMenu as BladeContextMenu;

class ContextMenuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-context-menu.php', 'sb-context-menu');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-context-menu');

        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::component('sb-context-menu', ContextMenu::class);
        }

        $this->loadViewComponentsAs('ld', [
            BladeContextMenu::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-context-menu.php' => config_path('sb-context-menu.php'),
            ], 'sb-context-menu-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-context-menu'),
            ], 'sb-context-menu-views');
        }
    }
}
