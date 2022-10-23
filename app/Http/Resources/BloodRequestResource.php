<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloodRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->resource->id,
            'division_id'    => $this->resource->division_id,
            'district_id'    => $this->resource->district_id,
            'upazila_id'    => $this->resource->upazila_id,
            'user_id'    => $this->resource->user_id,
            'hospital'    => $this->resource->hospital,
            'contact_person'    => $this->resource->contact_name,
            'contact_phone'    => $this->resource->contact_phone,
            'donation_date'    => $this->resource->donation_date,
            'reference'    => $this->resource->reference,
            'reason'    => $this->resource->reason,
            'hemoglobin'    => $this->resource->hemoglobin,
        ];
    }
}
