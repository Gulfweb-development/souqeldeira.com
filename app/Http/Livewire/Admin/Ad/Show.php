<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use App\Models\Track;
use Carbon\CarbonPeriod;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $ad;
    public $chart = [];


    public function mount(Ad $ad)
    {
        permation('ad_view');

        $this->ad = $ad->load('images', 'user','buildingType','region','governorate');
        $this->chart = cache()->remember('advertiseChart_'.$ad->id ,  5 , function () use ($ad) {
            $period = CarbonPeriod::create(now()->subDays(7), now());
            $chart = [];
            foreach ($period as $i => $date) {
                $chart['day'][$i] = $date->format('M d');
                $chart['advertise']['view'][$i] = Track::query()->whereDate('created_at', $date)->where([
                    'belongs_to_type' => 'ad',
                    'type' => 'view',
                    'belongs_to' => $ad->id,
                ])->count();
                $chart['advertise']['click'][$i] = Track::query()->whereDate('created_at', $date)->where([
                    'belongs_to_type' => 'ad',
                    'type' => 'click',
                    'belongs_to' => $ad->id,
                ])->count();
                $chart['advertise']['telephone'][$i] = Track::query()->whereDate('created_at', $date)->where([
                    'belongs_to_type' => 'ad_tel',
                    'type' => 'click',
                    'belongs_to' => $ad->id,
                ])->count();
                $chart['advertise']['whatsapp'][$i] = Track::query()->whereDate('created_at', $date)->where([
                    'belongs_to_type' => 'ad_whatsapp',
                    'type' => 'click',
                    'belongs_to' => $ad->id,
                ])->count();
            }
            return $chart;
        });
    }
    public function delete($id)
    {
        permation('ad_delete');
        $this->ad->deleteFile();
        $this->ad->forceDelete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.ad.index');
    }


    public function toggleApprove($isApproved, Ad $ad)
    {
        permation('ad_edit');
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $ad->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
        $this->ad = $ad->load('images', 'user', 'buildingType');
    }

    public function render()
    {
        return view('livewire.admin.ad.show')->layout(ADMIN_LAYOUT);
    }
}
