<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\BillDetail;
use App\Models\Ingredient;
use App\Observers\ProductObserver;
use App\Observers\BillDetailObserver;
use App\Observers\IngredientObserver;
use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ModelMakeCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*ADD THIS LINES*/
        // $this->commands([
        //     \Laravel\Passport\Console\InstallCommand::class,
        //     \Laravel\Passport\Console\KeysCommand::class,
        //     \Laravel\Passport\Console\ClientCommand::class,
        // ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Ingredient::observe(IngredientObserver::class);
        BillDetail::observe(BillDetailObserver::class);
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        $this->app->extend('command.model.make', function ($command, $app) {
            return new ModelMakeCommand($app['files']);
        });
    }
}
