<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\About;
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
        permation('about_text_view');
    }
    public function delete(About $about)
    {
        permation('about_text_delete');
        $about->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $abouts = About::select('id', toLocale('text'))->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.about.index', [
            'abouts' => $abouts,
        ])->layout(ADMIN_LAYOUT);
    }
}
