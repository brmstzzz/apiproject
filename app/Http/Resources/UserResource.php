<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public bool $success;
    public string $message;

    public function __construct(bool $success, string $message, mixed $resource)
    {
        parent::__construct($resource);
        $this->success = $success;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data'    => $this->resource,
        ];
    }
}
