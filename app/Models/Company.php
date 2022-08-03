<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(CompanyDepartment::class, 'company_id');
    }


    /**
     * @return BelongsToMany
     */
    public function depts(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Department');
    }
}
