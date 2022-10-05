<?php

namespace App\Http\Livewire\Admin\Buildingtype;

use Livewire\Component;
use App\Models\BuildingType;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $buildingtype;

    public function mount(BuildingType $buildingtype)
    {
        permation('building_type_edit');
        $this->state = $buildingtype->toArray();
        $this->buildingtype = $buildingtype;
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->buildingtype->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.buildingtype.index');
    }


    public function render()
    {
        return view('livewire.admin.buildingtype.edit')->layout(ADMIN_LAYOUT);
    }
}
