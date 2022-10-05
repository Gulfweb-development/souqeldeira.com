<?php

namespace App\Http\Livewire\Admin\Buildingstatus;

use App\Models\BuildingStatus;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $buildingstatus;

    public function mount(BuildingStatus $buildingstatus)
    {
        $this->state = $buildingstatus->toArray();
        $this->buildingstatus = $buildingstatus;
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->buildingstatus->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.buildingstatus.index');
    }


    public function render()
    {
        return view('livewire.admin.buildingstatus.edit')->layout(ADMIN_LAYOUT);
    }
}
