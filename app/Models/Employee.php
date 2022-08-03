<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $guarded = [];

    public function departments(): HasMany
    {
        return $this->hasMany(EmployeeDepartment::class, 'employee_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function depts(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Department');
    }
}
