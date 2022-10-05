<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory, Media, Translation;
    protected $fillable = [
        'name_ar',
        'name_en',
        'admin_id',
    ];

  public function users()
  {
      return $this->belongsToMany(User::class);
  }

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
