<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class Handler implements ExceptionHandler
{

    public function report(Throwable $e)
    {
        // TODO: Implement report() method.
    }

    public function shouldReport(Throwable $e): true
    {
        return true;
    }

    public function render($request, Throwable $e)
    {
       if ($e instanceof AuthorizationException || $e instanceof AccessDeniedHttpException) {
            return response()->json([
                'message' => 'You are not authorized to perform this action.'
            ], 403);
        }

        // Obsługa standardowych błędów HTTP
        if ($e instanceof HttpExceptionInterface) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        }

        // Błąd ogólny
        return response()->json([
            'message' => 'Internal Server Error',
            'error' => $e->getMessage()
        ], 500);
    }

    public function renderForConsole($output, Throwable $e)
    {
        // TODO: Implement renderForConsole() method.
    }
}
