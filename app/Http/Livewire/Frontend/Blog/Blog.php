<?php

namespace App\Http\Livewire\Frontend\Blog;

use App\Models\Blog as BlogModel;
use Livewire\Component;

class Blog extends Component
{
    public $blog;
    public $recentBlogs;

    public function mount($slug, $id)
    {
        $this->blog = BlogModel::findOrFail($id);
        $this->recentBlogs = BlogModel::latest()->take(3)->get();
    }
    public function render()
    {
        return view('livewire.frontend.blog.blog');
    }
}
