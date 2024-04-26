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
        $middleware->priority([
             \App\Http\Middleware\AdminMiddleware::class,
            \App\Http\Middleware\FirebaseAuthMiddleware::class,
        ]);

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'firebase' => \App\Http\Middleware\FirebaseAuthMiddleware::class,
            'firebase.guest' => \App\Http\Middleware\FirebaseGuestMiddleware::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->api();

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
