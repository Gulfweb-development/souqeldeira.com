<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        if ( request()->is('api/*')) {
            $this->renderable(function (ValidationException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => $exception->getMessage(),
                    'data' => [],
                    'errors' => $exception->errors(),
                ], $exception->status);
            });
            $this->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
                return response()->json([
                    'error' => 'Erreur de modèle non trouvée lors du rendu.',
                    'details' => $e->getMessage(),
                    'url' => $request->url()
                ], $e->getStatusCode() ?: 400);
            });
            $this->renderable(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => app()->getLocale() == 'en' ? 'No results found!' : 'لم يتم العثور على نتائج!',
                    'data' => [],
                    'errors' => [],
                ], $exception->status);
            });
            $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception) {
                return response()->json([
                    'status' => false,
                    'message' => app()->getLocale() == 'en' ? 'No results found!' : 'لم يتم العثور على نتائج!',
                    'data' => [],
                    'errors' => [],
                ], 404);
            });
        }
    }
}
