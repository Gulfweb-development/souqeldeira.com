<?php

namespace App\Http\Livewire\Frontend\Agency;

use App\Models\Ad;
use App\Models\User;
use Livewire\Component;

class Agency extends Component
{
    public $ad;
    public $recentAds;
    public $featuredAds;
    public $similarAds;
    public $user;
    public $recentUsers;
    public $featuredUsers;

    public function mount($slug, $id)
    {
        $this->user = User::where('is_approved',1)->where('id',$id)->where('type','COMPANY')->firstOrFail();
        $this->ad = Ad::find(1);
        $this->recentUsers = User::with('images')->select('id','name','is_approved','type','phone')->where('is_approved', 1)->where('type', 'COMPANY')->latest()->take(3)->get();
        $this->featuredUsers = User::with('images')->select('id', 'name','is_approved','type','is_featured','phone')->where('is_approved', 1)->where('is_featured', 1)->where('type','COMPANY')->inRandomOrder()->take(5)->get();
    }
    public function render()
    {
        return view('livewire.frontend.agency.agency');
    }
}
