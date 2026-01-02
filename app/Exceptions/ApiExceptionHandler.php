<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\{
    AccessDeniedHttpException,
    HttpException,
    MethodNotAllowedHttpException,
    NotFoundHttpException
};
use Throwable;

class ApiExceptionHandler
{
    use ApiResponseTrait;

    public static array $handlers = [
        AuthenticationException::class => 'handleAuthentication',
        AccessDeniedHttpException::class => 'handleAuthentication',
        AuthorizationException::class => 'handleAuthorization',
        ValidationException::class => 'handleValidation',
        ModelNotFoundException::class => 'handleNotFound',
        NotFoundHttpException::class => 'handleNotFound',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowed',
        QueryException::class => 'handleDatabase',
        HttpException::class => 'handleHttp',
    ];

    public static function handleBaseException(BaseException $e, Request $request): mixed
    {
        return self::errorResponse(
            $e->getMessage(),
            $e->status(),
            $e->errors(),
            $e->code()
        );
    }

    public static function handleThrowable(Throwable $e, Request $request): mixed
    {
        if (! app()->environment('local')) {
            Log::error('Unhandled API exception', [
                'exception_class' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => $request->fullUrl(),
                'user_id' => $request->user()?->id,
                'trace' => $e->getTraceAsString(),
            ]);
        }

        $message = app()->environment('production')
            ? 'An internal error occurred.'
            : ($e->getMessage() ?: 'Unexpected error');

        return self::errorResponse($message, 500);
    }

    public static function handleAuthentication(AuthenticationException|AccessDeniedHttpException $e, Request $request): mixed
    {
        return self::errorResponse(
            'Authentication required.',
            401,
            code: 'AUTH_REQUIRED'
        );
    }

    public static function handleAuthorization(AuthorizationException $e, Request $request): mixed
    {
        return self::errorResponse(
            'You do not have permission.',
            403,
            code: 'FORBIDDEN'
        );
    }

    public static function handleValidation(ValidationException $e, Request $request): mixed
    {
        $errors = [];
        foreach ($e->errors() as $field => $messages) {
            foreach ($messages as $msg) {
                $errors[] = ['field' => $field, 'message' => $msg];
            }
        }

        return self::errorResponse(
            'Validation failed',
            422,
            $errors,
            'VALIDATION_ERROR'
        );
    }

    public static function handleNotFound(ModelNotFoundException|NotFoundHttpException $e, Request $request): mixed
    {
        return self::errorResponse(
            'Resource not found',
            404,
            code: 'NOT_FOUND'
        );
    }

    public static function handleMethodNotAllowed(MethodNotAllowedHttpException $e, Request $request): mixed
    {
        return self::errorResponse(
            "Method {$request->method()} not allowed for this endpoint.",
            405,
            ['allowed_methods' => explode(', ', $e->getHeaders()['Allow'] ?? '')],
            'METHOD_NOT_ALLOWED'
        );
    }

    public static function handleDatabase(QueryException $e, Request $request): mixed
    {
        return self::errorResponse(
            'Database error occurred',
            500,
            code: 'DATABASE_ERROR'
        );
    }

    public static function handleHttp(HttpException $e, Request $request): mixed
    {
        return self::errorResponse(
            $e->getMessage() ?: 'HTTP error',
            $e->getStatusCode(),
            code: $e->getStatusCode()
        );
    }
}