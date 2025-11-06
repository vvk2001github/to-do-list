<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class TaskNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(['message' => 'Task not found'], JsonResponse::HTTP_NOT_FOUND);
    }
}
