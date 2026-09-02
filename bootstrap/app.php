<?php

use App\Http\Middleware\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Http\Middleware\EnsureAccountIsActive;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // The account guard is attached after auth on protected route groups.
        $middleware->alias([
            'admin' => Admin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (MethodNotAllowedHttpException $exception) {
            Log::error('HTTP method not allowed.', [
                'method' => request()->method(),
                'url' => request()->fullUrl(),
                'allowed_methods' => $exception->getHeaders()['Allow'] ?? null,
                'ip' => request()->ip(),
            ]);

            return response()->view('errors.405', status: 405);
        });
    })->create();
