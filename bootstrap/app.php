<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'authCustom' => \App\Http\Middleware\authCustom::class,
            'isAdmin' => \App\Http\Middleware\isAdmin::class,
            'isClient' => \App\Http\Middleware\isRegisteredUser::class,
            #'lang' => \App\Http\Middleware\language::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
