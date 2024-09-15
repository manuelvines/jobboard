<?php

namespace App\Livewire\Public;
use Livewire\Component;

class SearchJob extends Component
{

    public $countries = [];
    public $states = [];


    public function render()
    {
        return view('livewire.public.search-job');
    }
}
