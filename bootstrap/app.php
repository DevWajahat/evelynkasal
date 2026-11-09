<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\PreventBackHistory;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'AuthAdmin', 'PreventBackHistory'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'AuthAdmin' => AuthAdmin::class,
            'PreventBackHistory' => PreventBackHistory::class,


        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
