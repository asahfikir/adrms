<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'sub_indicator_id',
        'user_id',
        'target',
        'table_data',
        'document_name',
        'document_link',
    ];
    public function subIndicator()
    {
        return $this->belongsTo(SubIndicator::class);
    }

    public function user() // PIC
    {
        return $this->belongsTo(User::class);
    }

}
