# Laravel User Logger
Laravel User Logger is a package used to append user specific data into the log files. It could be used to track which user produced an exception in order to help debugging.

## Exemple
```
#31 app\vendor\laravel\framework\src\Illuminate\Pipeline\Pipeline.php(104): Illuminate\Routing\Pipeline->Illuminate\Routing\{closure}(Object(Illuminate\Http\Request))
#32 app\vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php(150): Illuminate\Pipeline\Pipeline->then(Object(Closure))
#33 app\vendor\laravel\framework\src\Illuminate\Foundation\Http\Kernel.php(117): Illuminate\Foundation\Http\Kernel->sendRequestThroughRouter(Object(Illuminate\Http\Request))
#34 app\public\index.php(53): Illuminate\Foundation\Http\Kernel->handle(Object(Illuminate\Http\Request))
#35 {main}  {"user":1}
```

As you can see the stack trace is completed by a custom attribute *user* displaying the id of the user who provoked the exception. 

If the user isn't logged it will write *anonymous*. Else if the exception has been thrown before the session start, the user information will not be displayed.

# Installation

Begin by installing the package with Composer.

```sh
composer require tzk/laravel-user-logger
```

Once the installation is complete, add the service provider in your **config/app.php** file:

```php
TZK\UserLogger\Providers\UserLoggerServiceProvider::class,
```

Then you'll need to change in your **app/Http/Kernel.php** file the middleware 
```
\Illuminate\Session\Middleware\StartSession::class
``` 
to this one 
```
\TZK\UserLogger\Http\Middlewares\StartSession::class
```

# Configuration

By default the package uses the primary key of your User model. This behavior can be overridden by publishing the package config file.

```sh
php artisan vendor:publish --provider="TZK\UserLogger\Providers\UserLoggerServiceProvider"
```

This command will create a **user_logger.php** config file in your config folder in which you could specify which user attribute you would display in your logs.
