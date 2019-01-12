<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCases\Cart\Cart;
use App\Usecases\Cart\Repositories\LaravelRepository;
use App\Usecases\Cart\Storages\LaravelSessionStorage;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function() {
            return new Cart(new LaravelSessionStorage, new LaravelRepository);
        });
    }
}
