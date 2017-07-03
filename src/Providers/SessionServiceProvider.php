<?php

namespace TZK\UserLogger\Providers;

use Illuminate\Session\SessionServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use TZK\UserLogger\Events\SessionStarted;
use TZK\UserLogger\Http\Middlewares\StartSession;
use TZK\UserLogger\Logger\UserProcessor;

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
