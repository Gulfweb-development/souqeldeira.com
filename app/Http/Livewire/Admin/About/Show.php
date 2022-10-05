<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $about;


    public function mount(About $about)
    {
        permation('about_text_view');
        $this->about = $about->load('admin');
    }
    public function delete($id)
    {
        permation('about_text_delete');
        $this->about->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.about.index');
    }

    public function render()
    {
        return view('livewire.admin.about.show')->layout(ADMIN_LAYOUT);
    }
}
