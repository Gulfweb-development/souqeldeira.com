<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory, SoftDeletes, Translation, Media;

     protected $casts = [
         'is_featured' => 'boolean',
         'tracks' => 'object',
     ];

    protected $fillable = [
        'user_id',
        'governorate_id',
        'region_id',
        'building_type_id',
        'code',
        'type',
        'title',
        'text',
        'views',
        'phone',
        'price',
        'archived_at', // process
        'is_featured',
        'is_approved',
        'tracks',
    ];

    // TOGGLE APPROVED STATUS
    public function getApprovedAttribute($value)
    {
        $statuses = [
            0 => 'DIS APPROVED',
            1 => 'APPROVED',
        ];
        return $statuses[$this->is_approved];
    }
    // TOGGLE APPROVED HTML BADGE TYPE
    public function getApprovedBadgeAttribute($value)
    {
        $statuses = [
            0 => 'secondary',
            1 => 'success',
        ];
        return $statuses[$this->is_approved];
    }
    // TOGGLE FEATURED STATUS
    public function getFeaturedAttribute($value)
    {
        $statuses = [
            0 => '---',
            1 => 'Yas',
        ];
        return $statuses[$this->is_featured];
    }
    // TOGGLE FEATURED HTML BADGE TYPE
    public function getFeaturedBadgeAttribute($value)
    {
        $statuses = [
            0 => 'secondary',
            1 => 'success',
        ];
        return $statuses[$this->is_featured];
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function region()
    {
        return $this->belongsTo(Region::class)->withDefault();
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class)->withDefault();
    }

    public function buildingType()
    {
        return $this->belongsTo(BuildingType::class)->withDefault();
    }

    // ADMIN
    public function scopeSearch($query, $search, $filterApproved, $filterFeatured)
    {
        $q = $query->where('title', 'LIKE', '%' . $search . '%');
        if (is_numeric($filterApproved)) {
            $q->where('is_approved', $filterApproved);
        }
        if (is_numeric($filterFeatured)) {
            $q->where('is_featured', $filterFeatured);
        }
        return $q;
    }
    // SEARCH FRONTEND HOME SEARCH
    public function scopeFrontSearch($query, $governorate_id, $region_id, $building_type_id, $type,$price_from, $price_to , $agency_id = null )
    {
        $q = $query->where('is_approved', 1)->orderByDesc('is_featured')->latest();
        if ($governorate_id != null) {
            $q->where('governorate_id', $governorate_id);
        }
        if ($region_id != null) {
            $q->where('region_id', $region_id);
        }
        if ($agency_id != null) {
            $q->where('user_id', $agency_id);
        }
        if ($building_type_id != null) {
            $q->where('building_type_id', $building_type_id);
        }
        if ($type != null) {
            $q->where('type', $type);
        }
        if ($price_from != null && $price_to != null) {
            $q->whereBetween('price', [$price_from, $price_to]);
        } elseif ($price_from != null && $price_to == null) {
            $q->where('price', '>=', $price_from);
        } elseif ($price_from == null && $price_to != null) {
            $q->where('price', '>=', $price_to);
        } else {
            return $q;
        }
        return $q;

    }
    public static function toTitle($type, $governorateName,$regionName,$buildingTypeName)
    {
       if (app()->isLocale('ar')) {
            return $type . '  ' . $buildingTypeName .' '. __('app.in') . ' ' . $governorateName . '  ' . $regionName;
       }
        // return $type . ' | ' . $governorateName . ' | ' . $regionName . ' | ' . $buildingTypeName;
        return $type . '  ' . $buildingTypeName . ' ' . __('app.in') . ' ' . $governorateName . '  ' . $regionName;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->comments()->where('is_approved', 1);
    }

    public function commentsCount()
    {
        return $this->comments()->where('is_approved', 1)->count();
    }

    public function contactUsers()
    {
        return $this->hasMany(ContactUser::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
