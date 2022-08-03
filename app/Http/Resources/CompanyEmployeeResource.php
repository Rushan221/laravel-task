<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyEmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'company_id' => (string)$this->company->id,
            'type' => 'Company_Employee',
            'data' => [
                'employees' => new EmployeeResource($this),
            ]
        ];
    }
}
