<?php

namespace App\Http\Livewire\Profile\Invoices;

use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $invoices = auth()->user()->orders()->latest()->paginate(PG);
        return view('livewire.profile.invoices.index' , compact('invoices'))->layout(PROFILE_LAYOUT);
    }
}
