<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class Profile extends Component
{   
    
    public function index()
    {
        $user = \User::name();
        return view('livewire.profile', ['user' => $name]);
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
