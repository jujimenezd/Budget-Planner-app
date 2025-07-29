<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // mostramos los errores de validacion en formato json 
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        if ($e->response) {
            return $e->response;
        }
        return $this->invalidJson($request, $e);
    }

    // creamos una respuesta json para las excepciones de validacion
    public function invalidJson($request, ValidationException $e)
    {
        return response()->json([
            'message' => $e->getMessage(),
            'errors' => $e->errors()
        ], $e->status);
    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}