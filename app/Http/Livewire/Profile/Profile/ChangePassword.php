<?php

namespace App\Http\Livewire\Profile\Profile;

use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{

    public $old_password;
    public $password;
    public $password_confirmation;



    public function updatePassword()
    {
        $validatedData = $this->validate([
            'old_password' => 'required|string|max:100',
            'password' => 'required|string|max:100|confirmed',
        ]);
        if (Hash::check($this->old_password,user()->password)) {
            user()->update([
                'password' => $this->password,
            ]);
            $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
            $this->reset();
        }else{
            $this->dispatchBrowserEvent('info', ['message' => __('app.old_password_invalid')]);
        }

    }
    public function render()
    {
        return view('livewire.profile.profile.change-password')->layout(PROFILE_LAYOUT);
    }
}
