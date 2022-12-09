<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

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
        $this->renderable(function (UnauthorizedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->infoResponse("Unauthorized", 401);
            }
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return $this->infoResponse("Unauthenticated", 401);
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->infoResponse("Access Denied", 403);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this->infoResponse("Not Found", 404);
            }
        });

        $this->renderable(function (MethodNotAllowedException $e, $request) {
            if ($request->is('api/*')) {
                return $this->infoResponse('The specified method for the request is invalid', 405);
            }
        });

        $this->renderable(function (HttpException $e, $request) {
            return $this->infoResponse($e->getMessage(), $e->getStatusCode());
        });

        $this->renderable(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                $errorCode = $e->errorInfo[1];

                if ($errorCode == 1451) {
                    return $this->infoResponse('Cannot remove this resource permanently. It is related with any other resource', 409);
                }
            }
        });
    
        // other expected exceptions
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if (config('app.debug')) {
                    return $this->infoResponse($e->getMessage(), 500);
                }
                return $this->infoResponse("Unexpected Exception. Try Later", 500);
            }
        });
    }
}
