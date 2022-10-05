<?php

namespace App\Http\Livewire\Frontend\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filter;


    public function render()
    {
        $blogs = Blog::paginate(PG);
        return view('livewire.frontend.blog.blogs', [
            'blogs' => $blogs,
        ]);
    }


}
