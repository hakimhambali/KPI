<?php

namespace App\Http\Livewire;
use App\Models\User;

use Livewire\Component;

class Training extends Component
{
    public function render()
    {
        $user = User::all();
        return view('livewire.training.all', compact('user'));
    }
}
