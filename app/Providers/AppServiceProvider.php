<?php

namespace App\Providers;

use App\Component\NewsParser\NewsParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);

        $this->app->singleton('newsParser', function () {

            return new NewsParser(
                config: collect(config('news_parser')),
            );
        });
    }
}
