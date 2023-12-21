<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $user;
    public $governorates = [];
    public $governorate_ids = [];

    public function mount(User $user)
    {
        permation('user_edit');
        $this->state = $user->load('images')->toArray();
        $this->user = $user;
        $this->state['old_image'] = $this->user->getFile();
        $this->governorates = Governorate::select('id', toLocale('name'))->get();
        $this->governorate_ids = $this->user->governorates->pluck('id');
    }

    public function update()
    {
        Validator::make($this->state, [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            // 'phone' => 'nullable|numeric|unique:users,phone|regex:'.phoneNumberFormat().'' . $this->user->id,
            'password' => 'nullable|string|max:100|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'is_approved' => 'nullable|boolean',
            'description_ar' => 'nullable|string|min:20|max:300',
            'description_en' => 'nullable|string|min:20|max:300',
            'field' => 'nullable|in:ALL,RENT,SALE,EXCHANGE,REQUEST',
        ])->validate();
        $this->validate([
            'governorate_ids' => 'nullable|array',
        ]);

        unset($this->state['email']);
        unset($this->state['phone']);
          unset($this->state['activated_code']);
            unset($this->state['adv_nurmal_count']);
              unset($this->state['adv_star_count']);

        // dd($this->state);
        $this->user->update($this->state);
        $this->user->governorates()->sync($this->governorate_ids);
        if (toExists('image', $this->state)) {
            $this->user->deleteFile();
            $this->user->uploadFile($this->state['image']);
        }

        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.user.index');
    }


    public function render()
    {
        return view('livewire.admin.user.edit')->layout(ADMIN_LAYOUT);
    }
}
