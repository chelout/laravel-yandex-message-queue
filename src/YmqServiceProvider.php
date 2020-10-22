<?php

namespace Chelout\Ymq;

use Illuminate\Support\ServiceProvider;

class YmqServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $manager = $this->app['queue'];

        $manager->addConnector('ymq', function () {
            return new YmqConnector();
        });
    }

    public function register()
    {
        //
    }
}
