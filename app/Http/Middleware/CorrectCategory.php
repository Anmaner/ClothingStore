<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ProductCategorie;
use App\Models\BlogCategorie;

class CorrectCategory
{
    public function handle($request, Closure $next, $category)
    {
        if($category == 'shopping') {
            $this->shoppingCategory($request);
        }
        elseif($category == 'blog') {
            $this->blogCategory($request);
        }
        else{
            throw new \Exception("Category '$category' is not found.");
        }

        return $next($request);
    }


    private function shoppingCategory($request)
    {
        if(!empty($request->category) && ProductCategorie::where('title', $request->category)->count() < 1) {
            throw new \Exception("Category '{$request->category}' is not found.");
        }
    }

    private function blogCategory($request)
    {
        if(!empty($request->category) && BlogCategorie::where('alias', $request->category)->count() < 1) {
            throw new \Exception("Category '{$request->category}' is not found.");
        }
    }
}
