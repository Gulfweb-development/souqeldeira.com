<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [
        'is_approved' => 1,
        'type' => 'USER',
        'field' => 'ALL',
    ];
    public $governorates = [];
    public $governorate_ids = [];

    public function mount()
    {
        permation('user_create');
        abort(404);
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
    }

    public function store()
    {

        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone|regex:/^\+965([0-9]){8}$/',
            'password' => 'required|string|max:100|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_approved' => 'required|boolean',
            'type' => 'required|in:COMPANY,USER',
            'field' => 'required|in:ALL,RENT,SALE,EXCHANGE',
            'description_ar' => 'required|string|min:20',
            'description_en' => 'required|string|min:20',
        ])->validate();
        $this->validate([
            'governorate_ids' => 'required|array',
        ]);
        $this->state['email_verified_at'] = now();
        $user = User::create($this->state);
        $user->governorates()->sync($this->governorate_ids);
        if (toExists('image', $this->state)) {
            $user->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.user.index');
    }
    public function render()
    {
        return view('livewire.admin.user.create')->layout(ADMIN_LAYOUT);
    }
}
