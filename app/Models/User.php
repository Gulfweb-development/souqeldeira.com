<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Media, Translation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'field',
        'is_approved',
        'is_featured',
        'description_ar',
        'description_en',
        'activated_code',
        'adv_nurmal_count',
        'adv_star_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    // TOGGLE FEATURED STATUS
    public function getFeaturedAttribute($value)
    {
        $statuses = [
            0 => 'No',
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

    public function scopeSearch($query, $search, $filterApproved, $filterFeatured, $type)
    {
        $q = $query->where('name', 'LIKE', '%' . $search . '%');
        if (is_numeric($filterApproved)) {
            $q->where('is_approved', $filterApproved);
        }
        if (is_numeric($filterFeatured)) {
            $q->where('is_featured', $filterFeatured);
        }
        if ($type != '') {
            $q->where('type', $type);
        }
        return $q;
    }

   public function governorates()
   {
       return $this->belongsToMany(Governorate::class);
   }

    public function scopeSearchCompany($query, $search)
    {
        return $query->where('type', 'COMPANY')->where('name', 'LIKE', '%' . $search . '%');
    }

    public function scopeCompanies($query)
    {
        return $query->with('images')->where('is_approved',1)->where('type', 'COMPANY');
    }

    public function scopeApprovedCompanies($query)
    {
        return $query->select('id', 'name', 'type', 'is_approved')->where('type', 'COMPANY')->where('is_approved', 1);
    }
    // HASH PASOWRD
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionHistories::class , 'user_id' , 'id');
    }

    public function contactUsers()
    {
        return $this->hasMany(ContactUser::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function userMessages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function updatePayAsYouGo($data , $orderId)
    {
        $user = self::query()->where('id' , $data['user_id'] ?? null )->first();
        $user->update([
            $data['type'] => $user->{$data['type']} + $data['count']
        ]);
    }

}
