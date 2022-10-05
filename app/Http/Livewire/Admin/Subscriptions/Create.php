<?php

namespace App\Http\Livewire\Admin\Subscriptions;

use App\Models\Subscriptions as SubscriptionsModel;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
 
    public $state = [];

    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'adv_nurmal_count' => 'required',
            'adv_star_count' => 'required',
            'price' => 'required',
        ])->validate();
        SubscriptionsModel::create($this->state);
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.subscriptions.index');
    }
    public function render()
    {
        return view('livewire.admin.subscriptions.create')->layout(ADMIN_LAYOUT);
    }
}
