<?php

namespace App\Http\Middleware;

use App\Models\XWEB_TEMPLATE;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TemplateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $activeTemplate = XWEB_TEMPLATE::first();

        if ($activeTemplate){
            View::addLocation(resource_path('views/' . $activeTemplate->active));
        } else {
            View::addLocation(resource_path('views/Default'));
        }

        return $next($request);
    }
}
