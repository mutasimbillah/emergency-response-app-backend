<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptRequestResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id'           => $this->resource->id,
            'donner_id'    => $this->resource->donner_id,
            'recipient_id' => $this->resource->recipient_id,
        ];
    }
}
