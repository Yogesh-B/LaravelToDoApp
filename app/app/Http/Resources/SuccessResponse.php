<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class SuccessResponse extends JsonResource
{

    protected $message = null;
    protected $data = null;
    protected $status = null;


    public function __construct($message,$data,$status=Response::HTTP_OK) {
        $this->message = $message;
        $this->data = $data;
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
            "success" => true,
            "message" => $this->message,
            "data" => $this->data,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        return $response->setStatusCode($this->status);
    }

}
