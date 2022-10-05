<?php

namespace App\Http\Livewire\Profile\Agency;

use App\Models\Agency;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $agency;
    public $name_ar;
    public $name_en;
    public $image;
    public $photo;
    public $text_ar;
    public $text_en;
    public $old_image;

    public function mount(Agency $agency)
    {
        abort_unless(authApprovedUserCompany(), 403);

        $this->agency = Agency::with('images')->where('user_id', user()->id)->where('id', $agency->id)->firstOrFail();
        $this->name_ar = $this->agency->name_ar;
        $this->name_en = $this->agency->name_en;
        $this->text_ar = $this->agency->text_ar;
        $this->text_en = $this->agency->text_en;
        $this->old_image = $this->agency->getFile();
    }
    public function updatedPhoto()
    {
        $this->image = $this->photo;
    }


    public function update()
    {

        $validatedData = $this->validate([
            'name_ar' => 'required|string|max:170',
            'name_en' => 'required|string|max:170',
            'text_ar' => 'required|string',
            'text_en' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $this->agency->update([
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'text_ar' => $this->text_ar,
            'text_en' => $this->text_en,
        ]);
        if ($this->image != '') {
            $this->agency->deleteFile();
            $this->agency->uploadFile($this->image);
        }
        // PUBLISH TO TWITTER AND FACEBOOK AND INSTRGRAM
        session()->flash('success', __('app.data_updated'));
        return redirect()->route('profile.agency.index');
    }
    public function render()
    {
        return view('livewire.profile.agency.edit')->layout(PROFILE_LAYOUT);
    }

}
