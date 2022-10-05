<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermationFor extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    public function permations()
    {
        return $this->hasMany(Permation::class);
    }
}
