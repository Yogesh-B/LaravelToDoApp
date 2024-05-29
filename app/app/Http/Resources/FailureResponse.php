<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class FailureResponse extends JsonResource
{

    protected $message = null;
    protected $errors = null;
    protected $status = null;
    

    public function __construct($message,$errors,$status=Response::HTTP_INTERNAL_SERVER_ERROR) {
        $this->message = $message;
        $this->errors = $errors;
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
