<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\JsonResponse;

class BaseException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $this->getMessage(),
                'code' => $this->getCode(),
                'trace' => config('app.debug') ? $this->getTrace() : null,
            ],
        ], $this->getCode());
    }
}
