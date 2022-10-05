<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriptions extends Model
{
    use HasFactory, Media, Translation;
    
    protected $fillable = [
        'name_ar',
        'name_en',
        'adv_nurmal_count',
        'adv_star_count',
        'price',
        'type',
        'status',
    ];
    
    // TOGGLE STATUS
    public function getStatus()
    {
        dd($this->status);
        if($this->status == 1) {
            $return ='<span class="badge badge-success">';
        } else {
            $return ='<span class="badge badge-secondary">';
        }
        $return .= ($this->status == 1) ? __('Active') : __("InActive");
        $return .='</span>';
        return $return;
    }
    
    public function scopeSearch($query, $search)
    {
        return $query->where(toLocale('name'), 'LIKE', '%' . $search . '%');
    }
    
}
