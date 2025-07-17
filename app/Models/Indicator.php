<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'name',
        'criterion_id',
    ];

    public function criterion()
    {
        return $this->belongsTo(Criterion::class);
    }

    public function subIndicators()
    {
        return $this->hasMany(SubIndicator::class);
    }

}
