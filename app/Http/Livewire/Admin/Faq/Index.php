<?php

namespace App\Http\Livewire\Admin\Faq;

use App\Models\Faq;
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
        permation('faq_view');
    }
    public function delete(Faq $faq)
    {
        permation('faq_delete');
        $faq->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $faqs = Faq::select('id', toLocale('question'))->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.faq.index', [
            'faqs' => $faqs,
        ])->layout(ADMIN_LAYOUT);
    }
}
