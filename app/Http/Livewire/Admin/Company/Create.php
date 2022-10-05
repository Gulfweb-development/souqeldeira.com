<?php

namespace App\Http\Livewire\Admin\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    use WithFileUploads;

    public $state = [
        'is_approved' => 1,
    ];

    public function store()
    {

        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:companies,email|unique:users,email',
            'phone' => 'nullable|numeric|unique:companies,phone|unique:users,phone|digits_between:10,15',
            'password' => 'required|string|max:100|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_approved' => 'required|boolean',
        ])->validate();
        $this->state['email_verified_at'] = now();
        $company = Company::create($this->state);
        if (toExists('image', $this->state)) {
            $company->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.company.index');
    }
    public function render()
    {
        return view('livewire.admin.company.create')->layout(ADMIN_LAYOUT);
    }

}
