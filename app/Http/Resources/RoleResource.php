<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public $status;
    public $message;

    /**
     * __construct
     * 
     * @param mixed $status
     * @param mixed $messsage
     * @param mixed $resource
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status   = $status;
    $this->message  = $message;
    }

    /**
     * Transform the resource into an array.
     * 
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'success'      => $this->status,
            'message'      => $this->message,
            'data'         => $this->resource
        ];
    }
}