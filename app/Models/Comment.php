<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_id',
        'text',
        'stars',
        'is_approved',
    ];

    public function scopeSearch($query, $search, $filterApproved)
    {
        $q = $query->where('text', 'LIKE', '%' . $search . '%');
        if (is_numeric($filterApproved)) {
            $q->where('is_approved', $filterApproved);
        }
        return $q;
    }

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


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class)->withDefault();
    }
}
