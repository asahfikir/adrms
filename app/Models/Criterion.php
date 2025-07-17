<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $fillable = [
        'name',
        'academic_year_id',
        'code',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }
}
