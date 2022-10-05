<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $faq;


    public function mount(Faq $faq)
    {
        permation('faq_view');
        $this->faq = $faq->load('admin');
    }
    public function delete($id)
    {
        permation('faq_delete');
        $this->faq->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.faq.index');
    }

    public function render()
    {
        return view('livewire.admin.faq.show')->layout(ADMIN_LAYOUT);
    }
}
