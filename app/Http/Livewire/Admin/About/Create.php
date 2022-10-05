<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    public $state = [];
    public function mount()
    {
        permation('about_text_create');
    }
    public function store()
    {
        Validator::make($this->state, [
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        About::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.about.index');
    }
    public function render()
    {
        return view('livewire.admin.about.create')->layout(ADMIN_LAYOUT);
    }
}
