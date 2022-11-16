<?php

namespace Amirsadjad\SimpleListFormatter;

use Amirsadjad\SimpleListFormatter\Classes\SimpleListFormatter;
use Illuminate\Support\ServiceProvider;

class SimpleListFormatterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->publishes([__DIR__.'/Config' => config_path('/'), 'simple-list-formatter-config']);
    }

    public function register()
    {
        parent::register();

        $this->app->bind('SimpleListFormatter', function() {return new SimpleListFormatter();});
        $this->mergeConfigFrom(__DIR__.'/Config/simple-list-formatter.php', 'simple-list-formatter');
    }
}
