<?php

namespace App\Http\Livewire\Profile\Agency;

use App\Models\Agency;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($agencyId)
    {
        $agency = Agency::where('id', $agencyId)->where('user_id', user()->id)->firstOrFail();
        $agency->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }



    public function render()
    {
        abort_unless(authApprovedUserCompany(),403);
        $agencies = Agency::with('images')->select('id', toLocale('name'),'created_at')->where('user_id', user()->id)->latest()->paginate(PG);
        return view('livewire.profile.agency.index', [
            'agencies' => $agencies,
        ])->layout(PROFILE_LAYOUT);
    }


}
