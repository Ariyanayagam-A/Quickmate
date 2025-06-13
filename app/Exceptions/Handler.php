<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Log the exception
        \Log::error($exception);

        // Handle validation exceptions (e.g. form errors)
        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        // Handle database query exceptions
        if ($exception instanceof QueryException) {
            return response()->view('errors.500', [
                'message' => 'A database error occurred.',
            ], 500);
        }

        // Handle 404 not found
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Handle specific HTTP exceptions (e.g. 403, 503, etc.)
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            if (view()->exists("errors.{$code}")) {
                return response()->view("errors.{$code}", [], $code);
            }
        }

        // Catch-all: fallback to 500 error page
        return response()->view('errors.500', [
            'message' => 'Something unexpected happened.',
        ], 500);
    }
}
