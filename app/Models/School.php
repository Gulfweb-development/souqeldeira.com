<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory,Translation,Media;
    protected $fillable = [
            'governorate_id',
            'region_id',
            'title_ar',
            'title_en',
            'text_ar',
            'text_en',
            'map_link',
            'phone',
            'email',
            'facebook',
            'twitter',
            'instagram',
            'snapchat',
            'youtube',
    ];

    // SEARCH FRONTEND HOME SEARCH
    public function scopeFrontSearch($query, $governorate_id, $region_id)
    {
        $q = $query->latest();
        if ($governorate_id != null) {
            $q->where('governorate_id', $governorate_id);
        }
        if ($region_id != null) {
            $q->where('region_id', $region_id);
        }else {
            return $q;
        }
        return $q;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('title'), 'LIKE', '%' . $search . '%');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class)->withDefault();
    }

    public function region()
    {
        return $this->belongsTo(Region::class)->withDefault();
    }

}
