<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{

    public function toArray($request): array
    {
        // TODO: fix this
        return [
            'id' => $this->id,
            'short_url_string' => $this->short_url_string,
            'original_url' => $this->original_url,
            'access_count' => 0,
            'last_used' => '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
