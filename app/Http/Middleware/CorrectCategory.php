<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ProductCategorie;

class CorrectCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!empty($request->category) && ProductCategorie::where('title', $request->category)->count() < 1) {
            die('FAIL');
        }

        return $next($request);
    }
}
