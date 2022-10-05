<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'name',
        'label_en',
        'label_ar',
    ];

    public function scopeSearch($query,$search)
    {
        return $query->where('label_'.app()->getLocale(),'LIKE','%'.$search.'%');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function permations()
    {
        return $this->belongsToMany(Permation::class);
    }
}
