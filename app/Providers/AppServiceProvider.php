<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
        $handler = app('Illuminate\Contracts\Debug\ExceptionHandler');

        $handler->renderable(function (\PDOException $e, $request) {
            \Log::error('PDO Error (DB connection): '.$e->getMessage());
            return response()->view('errors.500', ['message' => 'Database connection failed.'], 500);
        });

        $handler->renderable(function (QueryException $e, $request) {
            \Log::error('DB Error: '.$e->getMessage());
            return response()->view('errors.500', ['message' => 'A database error occurred.'], 500);
        });

        $handler->renderable(function (NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        $handler->renderable(function (HttpException $e, $request) {
            $code = $e->getStatusCode();
            return view()->exists("errors.{$code}")
                ? response()->view("errors.{$code}", [], $code)
                : response()->view('errors.500', ['message' => 'Unexpected error.'], 500);
        });

        $handler->renderable(function (\Throwable $e, $request) {
            \Log::error('Uncaught error: '.$e->getMessage());
            return response()->view('errors.500', ['message' => 'Something unexpected happened.'], 500);
        });
    }
}