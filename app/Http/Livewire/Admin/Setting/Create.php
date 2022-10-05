<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    public function mount()
    {
        permation('setting_create');
    }

    public $state = [
        'publish_all_to_social_media' => 1,
        'is_payment_available' => 0,
    ];

    public function store()
    {
        Validator::make($this->state, [
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'publish_all_to_social_media' => 'required|boolean',
            'is_payment_available' => 'required|boolean',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        Setting::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.setting.index');
    }
    public function render()
    {
        return view('livewire.admin.setting.create')->layout(ADMIN_LAYOUT);
    }
}
