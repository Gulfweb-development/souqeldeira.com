<?php

namespace App\Http\Livewire\Admin\Comment;

use App\Models\Comment;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $comment;


    public function mount(Comment $comment)
    {
        permation('comment_view');
        $this->comment = $comment->load('ad','user');
    }

    public function toggleApprove($isApproved, Comment $comment)
    {
        $isApprovedReverseCurrentValue = $isApproved == 1 ? 0 : 1;
        $comment->update([
            'is_approved' => $isApprovedReverseCurrentValue,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_updated')]);
        $this->comment = $comment->load('ad','user');
    }
    public function delete($id)
    {
        permation('comment_delete');
        $this->comment->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.comment.index');
    }

    public function render()
    {
        return view('livewire.admin.comment.show')->layout(ADMIN_LAYOUT);
    }
}
