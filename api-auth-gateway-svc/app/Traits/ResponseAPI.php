<?php

namespace App\Traits;

trait ResponseAPI
{
    public function sendSuccessResponse($statusCode, $status, $data, $message){
        return response()->json([
            "error" => false,
           "status" => $status ?: "success",
           "data" => $data,
           "message" => $message,
        ],
        $statusCode,
        [],
        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function sendErrorResponse($statusCode, $status, $data, $message){
        return response()->json([
           "error" => true,
            "status" => $status ?: "something wrong",
           "data" => $data,
           "message" => $message,
        ],
        $statusCode,
        [],
        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function sendErrorValidationResponse($statusCode, $status, $data, $message){
        return response()->json([
            "error" => true,
            "status" => $status ?: "something wrong",
            "data" => $data,
            "message" => $message,
        ],
        $statusCode,
        [],
        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function sendExceptionResponse($statusCode, $status, $message, \Exception $exception){
        return response()->json([
           "error" => true,
            "status" => $status ?: "something wrong",
            "data" => [
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
            ],
            "message" => $message,
        ],
        $statusCode,
        [],
        JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
