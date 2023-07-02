<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use App\Models\Subscriptions as SubscriptionsModel;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $subscription;

    public function mount(SubscriptionsModel $subscription)
    {
        $this->subscription = $subscription;
        $this->state = $subscription->toArray();
        $this->state['old_image'] = $this->subscription->getFile();
    }

    public function update()
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
        $this->subscription->update($this->state);
        if (toExists('image', $this->state)) {
            $this->subscription->deleteFile();
            $this->subscription->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.subscriptions.index');
    }


    public function render()
    {
        return view('livewire.admin.subscriptions.edit')->layout(ADMIN_LAYOUT);
    }
}
