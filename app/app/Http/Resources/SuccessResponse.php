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


    public function __construct($data,$message="Operation sucessful",$status=Response::HTTP_OK) {
        $this->data = $data;
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
        $dataArray = $this->data instanceof JsonResource ? $this->data->toArray($request) : $this->data;

        if ($this->data instanceof JsonResource){
            return [
                "success" => true,
                "message" => $this->message,
                "data" => $dataArray['data'],
                "meta" => $dataArray['meta'] ?? null, // Include meta if available
            ];
        }else{
            return [
                "success" => true,
                "message" => $this->message,
                "data" => $dataArray,
            ];
        }

    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        return $response->setStatusCode($this->status);
    }

}
