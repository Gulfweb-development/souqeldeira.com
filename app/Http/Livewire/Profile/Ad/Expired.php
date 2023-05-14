<?php

namespace App\Http\Livewire\Profile\Ad;

use App\Models\Ad;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Expired extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $ads = Ad::withTrashed()->where('archived_at' , '<' , now())->with('images', 'governorate', 'region')->select('id','title', 'region_id', 'governorate_id', 'views', 'created_at','archived_at','is_approved','is_featured')->where('user_id', user()->id)->latest()->paginate(PG);
        return view('livewire.profile.ad.expired', [
            'ads' => $ads,
        ])->layout(PROFILE_LAYOUT);
    }
}
