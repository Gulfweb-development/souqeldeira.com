<?php

namespace App\Http\Livewire\Admin\Info;

use App\Models\Info;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $info;

    public function mount(Info $info)
    {
        permation('contact_info_edit');
        $this->state = $info->toArray();
        $this->info = $info;
    }

    public function update()
    {
        Validator::make($this->state, [
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
        ])->validate();
        $this->info->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.info.index');
    }


    public function render()
    {
        return view('livewire.admin.info.edit')->layout(ADMIN_LAYOUT);
    }
}
