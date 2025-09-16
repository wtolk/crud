<?php

namespace Wtolk\Crud\Providers;

use App\Http\Middleware\Adfm\AdminRedirect;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Wtolk\Crud\Commands\CrudCommand;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        $this->registerMiddleware();
        $this->registerViews();
        // Publish assets
        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/wtolk/crud/'),
            __DIR__ . '/../assets/webpack.mix.js' => base_path('webpack.mix.js'),
            __DIR__ . '/../Middleware' => app_path('Http/Middleware/Adfm'),
        ], 'crud-assets');

        // Автопубликация ассетов (настроено в Installer)
        \Wtolk\Crud\Installer::publishAssets();
    }

    protected function registerCommands(): void
    {
        $this->commands([
            CrudCommand::class,
        ]);
    }

    protected function registerMiddleware(): void
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(AdminRedirect::class);
    }

    protected function registerViews(): void
    {
        \View::share('php_tags', '<?php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'crud');
    }
}
