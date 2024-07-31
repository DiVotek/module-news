<?php

namespace Modules\News\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'News';

    public function boot(): void
    {
        $this->loadMigrations();
        $this->publishes([
            __DIR__ . '/../Admin' => base_path('app/Filament/Resources'),
        ], 'your-module-admin');
    }

    public function register(): void
    {
        //
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Migrations'));
    }
}
