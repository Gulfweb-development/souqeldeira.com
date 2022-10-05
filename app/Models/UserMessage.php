<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory,Translation;

    protected $fillable = [
        'user_id',
        'title_en',
        'title_ar',
        'message_en',
        'message_ar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
