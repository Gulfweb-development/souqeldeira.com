<?php

namespace App\Http\Livewire\Frontend\Contact;

use App\Models\Contact;
use App\Models\Info;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Contacts extends Component
{
    public $state = [];
    // public $info;
    // public function mount()
    // {
    //     $this->info = Info::latest()->first();
    // }

    public function send()
    {
        Validator::make($this->state, [
            'first_name' => 'required|string|min:3"max:50',
            'last_name' => 'required|string|min:3"max:50',
            'email' => 'required|email|min:10|max:50',
            'message' => 'required|string|min:20|max:300',
        ])->validate();

        Contact::create($this->state);
        $this->reset();
        session()->flash('success', __('app.message_sent'));
    }
    public function render()
    {
        $info = Info::latest()->first();
        return view('livewire.frontend.contact.contacts',[
            'info' => $info,
        ]);
    }
}
