<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permation extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'name',
        'label_en',
        'label_ar',
        'permation_for_id',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function permationFor()
    {
        return $this->belongsTo(PermationFor::class);
    }

}
