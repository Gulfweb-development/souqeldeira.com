<?php

namespace App\Http\Livewire\Admin\Positions;

use App\Models\Order;
use App\Models\Position;
use App\Models\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $position ;
    public $type ;
    public $title ;
    public $text ;
    public $image ;
    public function mount($id)
    {
        $position = Position::query()->find($id);
        if ( blank($position) )
            abort(404);
        $this->position = $position;
        $this->type = filled($position->image) ? "image" : "text";
        $this->title = $position->title;
        $this->text = $position->description;
    }

    public function edit()
    {
        if ($this->type == "image") {
            $this->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
            $this->text = null;
            $this->title = null;
        } else {
            $this->validate([
                'title' => 'required|string|max:75',
                'text' => 'required|string|max:255',
            ]);
            $this->image = null;
        }

        $url = null;
        if ($this->image != NULL) {
            $dateTime = date('Ymd_His');
            $fileName = $dateTime . '_' . Str::random(20) . '_' . $this->image->getClientOriginalName();
            $this->image->storeAs('uploads', $fileName);
            $url = 'uploads/' . $fileName;
        }

        $this->position->update([
            'title' => $this->title,
            'description' => $this->text,
            'image' => $url
        ]);

        return redirect()->route('admin.positions.index')->with('success', trans('app.data_updated'));;
    }

    public function render()
    {
        return view('livewire.admin.positions.edit')->layout(ADMIN_LAYOUT);
    }
}
