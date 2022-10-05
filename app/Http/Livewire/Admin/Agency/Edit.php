<?php

namespace App\Http\Livewire\Admin\Agency;

use App\Models\User;
use App\Models\Agency;
use Livewire\Component;
use App\Traits\Validation;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $users = [];
    public $agency;

    public function mount(Agency $agency)
    {
        permation('agency_edit');
        $this->state = $agency->load('images','user')->toArray();
        $this->users = User::select('id', 'name')->get();
        $this->agency = $agency;
        $this->state['old_image'] = $this->agency->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'user_id' => 'required|exists:users,id',
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->agency->update($this->state);
        if (toExists('image', $this->state)) {
            $this->agency->deleteFile();
            $this->agency->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.agency.index');
    }


    public function render()
    {
        return view('livewire.admin.agency.edit')->layout(ADMIN_LAYOUT);
    }
}
