<?php

namespace App\Http\Livewire\Profile\Agency;

use App\Models\Agency;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $name_ar;
    public $name_en;
    public $image;
    public $photo;
    public $text_ar;
    public $text_en;

    public function updatedPhoto()
    {
        $this->image = $this->photo;
    }
    public function store()
    {

        $validatedData = $this->validate([
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $agency = Agency::create([
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'text_ar' => $this->text_ar,
            'text_en' => $this->text_en,
            'user_id' => user()->id,
        ]);

        if ($this->image != '') {
            $agency->uploadFile($this->image);
        }
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_created'));
        return redirect()->route('profile.agency.index');
    }
    public function render()
    {
        abort_unless(authApprovedUserCompany(), 403);
        return view('livewire.profile.agency.create')->layout(PROFILE_LAYOUT);
    }


}
