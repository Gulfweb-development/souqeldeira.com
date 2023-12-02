<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory,Translation;
    protected $fillable = [
            'text_ar',
            'text_en',
            'phone',
            'email',
    ];
}
