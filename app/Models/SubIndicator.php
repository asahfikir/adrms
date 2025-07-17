<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubIndicator extends Model
{
    protected $fillable = [
        'name',
        'indicator_id',
    ];
    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
