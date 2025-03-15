<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'user.auth' => \App\Http\Middleware\UserAuth::class, // Existing alias
            'role.redirect' => \App\Http\Middleware\RoleRedirectMiddleware::class, // Add your new middleware
            'new.user' => \App\Http\Middleware\UserMiddlerware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'support' => \App\Http\Middleware\SupportMiddleware::class,
            'agent' => \App\Http\Middleware\AgentMiddleware::class,
            'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        ]);
    
        $middleware->validateCsrfTokens(except: [
            '/user/*',
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


   