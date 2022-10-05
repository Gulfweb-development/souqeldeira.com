<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{

    public $state = [];
    public function mount()
    {
        permation('faq_create');
    }
    public function store()
    {
        Validator::make($this->state, [
            'question_ar' => 'required|string|max:170',
            'question_en' => 'required|string|max:170',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
            ])->validate();
        $this->state['admin_id'] = admin()->id;
        Faq::create($this->state);

        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.faq.index');
    }
    public function render()
    {
        return view('livewire.admin.faq.create')->layout(ADMIN_LAYOUT);
    }
}
