<?php

namespace App\Http\Resources;

use App\Models\UrlCall;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{

    public function toArray($request): array
    {
        $callNumber = UrlCall::where('url_id', '=', $this->id)
            ->orderBy('created_at', 'DESC')
            ->count();

        $lastCalls = UrlCall::where('url_id', '=', $this->id)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        $arrayLastCalls = [];
        foreach ($lastCalls as $call) {
            $arrayLastCalls[] = [
                'timestamp' => $call->created_at,
                'ip_address' => $call->ip_address,
            ];
        }

        return [
            'id' => $this->id,
            'short_url_string' => $this->short_url_string,
            'original_url' => $this->original_url,
            'access_count' => $callNumber,
            'last_used' => $lastCalls->first()->created_at ?? 'not called',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'last_calls' => $arrayLastCalls,
        ];
    }
}
