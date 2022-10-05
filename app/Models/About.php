<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'text_ar',
        'text_en',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('text'), 'LIKE', '%' . $search . '%');
    }
}
