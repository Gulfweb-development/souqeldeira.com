<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriptions extends Model
{
    use HasFactory, Media, Translation , SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'adv_nurmal_count',
        'adv_star_count',
        'price',
        'type',
        'status',
        'expire_time',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // TOGGLE STATUS
    public function getStatus()
    {
        if($this->status) {
            $return ='<span class="badge badge-success">';
        } else {
            $return ='<span class="badge badge-secondary">';
        }
        $return .= ($this->status) ? __('Active') : __("InActive");
        $return .='</span>';
        return $return;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    }


    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistories::class , 'subscription_id' , 'id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
