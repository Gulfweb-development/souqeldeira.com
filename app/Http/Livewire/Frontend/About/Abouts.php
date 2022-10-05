<?php

namespace App\Http\Livewire\Frontend\About;

use App\Models\About;
use App\Models\WhyChooseUs;
use Livewire\Component;

class Abouts extends Component
{
    public $whyChooseUs;
    public $about;

    public function mount()
    {
        $this->about = About::latest()->first();
        $this->whyChooseUs = WhyChooseUs::all();
    }

    public function render()
    {
        return view('livewire.frontend.about.abouts');
    }
}
