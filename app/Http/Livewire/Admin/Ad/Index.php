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
    public $filterStatus = "active";
    public $filterApproved = '';
    public $filterFeatured = '';
    public $user_id = null;
    public function mount()
    {
        permation('ad_view');
        $this->user_id = request()->query('user_id' , false);
        if ( $this->user_id )
            $this->filterStatus = "all" ;
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
        $ads = Ad::select('id', 'title','price','is_featured','tracks','views','is_approved','archived_at','deleted_at', 'building_type_id','phone')->with('images','buildingType')->search($this->search,$this->filterApproved,$this->filterFeatured)->latest()
            ->when($this->filterStatus == "all" , function ($query) {
                $query->withTrashed();
            })->when($this->filterStatus == "active" , function ($query) {
                $query->where('archived_at' , '>=' , now());
            })->when($this->filterStatus == "expire" , function ($query) {
                $query->withTrashed()->where('archived_at' , '<' , now());
            })->when($this->user_id, function ($query) {
                $query->where('user_id' ,$this->user_id);
            })
            ->paginate($this->show);

        return view('livewire.admin.ad.index', [
            'ads' => $ads,
        ])->layout(ADMIN_LAYOUT);
    }
}
