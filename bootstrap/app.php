<?php

use App\Exceptions\EntityNotFound;
use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function (Response $response, \Exception $e) {
            /** @var string $env */
            $env = config('app.env');

            if ($env !== 'testing') {
                Log::error($e);
            }

            if ($env === 'local') {
                return $response;
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([ 'success' => false, 'errors' => [ 'Une erreur est survenue.' ] ], 404);
            }

            if ($e instanceof EntityNotFound) {
                return response()->json([ 'success' => false, 'errors' => [ 'Une erreur est survenue.' ] ], 404);
            }

            /** @var int $status */
            $status = $e->status ?? 500;

            return response()->json([ 'success' => false, 'errors' => [ 'Une erreur est survenue.' ] ], $status);
        });
    })
    ->withSchedule(function (Schedule $schedule) {
    })
    ->create();
