<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'order',
            'id' => $this->id,
            'charge' => $this->charge,
            'requestedAt' => $this->created_at,
            'statusUpdatedAt' => $this->updated_at,
            'estimatedArrivalTime' => $this->arrives_at,
            'movie' => new MovieResource($this->whenLoaded('movie'))
        ];
    }
}
