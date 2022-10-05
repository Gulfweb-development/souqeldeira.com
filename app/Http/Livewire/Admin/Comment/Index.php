<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
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



    public function delete(Comment $comment)
    {
        permation('comment_delete');
        $comment->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function toggleApprove($isApproved, Comment $comment)
    {
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $comment->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
    }



    public function render()
    {
        $comments = Comment::with('ad', 'user')->search($this->search, $this->filterApproved)->latest()->paginate($this->show);

        return view('livewire.admin.comment.index', [
            'comments' => $comments,
        ])->layout(ADMIN_LAYOUT);
    }
}
