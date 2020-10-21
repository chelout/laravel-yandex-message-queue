<?php

namespace Chelout\Ymq;

use Illuminate\Support\ServiceProvider;

class YmqServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ymq.php' => config_path('ymq.php'),
            ], 'config');
        }

        $manager = $this->app['queue'];

        $manager->addConnector('ymq', function () {
            return new YmqConnector();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ymq.php', 'ymq');
    }
}