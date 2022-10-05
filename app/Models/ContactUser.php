<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUser extends Model
{
    use HasFactory, Media;
    protected $fillable = [
        'ad_id',
        'user_to',
        'user_from',
        'text',
    ];

    // SAME USER MODEL USER TO IF NEEDED
    public function userTo()
    {
        return $this->belongsTo(User::class, 'user_to', 'id')->withDefault();
    }
    // USER WHO CREATED THE CONTACT MESSAGE TO SEND IT
    public function user()
    {
        return $this->belongsTo(User::class, 'user_from', 'id')->withDefault();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class)->withDefault();
    }
}
