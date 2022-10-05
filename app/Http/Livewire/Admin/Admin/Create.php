<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Models\Admin;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public $roles = [];
    public $role_id= '';

    public function mount()
    {
        permation('admin_create');
        $this->roles = Role::select('id','name',toLocale('label'))->get();
    }

    public function store()
    {
        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|max:100|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ])->validate();

            $validatedData = $this->validate([
                'role_id' => 'required|exists:roles,id',
            ]);
        $admin = Admin::create($this->state);
        $admin->roles()->sync($this->role_id);
        if (toExists('image', $this->state)) {
            $admin->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.admin.index');
    }
    public function render()
    {
        return view('livewire.admin.admin.create')->layout(ADMIN_LAYOUT);
    }
}
