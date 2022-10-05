<?php

namespace App\Http\Livewire\Admin\Whychooseus;

use App\Models\WhyChooseUs;
use Livewire\Component;

class Show extends Component
{

    protected $listeners = [
        'delete'
    ];
    public $whychooseus;


    public function mount(WhyChooseUs $whychooseus)
    {
        permation('about_why_choose_view');
        $this->whychooseus = $whychooseus->load('images', 'admin');
    }
    public function delete($id)
    {
        permation('about_why_choose_delete');
        $this->whychooseus->deleteFile();
        $this->whychooseus->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.whychooseus.index');
    }

    public function render()
    {
        return view('livewire.admin.whychooseus.show')->layout(ADMIN_LAYOUT);
    }
}
