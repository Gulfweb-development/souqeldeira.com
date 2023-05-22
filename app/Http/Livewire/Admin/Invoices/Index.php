<?php

namespace App\Http\Livewire\Admin\Invoices;

use App\Models\Order;
use App\Models\Subscriptions as SubscriptionsModel;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $status = "success";
    public $show = 10;
    public $date = null;
    public $user_id = null;

    public function mount()
    {
        $this->user_id = request()->query('user_id' , false);
    }
    public function render()
    {
        $lists = Order::query()->when($this->search , function ($query) {
            $query->where(function ($subQuery) {
                $subQuery->where('description_en' , 'like' , '%'.$this->search.'%')
                    ->orwhere('description_ar' , 'like' , '%'.$this->search.'%')
                    ->orwhere('price' , $this->search)
                    ->orwhere('id' , $this->search)
                    ->orwhere('transaction_id' , 'like', '%'.$this->search.'%')
                    ->orwhereHas('user', function ($relation_query){
                        $relation_query->where('name', 'like', '%'.$this->search.'%')
                            ->orwhere('name', 'like', '%'.$this->search.'%')
                            ->orwhere('email', 'like', '%'.$this->search.'%')
                            ->orwhere('phone', 'like', '%'.$this->search.'%');
                    });
            });
        })->when($this->status != "all" , function ($query) {
            $query->where('status' , $this->status);
        })->when($this->date, function ($query) {
            $query->whereDate('created_at' , $this->date);
        })->when($this->user_id, function ($query) {
            $query->where('user_id' ,$this->user_id);
        })->with('user')->latest()->paginate($this->show);

        return view('livewire.admin.invoices.index', [
            'lists' => $lists,
        ])->layout(ADMIN_LAYOUT);
    }
}
