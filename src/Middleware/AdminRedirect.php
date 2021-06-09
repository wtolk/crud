<?php

namespace App\Http\Middleware\Adfm;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Wtolk\Crud\FormPresenter;

class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->path()=='admin'){
            $presenter = new FormPresenter;
            $presenter->registerMainMenu();
            $route = $presenter->mainMenu[0]->route;
 
            return redirect(route($route));
        }
        return $next($request);
    }
}
