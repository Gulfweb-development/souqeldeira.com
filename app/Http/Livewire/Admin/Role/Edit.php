<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;
use App\Models\PermationFor;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $role;
    public $permationFors = [];
    public $permations = [];


    public function mount(Role $role)
    {
        permation('role_edit');
        $this->state = $role->toArray();
        $this->role = $role;
        $this->permationFors = PermationFor::with('permations')->get();
        $this->permations = array_map('strval', $this->role->permations->pluck('id')->toArray());
    }

    public function update()
    {
        Validator::make($this->state, [
            'label_ar' => 'required|string|max:170',
            'label_en' => 'required|string|max:170',
        ])->validate();
        $validatedData = $this->validate([
            'permations' => 'array|required',
            'permations.*' => 'exists:permations,id',
        ]);
        $this->role->update($this->state);
        $this->role->permations()->sync($this->permations);
        session()->flash('success', __('app.data_updated'));
        ;
        // return redirect()->route('admin.role.index');
    }


    public function render()
    {
        return view('livewire.admin.role.edit')->layout(ADMIN_LAYOUT);
    }
}
