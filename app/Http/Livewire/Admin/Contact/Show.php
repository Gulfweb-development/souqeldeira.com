<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $contact;


    public function mount(Contact $contact)
    {
        permation('contact_message_view');
        $this->contact = $contact;
    }
    public function delete($id)
    {
        permation('contact_message_delete');
        $this->contact->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.contact.index');
    }

    public function render()
    {
        return view('livewire.admin.contact.show')->layout(ADMIN_LAYOUT);
    }
}
