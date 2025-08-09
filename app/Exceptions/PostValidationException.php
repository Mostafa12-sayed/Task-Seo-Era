<?php

namespace App\Exceptions;

use Exception;

class PostValidationException extends Exception
{
    public function __construct($message = "Post validation failed", $code = 422, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'error_code' => 'VALIDATION_ERROR'
        ], $this->getCode());
    }
}
