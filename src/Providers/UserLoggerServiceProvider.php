<?php

namespace TZK\UserLogger\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use TZK\UserLogger\Events\SessionStarted;
use TZK\UserLogger\Logger\UserProcessor;

class UserLoggerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/user_logger.php' => config_path('user_logger.php'),
        ], 'config');

        $this->pushUserProcessor();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/user_logger.php', 'user_logger');

        $this->app->register(SessionServiceProvider::class);
    }

    /**
     * Push the user processor into the Monolog instance.
     *
     * @return void
     */
    private function pushUserProcessor()
    {
        // Since it is not possible to access sessions in a service provider
        // we listen for the session start to get the logged user.
        Event::listen(SessionStarted::class, function ($user) {
            Log::getMonolog()->pushProcessor(new UserProcessor($user));
        });
    }
}
