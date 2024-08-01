<?php

namespace Modules\News\Providers;

use App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'News';

    public function boot(): void
    {
        $this->loadMigrations();
        Route::middleware('web')->group(module_path('News', 'routes/web.php'));
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
