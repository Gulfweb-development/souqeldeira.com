<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use Livewire\Component;

class Show extends Component
{


    protected $listeners = [
        'delete'
    ];
    public $school;


    public function mount(School $school)
    {
        permation('school_view');
        $this->school = $school->load('images','region','governorate');
    }
    public function delete($id)
    {
        permation('school_delete');
        $this->school->deleteFile();
        $this->school->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.school.index');
    }

    public function render()
    {
        return view('livewire.admin.school.show')->layout(ADMIN_LAYOUT);
    }


}
