<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    use WithFileUploads;

    public $state = [];
    public function mount()
    {
        permation('blog_create');
    }

    public function store()
    {

        Validator::make($this->state, [
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $blog = Blog::create($this->state);
        if (toExists('image', $this->state)) {
            $blog->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_created'));
        $this->reset();
        return redirect()->route('admin.blog.index');
    }
    public function render()
    {
        return view('livewire.admin.blog.create')->layout(ADMIN_LAYOUT);
    }
}
