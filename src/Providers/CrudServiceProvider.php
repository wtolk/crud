<?php

namespace Wtolk\Crud\Providers;


use App\Helpers\Dev;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // publish config file

            $this->commands([
                CrudCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/wtolk/crud/'),
            __DIR__.'/../assets/webpack.mix.js' => base_path(''),
            __DIR__.'/../Middleware' => app_path('Http/Middleware/Adfm'),
        ]);
        \View::share('php_tags', '<?php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'crud');

        $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);
        $kernel->pushMiddleware(\App\Http\Middleware\Adfm\AdminRedirect::class);
    }
}
