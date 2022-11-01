<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $casts = [
        'isSeen' => 'boolean',
    ];
    protected $fillable = ['user_id','item_id','item_type', 'description' , 'isSeen'];

    public static function insert($item , $description = null ){
        $report = new Report();
        $report->user_id = optional(auth()->user())->id;
        $report->item_id = optional($item)->id;
        $report->item_type = get_class($item);
        $report->description = $description;
        $report->isSeen = false;
        $report->save();
        return $report;
    }

    public function seen(){
        $this->isSeen = true;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->morphTo();
    }
}
