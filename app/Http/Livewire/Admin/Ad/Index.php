<?php

namespace App\Http\Livewire\Admin\Ad;

use App\Models\Ad;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $search;
    public $show = 10;
    public $filterApproved = '';
    public $filterFeatured = '';
    public function mount()
    {
        permation('ad_view');
    }
    public function delete(Ad $ad)
    {
        permation('ad_delete');
        $ad->forceDelete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function toggleApprove($isApproved, Ad $ad)
    {
        permation('ad_edit');
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $ad->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }

    public function render()
    {
        $ads = Ad::select('id', 'title','price','is_featured','is_approved', 'building_type_id','phone')->with('images','buildingType')->search($this->search,$this->filterApproved,$this->filterFeatured)->latest()->paginate($this->show);

        return view('livewire.admin.ad.index', [
            'ads' => $ads,
        ])->layout(ADMIN_LAYOUT);
    }
}
