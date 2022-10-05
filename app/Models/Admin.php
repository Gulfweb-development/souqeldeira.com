<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable,Media;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function governorates()
    {
        return $this->hasMany(Governorate::class);
    }
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function buildingStatuses()
    {
        return $this->hasMany(BuildingStatus::class);
    }

    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function buildingTypes()
    {
        return $this->hasMany(BuildingType::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function whyChooseUs()
    {
        return $this->hasMany(WhyCHooseUs::class);
    }

    public function scopeSearch($query,$search)
    {
        return $query->where('name','LIKE','%'.$search.'%');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // HASH PASOWRD
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    // CHECK PERMATIONS
    public function hasPermationTo($permationRoles)
    {
        if (is_array($permationRoles) || is_object($permationRoles)) {
            //            foreach($permationRoles as $prole){
            //           if( $this->roles->contains('name', $prole->name)){
            //               return true;
            //           }
            //        }
            return !!$permationRoles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $permationRoles);
    }


    // CHECK USER IS SUPER ADMIN
    public function isSuperAdmin()
    {
        if ($this->hasPermationTo('admin')) {
            return true;
        }
        return false;
    }
}
