<?php

namespace App\Models;

use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, Translation;
    protected $fillable = [
        'question_ar',
        'question_en',
        'answer_ar',
        'answer_en',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class)->withDefault();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('question'), 'LIKE', '%' . $search . '%');
    }
}
