<?php

namespace TZK\UserLogger\Providers;

use Illuminate\Session\SessionServiceProvider as ServiceProvider;
use TZK\UserLogger\Http\Middlewares\StartSession;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Noting to do here
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSessionManager();

        $this->registerSessionDriver();

        $this->app->singleton(StartSession::class);
    }
}
