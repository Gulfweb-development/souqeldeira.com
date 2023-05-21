<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use App\Models\Subscriptions as SubscriptionsModel;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $subscription;

    public function mount(SubscriptionsModel $subscription)
    {
        $this->subscription = $subscription;
        $this->state = $subscription->toArray();
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
        ])->validate();
        $this->subscription->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.subscriptions.index');
    }


    public function render()
    {
        return view('livewire.admin.subscriptions.edit')->layout(ADMIN_LAYOUT);
    }
}
