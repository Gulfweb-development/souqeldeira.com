<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    use HasFactory,Translation;
    protected $fillable = [
            'name_ar',
            'name_en',
            'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

}
