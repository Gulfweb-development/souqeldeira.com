<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
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
        permation('blog_view');
    }
    public function delete(Blog $blog)
    {
        permation('blog_delete');
        $blog->deleteFile();
        $blog->delete();
        $this->dispatchBrowserEvent('success', ['message' => __('app.data_deleted')]);
    }

    public function render()
    {
        $blogs = Blog::select('id', toLocale('title'))->with('images')->search($this->search)->latest()->paginate($this->show);

        return view('livewire.admin.blog.index', [
            'blogs' => $blogs,
        ])->layout(ADMIN_LAYOUT);
    }
}
