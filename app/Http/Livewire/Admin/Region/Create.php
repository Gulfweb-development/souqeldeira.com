<?php

namespace App\Http\Livewire\Admin\Region;

use App\Models\Region;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public $governorates = [];

    public function mount()
    {
        permation('region_create');
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
    }


    public function store()
    {
        Validator::make($this->state, [
            'governorate_id' => 'required|exists:governorates,id',
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
        ])->validate();

        $this->state['admin_id'] = admin()->id;
        Region::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.region.index');
    }
    public function render()
    {
        return view('livewire.admin.region.create')->layout(ADMIN_LAYOUT);
    }
}
