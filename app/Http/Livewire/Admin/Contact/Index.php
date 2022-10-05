<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $search;
    public $show = 10;

    public function mount()
    {
        permation('contact_message_view');
    }
    public function delete(Contact $contact)
    {
        permation('contact_message_delete');
        $contact->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $contacts = Contact::search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.contact.index', [
            'contacts' => $contacts,
        ])->layout(ADMIN_LAYOUT);
    }


}
