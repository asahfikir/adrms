<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];
    public function criteria()
    {
        return $this->hasMany(Criterion::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
