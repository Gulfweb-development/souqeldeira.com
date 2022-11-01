<?php

namespace App\Http\Livewire\Admin\Report;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'delete',
    ];

    public $show = 10;

    public function mount()
    {
    }
    public function delete(Report $report)
    {
        $report->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $reports = Report::orderBy('isSeen')->latest()->paginate($this->show);
        foreach ($reports as $report)
            $report->seen();
        return view('livewire.admin.report.index', [
            'reports' => $reports,
        ])->layout(ADMIN_LAYOUT);
    }


}
