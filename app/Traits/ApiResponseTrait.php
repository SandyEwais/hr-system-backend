<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public static function successResponse(mixed $data, string $message = '', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->toISOString(),
        ], $status);
    }

    public static function errorResponse(
        string $message,
        int $status = 400,
        array $errors = [],
        ?string $code = null
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'code' => $code,
            'timestamp' => now()->toISOString(),
        ], $status);
    }
}