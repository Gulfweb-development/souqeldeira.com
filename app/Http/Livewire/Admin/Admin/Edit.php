<?php

namespace App\Http\Livewire\Admin\Admin;

use App\Models\Role;
use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $roles = [];
    public $role_id = '';
    public $admin;

    public function mount(Admin $admin)
    {
        permation('admin_edit');
        $this->state = $admin->load('images')->toArray();
        $this->admin = $admin;
        $this->state['old_image'] = $this->admin->getFile();
        $this->roles = Role::select('id', 'name', toLocale('label'))->get();
        $this->role_id = $this->admin->roles()->first()->id;
    }

    public function update()
    {
        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:admins,email,' . $this->admin->id,
            'password' => 'nullable|string|max:100|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();

        $this->admin->update($this->state);
        $this->admin->roles()->sync($this->role_id);
        if (toExists('image', $this->state)) {
            $this->admin->deleteFile();
            $this->admin->uploadFile($this->state['image']);
        }

        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.admin.index');
    }


    public function render()
    {
        return view('livewire.admin.admin.edit')->layout(ADMIN_LAYOUT);
    }
}
