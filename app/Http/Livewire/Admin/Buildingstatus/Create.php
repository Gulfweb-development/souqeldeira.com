<?php

namespace App\Http\Livewire\Admin\Buildingstatus;

use Livewire\Component;
use App\Models\BuildingStatus;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    public $state = [];

    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        BuildingStatus::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.buildingstatus.index');
    }
    public function render()
    {
        return view('livewire.admin.buildingstatus.create')->layout(ADMIN_LAYOUT);
    }
}
