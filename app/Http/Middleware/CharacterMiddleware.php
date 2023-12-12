<?php

namespace App\Http\Middleware;

use App\Models\Character;
use Closure;
use Illuminate\Http\Request;

class CharacterMiddleware
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
        $userId = $request->session()->get('User');

        if ($userId) {
            $character = Character::where('AccountID', '=', $userId)->get();
            view()->share('characterMiddleware', $character);
        }

        return $next($request);
    }
}
