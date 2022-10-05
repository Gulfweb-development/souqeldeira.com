<?php

namespace App\Http\Livewire\Admin\Whychooseus;

use Livewire\Component;
use App\Models\WhyChooseUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    use WithFileUploads;

    public $state = [];
    public function mount()
    {
        permation('about_why_choose_create');
    }
    public function store()
    {

        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $whyChooseUS = WhyChooseUs::create($this->state);
        if (toExists('image', $this->state)) {
            $whyChooseUS->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.whychooseus.index');
    }
    public function render()
    {
        return view('livewire.admin.whychooseus.create')->layout(ADMIN_LAYOUT);
    }
}
