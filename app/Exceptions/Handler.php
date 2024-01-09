<?php

namespace App\Exceptions;

use App\Http\Requests\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
   /* public function render($request, Throwable $exception)
    {
        if ($request->is('api*')) {
            // Return JSON response for API routes
            return $this->renderForApi($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function renderForApi(Request $request, Throwable $exception)
    {
        // Customize the response for API routes
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        return response()->json([
            'error' => [
                'code' => $statusCode,
                'message' => $exception->getMessage(),
            ],
        ], $statusCode);
    }*/
}
