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

        \View::share('php_tags', '<?php');
//        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
        $this->loadViewsFrom(__DIR__ . '/../views', 'crud');
        //
    }
}
