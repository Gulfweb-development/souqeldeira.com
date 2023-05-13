<?php

namespace App\Http\Livewire\Profile\Ad;

use App\Models\Ad;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($adId)
    {
        $ad = Ad::where('id', $adId)->where('user_id', user()->id)->firstOrFail();
        $ad->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function payment()
    {
        dd('PAYMENT UNDER PROCESSING');
    }

    public function render()
    {
        $ads = Ad::with('images', 'governorate', 'region')->select('id','title', 'region_id', 'governorate_id', 'views', 'created_at','is_approved','is_featured')->where('user_id', user()->id)->latest()->paginate(PG);
        return view('livewire.profile.ad.index', [
            'ads' => $ads,
        ])->layout(PROFILE_LAYOUT);
    }
}
