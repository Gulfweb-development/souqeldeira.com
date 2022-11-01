<?php

namespace App\Http\Livewire\Frontend\Ads;

use App\Models\Ad;
use App\Models\Report;
use Livewire\Component;
use App\Models\Favorite;
use App\Models\ContactUser;
use App\Services\FavoritesService;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class AdSearch extends Component
{
    public $ad;
    public $recentAds;
    public $featuredAds;
    public $similarAds;
    public $text;
    public $description;

    public function mount($slug, $id)
    {
        $this->ad = Ad::where('id', $id)->where('is_approved', 1)->firstOrFail();
        $this->ad->increment('views');
        $this->recentAds = Ad::where('is_approved', 1)->latest()->take(3)->get();
        $this->featuredAds = Ad::where('is_approved', 1)->where('is_featured', 1)->inRandomOrder()->take(5)->get();
        $this->similarAds = Ad::where('is_approved', 1)->where('region_id', $this->ad->region_id)->inRandomOrder()->take(3)->get();
        if (app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getPrefix() == '/profile') {
            // MARK ALL COMMENTS IN THIS AD AD A READ
            foreach (user()->unReadNotifications()->where('type', 'App\Notifications\ReviewNotification')->get() as $notification) {
              if ($notification->data['id'] == $this->ad->id) {
                  $notification->markAsRead();
              }
            }
        }
    }

    // CONTACT USER OWNER
    public function send()
    {
        $validatedData = $this->validate([
            'text' => 'required|string',
        ]);
        // CHECK IF USER SEND TO IT SELF
        if (user()->id == $this->ad->user_id) {
            session()->flash('info', __('app.cant_send_to_your_self'));
            $this->dispatchBrowserEvent('info', ['message' => __('app.cant_send_to_your_self')]);
        }else {
            $contactUser = ContactUser::create([
                'ad_id' => $this->ad->id,
                'user_from' => user()->id,
                'user_to' => $this->ad->user_id,
                'text' => $this->text,
            ]);
            // SEND NOTIFICATION
            Notification::send($this->ad->user, new UserNotification($contactUser->id));

            session()->flash('success', __('app.message_sent'));
            $this->dispatchBrowserEvent('success', ['message' => __('app.message_sent')]);
            $this->reset('text');
        }

    }


    public function sendReport()
    {
        Report::insert($this->ad,$this->description);
        session()->flash('success', __('app.reportSent'));
        $this->dispatchBrowserEvent('success', ['message' => __('app.reportSent')]);
        $this->reset('description');
    }

    public function addToFavorite(Ad $ad)
    {
        // CHECK IF ADD ALREADY EXISTS
        $favoriteCount = Favorite::where('ad_id', $ad->id)->where('user_id', user()->id)->count();
        if ($favoriteCount > 0) {
            return $this->dispatchBrowserEvent('info', ['message' => __('app.ad_already_exists')]);
        }
        $service = new FavoritesService($ad);
        $service->addToFavorite();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_added_favorite')]);
    }


    public function deleteFromFavorite(Ad $ad)
    {
        $service = new FavoritesService($ad);
        $service->deleteFromFavorite();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted_favorite')]);
    }

    public function render()
    {
        return view('livewire.frontend.ads.ad-search');
    }
}
