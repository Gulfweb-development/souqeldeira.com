<?php

namespace App\Http\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

   public $state = [];

   public function mount()
   {
        permation('governorate_create');
   }

    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $governorate = Governorate::create($this->state);
        if (toExists('image',$this->state)) {
            $governorate->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.governorate.index');
    }
    public function render()
    {
        return view('livewire.admin.governorate.create')->layout(ADMIN_LAYOUT);
    }
}
