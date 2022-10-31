<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return $this->infoResponse("Not Found", 404);
        });

        $this->renderable(function (AccessDeniedHttpException $e) {
            return $this->infoResponse($e->getMessage(), 403);
        });

        $this->renderable(function (UnauthorizedHttpException $e) {
            return $this->infoResponse($e->getMessage(), 403);
        });

        // other expected exceptions
        $this->renderable(function (Throwable $e) {
            if (config('app.debug')) {
                return $this->infoResponse($e->getMessage(), 500);
            }
            return $this->infoResponse("Unexpected Exception. Try Later", 500);
        });
    }
}
