<?php

namespace App\Services;

use App\Models\Favorite;

class FavoritesService
{
    public $ad;

    function __construct($ad)
    {
        $this->ad = $ad;
    }

    public function addToFavorite()
    {
       return  Favorite::create([
            'ad_id' => $this->ad->id,
            'user_id' => user()->id,
        ]);
    }

    public function deleteFromFavorite()
    {
        return  Favorite::where('ad_id',$this->ad->id)->where('user_id',user()->id)->delete();
    }

}
