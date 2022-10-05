<?php

namespace App\Http\Livewire\Admin\Whychooseus;

use Livewire\Component;
use App\Models\WhyChooseUs;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{

    use WithFileUploads;
    public $state = [];
    public $whychooseus;

    public function mount(WhyChooseUs $whychooseus)
    {
        permation('about_why_choose_edit');
        $this->state = $whychooseus->load('images')->toArray();
        $this->whychooseus = $whychooseus;
        $this->state['old_image'] = $this->whychooseus->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->whychooseus->update($this->state);
        if (toExists('image', $this->state)) {
            $this->whychooseus->deleteFile();
            $this->whychooseus->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.whychooseus.index');
    }


    public function render()
    {
        return view('livewire.admin.whychooseus.edit')->layout(ADMIN_LAYOUT);
    }


}
