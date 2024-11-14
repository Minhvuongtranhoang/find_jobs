<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\LocationResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'logo' => $this->logo,
            'website' => $this->website,
            'email' => $this->email,
            'phone' => $this->phone,
            'description' => $this->description,
            'industry' => $this->industry,
            'employee_count' => $this->employee_count,
            'locations' => LocationResource::collection($this->whenLoaded('locations')),
        ];
    }
}
?>
