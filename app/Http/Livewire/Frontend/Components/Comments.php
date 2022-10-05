<?php

namespace App\Http\Livewire\Frontend\Components;

use App\Models\Ad;
use App\Models\Comment;
use App\Notifications\ReviewNotification;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

class Comments extends Component
{
    protected $listeners = [
        'refreshIt' => '$refresh'
    ];
    public $ad;
    public $stars;
    public $comment;
    // public $comments;
    // public $commentsCount;


    public function mount(Ad $ad)
    {
        $this->ad = $ad;
    }

    public function submit()
    {
        $this->validate([
            'comment' => 'required|string|min:10|max:100',
            'stars' => 'required|between:1,5',
        ]);
        Comment::create([
            'user_id' => user()->id,
            'ad_id' => $this->ad->id,
            'text' => $this->comment,
            'stars' => $this->stars,
            'is_approved' => 1,
        ]);
        // SEND NOTIFICATION
        Notification::send($this->ad->user, new ReviewNotification($this->ad));
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_created')]);
        $this->reset(['stars', 'comment']);
        $this->emit('refreshIt');
        // $this->mount($this->ad);
    }

    public function render()
    {
        $commentsCount = $this->ad->commentsCount();
        $comments = $this->ad->approvedComments;
        // dd($comments);
        return view('livewire.frontend.components.comments',[
            'commentsCount' => $commentsCount,
            'comments' => $comments,
        ]);
    }
}
