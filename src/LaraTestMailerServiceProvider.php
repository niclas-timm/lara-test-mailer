<?php

namespace Niclastimm\LaraTestMailer;

use Illuminate\Support\ServiceProvider;
use Niclastimm\LaraTestMailer\Console\InstallLaraTestMailer;
use Niclastimm\LaraTestMailer\Console\SendTestMail;

class LaraTestMailerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laratestmailer');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laratestmailer');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/configProd.php' => config_path('laratestmailer.php'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/laratestmailer')
            ]);
            $this->commands([
                InstallLaraTestMailer::class,
                SendTestMail::class
            ]);
        }

    }
}