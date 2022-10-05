<?php

namespace App\Http\Livewire\Admin\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $company;

    public function mount(Company $company)
    {
        $this->state = $company->load('images')->toArray();
        $this->company = $company;
        $this->state['old_image'] = $this->company->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|unique:companies,email,' . $this->company->id,
            'phone' => 'nullable|numeric|unique:users,email|digits_between:10,15|unique:companies,phone,' . $this->company->id,
            'password' => 'nullable|string|max:100|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_approved' => 'nullable|boolean',
        ])->validate();
        $this->company->update($this->state);
        if (toExists('image', $this->state)) {
            $this->company->deleteFile();
            $this->company->uploadFile($this->state['image']);
        }

        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.company.index');
    }


    public function render()
    {
        return view('livewire.admin.company.edit')->layout(ADMIN_LAYOUT);
    }
}
