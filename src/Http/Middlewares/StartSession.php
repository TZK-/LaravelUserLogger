<?php

namespace TZK\UserLogger\Http\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession as BaseSession;
use TZK\UserLogger\Events\SessionStarted;

class StartSession extends BaseSession
{

    protected function startSession(Request $request)
    {
        $session = parent::startSession($request);
        event(new SessionStarted(auth()->user()));
        
        return $session;
    }
}