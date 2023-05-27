<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use function Symfony\Component\Translation\t;

class Position extends Model
{

    protected $table = "premium_positions";

    protected $fillable = [
        'user_id',
        'order_id',
        'is_payed',
        'position',
        'title',
        'description',
        'image',
        'link',
        'expired_at',
    ];

    protected $casts = [
        'is_payed' => 'boolean',
        'order_id' => 'int',
        'user_id' => 'int',
        'position' => 'int',
        'expired_at' => 'datetime',
    ];

    // TOGGLE STATUS
    public function getPaidSatatus()
    {
        if($this->is_payed == "success") {
            $return ='<span class="badge badge-success">' . __('paid') .'</span>';
        } else {
            $return ='<span class="badge badge-danger">' . __('pending') .'</span>';
        }
        return $return;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buyPackage($data, $orderId) {
        self::query()->where('id' ,  $data['position_id'])->update([
            'order_id' => $orderId,
            'is_payed' => true
        ]);
    }

    public static function getActivePositionForBuy() {
        return self::query()->where(function ($query) {
            $query->where(function ($notPayQuery) {
                $notPayQuery->where('created_at' , '>=' , Carbon::now()->subMinutes(15))
                    ->where('is_payed' , false);
            })->orWhere('is_payed' , true);
        })->where('expired_at' , '>' , Carbon::now())->get('position')->pluck('position');
    }

}
