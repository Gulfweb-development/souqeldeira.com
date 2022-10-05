<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, Media;
    protected $fillable = [
        'name_ar',
        'name_en',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    // public function scopeSearch($query, $search)
    // {
    //     return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    // }
}
