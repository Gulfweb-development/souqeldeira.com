<?php

namespace App\Http\Livewire\Admin\Positions;

use App\Models\Position;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $status = "active";
    public $show = 10;
    public $is_payed = "paid";
    public $user_id = null;

    public function mount()
    {
        $this->user_id = request()->query('user_id' , false);
    }
    public function render()
    {
        $positions = Position::query()
            ->when($this->status == "active" , function ($query) {
                $query->where('expired_at' , '>=' , now());
            })
            ->when($this->status == "InActive" , function ($query) {
                $query->where('expired_at' , '<' , now());
            })
            ->when($this->is_payed == "paid" , function ($query) {
                $query->where('is_payed' ,  true);
            })
            ->when($this->is_payed == "pending" , function ($query) {
                $query->where('is_payed' ,  false);
            })
            ->when($this->search , function ($query) {
                $query->where(function ($subQuery){
                    $subQuery->where('title' , 'like' , '%'.$this->search.'%')
                        ->orwhere('description' , 'like' , '%'.$this->search.'%');
                });
            })
            ->when($this->user_id , function ($query) {
                $query->where('user_id' ,  $this->user_id);
            })
            ->with('user')->latest()->paginate($this->show);
        return view('livewire.admin.positions.index' , compact( 'positions'))->layout(ADMIN_LAYOUT);
    }
}
