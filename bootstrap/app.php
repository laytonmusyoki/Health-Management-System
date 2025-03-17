<?php

use App\Http\Middleware\AppointmentMiddleware;
use App\Http\Middleware\PermissionMiddleware;
use App\Http\Middleware\StaffCheck;
use App\Http\Middleware\TwoStepVerification;
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
        $middleware->alias([
       'role'=>StaffCheck::class,
       'permission'=>PermissionMiddleware::class,
       'authCheck'=>AppointmentMiddleware::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
