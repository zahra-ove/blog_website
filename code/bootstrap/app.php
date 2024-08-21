<?php

use App\Exceptions\customResourceException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        });

        $exceptions->renderable(function (CustomResourceException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        });

        $exceptions->renderable(function (\Exception $e) {
            return response()->json([
                'message' => 'Something get wrong!',
            ], 422);
        });

        $exceptions->reportable(function (\Exception $e) {
            Log::error('Exception occurred', [
                'exception' => $e->getMessage(),
                'trace'     => $e->getTraceAsString(),
            ]);
        });
    })->create();
