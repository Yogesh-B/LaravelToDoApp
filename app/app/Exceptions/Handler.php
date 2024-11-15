<?php

namespace App\Exceptions;

use App\Http\Resources\FailureResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestStatus\Failure;
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


    //render the exception to json response
    public function render($request, Throwable $e)
    {
        if ($e instanceof AuthenticationException) {
            return new FailureResponse($e->getMessage(), 'Please login to continue', Response::HTTP_UNAUTHORIZED);
        }
        elseif($e instanceof UniqueConstraintViolationException){
            $pattern = "/Duplicate entry '([^']+)' for key '([^']+)'/";
            $matches = [];
            $count = preg_match($pattern, $e->getMessage(), $matches);
            if(count($matches)==3 && $matches[2]=='users.users_email_unique'){
                return new FailureResponse(
                    [
                        "User with email '".$matches[1]."' already exists",
                    ],
                    "Email already exists",
                    Response::HTTP_CONFLICT
                );
            }
            //OPTIONAL: update if needed
            return new FailureResponse($matches[0], 'Duplicate entry error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        else
        {
            return new FailureResponse($e->getMessage(), 'Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
