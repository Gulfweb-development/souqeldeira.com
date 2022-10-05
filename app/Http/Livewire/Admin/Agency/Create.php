<?php

namespace App\Http\Livewire\Admin\Agency;

use App\Models\User;
use App\Models\Agency;
use Livewire\Component;
use App\Traits\Validation;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public $users = [];

    public function mount()
    {
        permation('agency_create');
        $this->users = User::approvedCompanies()->get();
    }

    public function store()
    {
        Validator::make($this->state, [
            'user_id' => 'required|exists:users,id',
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $agency = Agency::create($this->state);
        if (toExists('image', $this->state)) {
            $agency->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.agency.index');
    }
    public function render()
    {
        return view('livewire.admin.agency.create')->layout(ADMIN_LAYOUT);
    }
}
