<?php

namespace MrShaneBarron\context-menu;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\context-menu\Livewire\context-menu;
use MrShaneBarron\context-menu\View\Components\context-menu as Bladecontext-menu;
use Livewire\Livewire;

class context-menuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-context-menu.php', 'ld-context-menu');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-context-menu');

        Livewire::component('ld-context-menu', context-menu::class);

        $this->loadViewComponentsAs('ld', [
            Bladecontext-menu::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-context-menu.php' => config_path('ld-context-menu.php'),
            ], 'ld-context-menu-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-context-menu'),
            ], 'ld-context-menu-views');
        }
    }
}
