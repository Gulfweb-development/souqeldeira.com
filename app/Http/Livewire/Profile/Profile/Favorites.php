<?php

namespace App\Http\Livewire\Profile\Profile;

use App\Models\Ad;
use App\Models\Favorite;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\FavoritesService;

class Favorites extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function deleteFromFavorite(Ad $ad)
    {
        $service = new FavoritesService($ad);
        $service->deleteFromFavorite();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted_favorite')]);
    }

    public function render()
    {
        $favoriteAds = Favorite::with('user', 'ad')->where('user_id', user()->id)->latest()->paginate(PG);
        return view('livewire.profile.profile.favorites', [
            'favoriteAds' => $favoriteAds,
        ])->layout(PROFILE_LAYOUT);
    }
}
