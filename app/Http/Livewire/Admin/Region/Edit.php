<?php

namespace App\Http\Livewire\Admin\Region;

use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $governorates = [];
    public $region;

    public function mount(Region $region)
    {
        permation('region_edit');
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->state = $region->load('governorate')->toArray();
        $this->region = $region;
    }

    public function update()
    {
        Validator::make($this->state, [
            'governorate_id' => 'required|exists:governorates,id',
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->region->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.region.index');
    }


    public function render()
    {
        return view('livewire.admin.region.edit')->layout(ADMIN_LAYOUT);
    }
}
