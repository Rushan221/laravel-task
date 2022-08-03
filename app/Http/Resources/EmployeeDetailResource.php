<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Employee',
            'data' => [
                'name' => $this->name,
                'employee_number' => $this->employee_number,
                'email' => $this->email,
                'contact' => $this->contact,
                'designation' => $this->designation,
                'company' => new CompanyResource($this->company),
                'departments' => DepartmentResource::collection($this->depts),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
