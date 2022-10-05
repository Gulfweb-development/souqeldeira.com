<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class Edit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $blog;

    public function mount(Blog $blog)
    {
        permation('blog_edit');
        $this->state = $blog->load('images')->toArray();
        $this->blog = $blog;
        $this->state['old_image'] = $this->blog->getFile();
    }

    public function update()
    {
        Validator::make($this->state, [
            'title_ar' => 'required|string|max:170',
            'title_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ])->validate();
        $this->state['admin_id'] = admin()->id;
        $this->blog->update($this->state);
        if (toExists('image', $this->state)) {
            $this->blog->deleteFile();
            $this->blog->uploadFile($this->state['image']);
        }
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('admin.blog.index');
    }


    public function render()
    {
        return view('livewire.admin.blog.edit')->layout(ADMIN_LAYOUT);
    }
}
