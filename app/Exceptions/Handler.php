<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Log all exceptions
        \Log::error($exception);
    
        // Handle DB Error
        if ($exception instanceof QueryException) {
            return response()->view('errors.500', ['message' => 'A database error occurred.'], 500);
        }
    
        // Handle 404 Error
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }
    
        // Handle other HTTP errors
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            if (view()->exists("errors.{$code}")) {
                return response()->view("errors.{$code}", [], $code);
            }
        }
    
        // Catch all
        return response()->view('errors.500', ['message' => 'Something unexpected happened.'], 500);
    }
}
