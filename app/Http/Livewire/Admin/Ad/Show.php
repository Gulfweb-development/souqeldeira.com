<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $ad;


    public function mount(Ad $ad)
    {
        permation('ad_view');
        $this->ad = $ad->load('images', 'user','buildingType','region','governorate');
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
