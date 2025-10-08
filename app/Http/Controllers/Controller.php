<?php

namespace App\Http\Controllers;

abstract class Controller
{
     /**
     * Return a 200 OK JSON response
     */
    protected function successResponse($data = null, $message = 'Success', $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Return a 404 Not Found JSON response
     */
    protected function notFoundResponse($message = 'Resource not found')
    {
        return response()->json([
            'message' => $message
        ], 404);
    }

    /**
     * Return a 422 Unprocessable Entity JSON response for validation errors
     */
    protected function validationErrorResponse($errors, $message = 'Validation failed')
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], 422);
    }
}
