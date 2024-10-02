<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *      @OA\Info(
 *          version="3.0.0",
 *          title="Todo App Api Docs",
 *          description="This is official docs for the Todo App",
 *          version="0.0.1"
 *      ),
 *      @OA\Server(
 *          description="Local server",
 *          url="http://127.0.0.1:8000/api/"
 *      ),
 *      @OA\Server(
 *          description="Production server",
 *          url="https://laravel-todo.me/api/"
 *      ),
 * 
 *      @OA\Get(
 *          path="/sample-path",
 *          summary="This is just a sample path to generate docs",
 *          operationId="samplePath",
 *          parameters={},
 *          @OA\Response(
 *              response=200,
 *              description="successful operation",
 *          ),
 *      ),
 * )
 */



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
