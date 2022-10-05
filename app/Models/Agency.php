<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agency extends Model
{
    use HasFactory,Media, Translation;
    protected $fillable = [
            'user_id',
            'name_ar',
            'name_en',
            'text_ar',
            'text_en',
            'is_featured',
    ];
    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // public function ads()
    // {
    //     return $this->hasMany(Ad::class);
    // }
}
