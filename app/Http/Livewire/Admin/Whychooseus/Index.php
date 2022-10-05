<?php

namespace App\Http\Livewire\Admin\Whychooseus;

use Livewire\Component;
use App\Models\WhyChooseUs;
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
        permation('about_why_choose_view');
    }
    public function delete(WhyChooseUs $whychooseus)
    {
        permation('about_why_choose_delete');
        $whychooseus->deleteFile();
        $whychooseus->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $whyChooseUs = WhyChooseUs::select('id', toLocale('name'))->with('images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.whychooseus.index', [
            'whyChooseUs' => $whyChooseUs,
        ])->layout(ADMIN_LAYOUT);
    }


}
