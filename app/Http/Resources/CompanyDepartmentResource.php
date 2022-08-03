<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyDepartmentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'company_id' => (string)$this->id,
            'type' => 'Company_Department',
            'data' => [
                'departments' => DepartmentResource::collection($this->depts),
            ]
        ];
    }
}
