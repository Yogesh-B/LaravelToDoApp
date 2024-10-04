<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class FailureResponse extends JsonResource
{

    /**
     * @OA\Schema(
     *     schema="FailureResponse",
     *     title="Failure Response",
     *     description="Standard failure response structure",
     *     @OA\Property(
     *         property="success",
     *         type="boolean",
     *         description="Indicates if the request failed",
     *         example=false,
     *         default=false
     *     ),
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         description="Message describing the failure",
     *         example="Operation failed"
     *     ),
     *     @OA\Property(
     *         property="data",
     *         type="object",
     *         description="Any errors or data related to the failure"
     *     )
     * )
     */


    protected $message = null;
    protected $errors = null;
    protected $status = null;
    

    public function __construct($errors,$message="Operation failed",$status=Response::HTTP_INTERNAL_SERVER_ERROR) {
        $this->errors = $errors;
        $this->message = $message;
        $this->status = $status;
    }


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "success" => false,
            "message" => $this->message,
            "data" => $this->errors,
        ];
        
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        return $response->setStatusCode($this->status);
    }

}
