<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory,Translation;

    protected $fillable = [
        'governorate_id',
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

    public function governorate()
    {
        return $this->belongsTo(Governorate::class)->withDefault();
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

}
