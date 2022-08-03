<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
