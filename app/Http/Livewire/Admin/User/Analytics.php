<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\Order;
use App\Models\SubscriptionHistories;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Analytics extends Component
{
    public $user = null;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $analytics = cache()->remember('userChart_'.$this->user->id ,  5 , function () {
            $TotalAdsDetailsView = $this->user->ads()->sum('views');
            $AllAds = $this->user->ads()->withTrashed()->select('tracks')->get();
            $popularRegin = $this->user->ads()->with('governorate')->groupby('governorate_id')->selectRaw('count(governorate_id) as num , governorate_id')->orderByDesc('num')->limit(5)->withTrashed()->get();
            $TotalAdsListView = 0;
            $TotalAdsPhoneClicks = 0;
            $TotalAdsWhatsappClicks = 0;
            foreach ($AllAds as $ads) {
                $tracks = optional($ads->tracks);
                $TotalAdsListView += $tracks->view_list ?? 0;
                $TotalAdsPhoneClicks += $tracks->click_tel ?? 0;
                $TotalAdsWhatsappClicks += $tracks->click_whatsapp ?? 0;
            }
            $tracks = optional($this->user->tracks);
            $TotalOfficeView = $tracks->click_list ?? 0;
            $TotalOfficeListing = $tracks->view_list ?? 0;
            return compact('TotalAdsDetailsView' , 'TotalAdsListView' ,'TotalAdsPhoneClicks' ,'TotalAdsWhatsappClicks' ,'TotalOfficeView' ,'TotalOfficeListing' , 'popularRegin') ;
        });

        return view('livewire.admin.user.analytics', [
            'analytics' => $analytics,
        ])->layout(ADMIN_LAYOUT);
    }

}
