<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use App\Models\User;

class App extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $user = User::find(auth()->user()->id)->orderBy('created_at','desc')->take(3)->get();
        
        return view('layouts.app')->with(compact('user'));
    }
}
