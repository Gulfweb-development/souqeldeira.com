<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Symfony\Component\Translation\t;

class Order extends Model
{
    use Translation;

    protected $fillable = [
        'user_id',
        'description_en',
        'description_ar',
        'transaction_id',
        'price',
        'status',
        'description',
        'on_success',
    ];

    protected $casts = [
        'on_success' => 'json'
    ];

    // TOGGLE STATUS
    public function getStatus()
    {
        if($this->status == "success") {
            $return ='<span class="badge badge-success">';
        } elseif($this->status == "failed") {
            $return ='<span class="badge badge-danger">';
        } else {
            $return ='<span class="badge badge-secondary">';
        }
        $return .= __($this->status) ;
        $return .='</span>';
        return $return;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doSuccess()
    {
        $class = optional($this->on_success)['class'] ?? null ;
        $method = optional($this->on_success)['method'] ?? null ;
        $params =optional( $this->on_success)['params'] ?? null ;
        if ( class_exists($class) and method_exists($class , $method) ){
            $object = new $class();
            $object->{$method}($params , $this->id);
        }
    }

}
