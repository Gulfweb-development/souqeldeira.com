<?php

namespace App\Http\Livewire\Admin\Buildingtype;

use Livewire\Component;
use App\Models\BuildingType;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    public $state = [];

    public function mount()
    {
        permation('building_type_create');
    }
    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        BuildingType::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.buildingtype.index');
    }
    public function render()
    {
        return view('livewire.admin.buildingtype.create')->layout(ADMIN_LAYOUT);
    }
}
