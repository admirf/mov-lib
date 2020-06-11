<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        $content = null;
        $code = null;

        if ($exception instanceof ValidationException) {
            $content = $exception->validator->errors();
            $code = 422;
        } else if($exception instanceof ModelNotFoundException) {
            $code = 404;
        } else if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
        } else if ($exception instanceof OAuthServerException) {
            $code = 401;
        } else if ($exception instanceof AuthenticationException) {
            $code = 401;
        } else if ($exception instanceof AuthorizationException) {
            $code = 403;
        }

        return response()->json([
            'error' => $content ?? $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ])->setStatusCode($code ?? 500);
    }
}
