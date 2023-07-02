<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use App\Models\Subscriptions as SubscriptionsModel;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];

    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'adv_nurmal_count' => 'required',
            'adv_star_count' => 'required',
            'price' => 'required',
            'expire_time' => 'required|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $ubscription = SubscriptionsModel::create($this->state);
        if (toExists('image', $this->state)) {
            $ubscription->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.subscriptions.index');
    }
    public function render()
    {
        return view('livewire.admin.subscriptions.create')->layout(ADMIN_LAYOUT);
    }
}
