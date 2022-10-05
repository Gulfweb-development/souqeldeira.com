<?php

namespace App\Http\Livewire\Admin;

use App\Models\Ad;
use App\Models\Faq;
use App\Models\User;
use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;

class Dashboard extends Component
{
    public $approvedAds = 0;
    public $penddingAds = 0;
    public $companyUsers = 0;
    public $normalUsers = 0;
    public $registeredUsers = 0;
    public $governorates = 0;
    public $regions = 0;
    public $faqs = 0;
    public function mount()
    {
        $this->approvedAds = Ad::where('is_approved',1)->count();
        $this->penddingAds = Ad::where('is_approved',0)->count();
        $this->companyUsers = User::where('type','COMPANY')->count();
        $this->normalUsers = User::where('type','USER')->count();
        $this->registeredUsers = User::count();
        $this->governorates = Governorate::count();
        $this->regions = Region::count();
        $this->faqs = Faq::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->layout(ADMIN_LAYOUT);
    }
}
