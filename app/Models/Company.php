<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
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
        'is_approved',
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


    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', '%' . $search . '%');
    }

    // HASH PASOWRD
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
