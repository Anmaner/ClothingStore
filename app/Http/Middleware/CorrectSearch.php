<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tag;

class CorrectSearch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if($type == 'tags') {
            $this->tags($request);
        }

        return $next($request);
    }


    private function tags($request)
    {
        if (Tag::where('title', $request->curTag)->count() < 1) {
            throw new \Exception("Tag '{$request->curTag}' is not found.");
        }
    }
}
