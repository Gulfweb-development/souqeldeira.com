<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionHistories extends Model
{
    protected $table = "subscription_history";

    protected $fillable = [
        'user_id',
        'subscription_id',
        'order_id',
        'adv_count',
        'featured_count',
        'adv_use',
        'featured_use',
        'expired_at',
        'is_payed',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'is_payed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscriptions::class);
    }

    public static function canPostAd($isFeatured = false , $user = null ) {
        if ( $user == null )
            $user = auth()->user();
        $package = self::activePackage($user);
        if ( $package ) {
            if ( $isFeatured and $package->featured_use  < $package->featured_count )
                return true;
            if ( ! $isFeatured and $package->adv_use  < $package->adv_count )
                return true;
        }
        if ( $isFeatured and $user->adv_star_count  > 0 )
            return true;
        if ( ! $isFeatured and $user->adv_nurmal_count  > 0 )
            return true;
        return  false;
    }

    private static $response = null;
    public static function getBalance($user = null , $forceCheck = false) {
        if ( self::$response != null and $forceCheck )
            return  self::$response ;
        if ( $user == null )
            $user = auth()->user();
        $package = self::activePackage($user);
        if ( $package ) {
            return self::$response = [
                'featured' => $package->featured_count - $package->featured_use ,
                'normal' => $package->adv_count - $package->adv_use ,
                ];
        }
        return self::$response = [
            'featured' => $user->adv_star_count ?? 0 ,
            'normal' => $user->adv_nurmal_count ?? 0,
        ];
    }

    public static function postAd($isFeatured = false , $user = null ) {
        if ( $user == null )
            $user = auth()->user();
        $package = self::activePackage($user);
        if ( $package ) {
            if ( $isFeatured ) {
                $package->featured_use = (int) $package->featured_use + 1;
            } else
                $package->adv_use = (int) $package->adv_use + 1;
            $package->save();
        } else {
            if ($isFeatured and $user->adv_star_count > 0)
                $user->adv_star_count = (int) $user->adv_star_count - 1;
            else
                $user->adv_nurmal_count = (int) $user->adv_nurmal_count - 1;
            $user->save();
        }
    }

    public static function activePackage($user = null ) {
        if ( $user == null )
            $user = auth()->user();
        $package = $user->subscriptions()->where('is_payed' , true )->where('expired_at' , '>=' , now() )->where(function ($query) {
           $query->whereColumn('adv_use' , '<' , 'adv_count' )
               ->orWhereColumn('featured_use' , '<' , 'featured_count' );
        })->first();
        return $package;
    }
}
