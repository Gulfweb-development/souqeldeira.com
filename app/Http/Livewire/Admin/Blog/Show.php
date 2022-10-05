<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;

class Show extends Component
{
    protected $listeners = [
        'delete'
    ];
    public $blog;


    public function mount(Blog $blog)
    {
        permation('blog_view');
        $this->blog = $blog->load('images', 'admin');
    }
    public function delete($id)
    {
        permation('blog_delete');
        $this->blog->deleteFile();
        $this->blog->delete();
        session()->flash('success', __('app.data_deleted'));
        return redirect()->route('admin.blog.index');
    }

    public function render()
    {
        return view('livewire.admin.blog.show')->layout(ADMIN_LAYOUT);
    }
}
