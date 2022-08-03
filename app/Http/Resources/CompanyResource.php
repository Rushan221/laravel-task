<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Company',
            'data' => [
                'name' => $this->name,
                'location' => $this->location,
                'contact' => $this->contact,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
