<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $setting;

    public function mount(Setting $setting)
    {
        permation('setting_edit');
        $this->state = $setting->toArray();
        $this->setting = $setting;
    }

    public function update()
    {
        Validator::make($this->state, [
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'facebook' => 'required|string|max:170',
            'twitter' => 'required|string|max:170',
            'instagram' => 'required|string|max:170',
            'youtube' => 'required|string|max:170',
            'publish_all_to_social_media' => 'required|boolean',
            'is_payment_available' => 'required|boolean',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->setting->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.setting.index');
    }


    public function render()
    {
        return view('livewire.admin.setting.edit')->layout(ADMIN_LAYOUT);
    }
}
