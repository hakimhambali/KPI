<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Function_;

class Moderator extends Component
{
    public function function()
    {
        $function = Function_::orderBy('id', 'desc')->get();
        return view('livewire.moderator.function', compact('function'));
    }

    public function department()
    {
        return view('livewire.moderator.department');
    }

    public function position()
    {
        return view('livewire.moderator.position');
    }

    public function role()
    {
        return view('livewire.moderator.role');
    }

    public function unit()
    {
        return view('livewire.moderator.unit');
    }

    public function render()
    {
        return view('livewire.moderator.all');
    }
}