<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    public $state = [];
    public $faq;

    public function mount(Faq $faq)
    {
        permation('faq_edit');
        $this->state = $faq->toArray();
        $this->faq = $faq;
    }

    public function update()
    {
        Validator::make($this->state, [
            'question_ar' => 'required|string|max:170',
            'question_en' => 'required|string|max:170',
            'answer_ar' => 'required|string',
            'answer_en' => 'required|string',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->faq->update($this->state);
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.faq.index');
    }


    public function render()
    {
        return view('livewire.admin.faq.edit')->layout(ADMIN_LAYOUT);
    }
}
