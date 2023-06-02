<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{

    protected $fillable = [
        'belongs_to_type',
        'belongs_to',
        'is_featured',
        'type',
        'ip',
        'time_checker',
    ];

    protected $keyType = 'string';
    protected $primaryKey = null;
    public $incrementing = false;

}
