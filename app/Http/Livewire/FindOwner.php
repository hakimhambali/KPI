<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FindOwner extends Component
{
    public function render()
    {
        return view('livewire.findowner.all');
    }
}
