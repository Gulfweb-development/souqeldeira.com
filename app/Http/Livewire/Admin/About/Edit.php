<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $about;

    public function mount(About $about)
    {
        permation('about_text_edit');
        $this->state = $about->toArray();
        $this->about = $about;
    }

    public function update()
    {
        Validator::make($this->state, [
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->about->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.about.index');
    }


    public function render()
    {
        return view('livewire.admin.about.edit')->layout(ADMIN_LAYOUT);
    }
}
