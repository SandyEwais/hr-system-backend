<?php

use Illuminate\Http\Request;
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
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e instanceof \App\Exceptions\BaseException) {
                return \App\Exceptions\ApiExceptionHandler::handleBaseException($e, $request);
            }

            foreach (\App\Exceptions\ApiExceptionHandler::$handlers as $exceptionClass => $handlerMethod) {
                if ($e instanceof $exceptionClass) {
                    return \App\Exceptions\ApiExceptionHandler::$handlerMethod($e, $request);
                }
            }

            return \App\Exceptions\ApiExceptionHandler::handleThrowable($e, $request);
        });
    })->create();
