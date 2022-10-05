<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
            'first_name',
            'last_name',
            'email',
            'message',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('first_name', 'LIKE', '%' . $search . '%');
    }

    // FULL NAME
    public function getFullNameAttribute($value)
    {
        return $this->first_name. ' ' . $this->last_name;
    }
}
