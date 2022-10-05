<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\PermationFor;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public $permationFors = [];
    public $permations = [];
    public function mount()
    {
        permation('role_create');
        $this->permationFors = PermationFor::with('permations')->get();
    }

    public function store()
    {
        Validator::make($this->state, [
            'label_ar' => 'required|string|max:170',
            'label_en' => 'required|string|max:170',
        ])->validate();
        $validatedData = $this->validate([
            'permations' => 'array|required',
            'permations.*' => 'exists:permations,id',
        ]);
        $role = Role::create($this->state);
        $role->permations()->sync($this->permations);
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.role.index');
    }
    public function render()
    {
        return view('livewire.admin.role.create')->layout(ADMIN_LAYOUT);
    }
}
