<?php

namespace App\Http\Livewire\Frontend\School;

use App\Models\School as SchoolModel;
use Livewire\Component;

class School extends Component
{

    public $school;
    public $recentAds;
    public $featuredAds;
    public $similarAds;

    public function mount($slug, $id)
    {
        $this->school = SchoolModel::where('id', $id)->firstOrFail();
        $this->recentAds = SchoolModel::latest()->take(3)->get();
        $this->featuredAds = SchoolModel::inRandomOrder()->take(5)->get();
        $this->similarAds = SchoolModel::where('region_id', $this->school->region_id)->inRandomOrder()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.frontend.school.school');
    }

}
