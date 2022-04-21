<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Models\Unit_;
use Livewire\Component;
use App\Models\Position_;
use App\Models\Department_;
use Illuminate\Support\Facades\Hash;

class SignUp extends Component
{
    public $name = '';
    public $email = '';
    public $ic = '';
    public $nostaff = '';
    public $position = '';
    public $department = '';
    public $unit = '';
    public $hr = '';
    public $role = '';
    public $password = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email:rfc,dns|unique:users',
        'ic' => 'required|min:12|unique:users',
        'password' => 'required|min:6',
        'nostaff' => 'required|min:3',
        'position' => 'required|min:3',
        'department' => 'required|min:3',
        'unit' => 'required|min:3'
    ];

    public function mount() {
        if(auth()->user()){
            redirect('/homepage');
        }
    }

    public function register() {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'ic' => $this->ic,
            'nostaff' => $this->nostaff,
            'position' => $this->position,
            'department' => $this->department,
            'unit' => $this->unit,
            'role' => 'employee',
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect('/homepage');
    }

    public function render()
    {
        // TAK FUNCTION PUN, TENGOK KAT FILE APPSERVICEPROVIDER.PHP, DECLARE VARIABLE KAT SITU
        $position = Position_::all();
        $department = Department_::all();
        $unit = Unit_::all();
        // return view('livewire.auth.sign-up')->with(compact('position', 'department', 'unit'));
        return view('livewire.auth.sign-up')->with(compact('position', 'department', 'unit'));
    }
}
