<?php

namespace App\Exceptions;

use App\Http\Resources\FailureResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\TestStatus\Failure;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;



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


    //render the exception to json response
    public function render($request, Throwable $e)
    {
        //JWT exceptions were not being captured separately while
        //using jwtauth as "guard", but using it as middleware
        //JWT exceptions captured separately
        //RECOMMENDED: use guard with custom exceptions
        if ($e instanceof AuthenticationException) {
            return new FailureResponse([$e->getMessage()], 'Please login to continue', Response::HTTP_UNAUTHORIZED);
        }
        elseif($e instanceof UniqueConstraintViolationException){
            $pattern = "/Duplicate entry '([^']+)' for key '([^']+)'/";
            $matches = [];
            $count = preg_match($pattern, $e->getMessage(), $matches);
            //OPTIONAL: update if needed
            return new FailureResponse($matches[0], 'Duplicate entry error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        elseif($e instanceof ValidationException){
            return new FailureResponse($e->errors(), 'Validation error', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        //tokenexpiredexception
        elseif ($e instanceof TokenExpiredException) {
            return new FailureResponse([$e->getMessage()], 'Authentication error', Response::HTTP_UNAUTHORIZED);
        }
        //tokeninvalidexception
        elseif ($e instanceof TokenInvalidException) {
            return new FailureResponse([$e->getMessage()], 'Authentication error', Response::HTTP_UNAUTHORIZED);
        }
        elseif ($e instanceof JWTException) {
            return new FailureResponse([$e->getMessage()], 'Authentication error', Response::HTTP_UNAUTHORIZED);
        }
        else
        {
            return new FailureResponse([$e->getMessage()], 'Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
