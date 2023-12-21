<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error'   => true,
                'message' => $exception->getMessage(),
            ], 401);
        }

        return redirect()->guest($exception->redirectTo() ?? route('home'));
    }

    protected function unverified($request, HttpException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage()
            ], $exception->getStatusCode());
        }

        return redirect()->guest(route('home'));
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 404) {
                return parent::render($request, $exception);
            } else {
                return $this->unverified($request, $exception);
            }
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        return parent::render($request, $exception);
    }
}
