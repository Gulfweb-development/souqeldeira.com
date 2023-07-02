<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'home_details_ar',
        'home_details_en',
        'terms_condition_ar',
        'terms_condition_en',
        'keywords_ar',
        'keywords_en',
        // 'is_payment_available',
        // 'publish_all_to_social_media',
        'visits',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'admin_id',
        'expire_time_adv',
        'expire_time_premium_adv',
        'price_adv',
        'price_premium_adv',
        'num_special_position',
        'special_position',
        'gift_normal',
        'gift_premium',
    ];

    protected $casts = [
        'special_position' => 'array'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('title'), 'LIKE', '%' . $search . '%');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }

    public static function get($key , $default = null ){
        $data = self::select($key)->latest()->first();
        return $data->{$key} ?? $default;
    }
}
