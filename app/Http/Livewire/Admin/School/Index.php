<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
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
    public $filterApproved = '';
    public $filterFeatured = '';
    public function mount()
    {
        permation('school_view');
    }
    public function delete(School $school)
    {
        permation('school_delete');
        $school->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $schools = School::select('id', toLocale('title'), 'phone','governorate_id','region_id')->with('images', 'governorate','region')->search($this->search, $this->filterApproved, $this->filterFeatured)->latest()->paginate($this->show);

        return view('livewire.admin.school.index', [
            'schools' => $schools,
        ])->layout(ADMIN_LAYOUT);
    }


}
