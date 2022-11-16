<?php

namespace Amirsadjad\SimpleListFormatter;

use Amirsadjad\SimpleListFormatter\Classes\SimpleListFormatter;
use Illuminate\Support\ServiceProvider;

class SimpleListFormatterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([__DIR__.'/config' => config_path('/'),]);
    }

    public function register()
    {
        $this->app->bind('SimpleListFormatter', function() {return new SimpleListFormatter();});
        $this->mergeConfigFrom(__DIR__.'/config/simple-list-formatter.php', 'simple-list-formatter');
    }
}
