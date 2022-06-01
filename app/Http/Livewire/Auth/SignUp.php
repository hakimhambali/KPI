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
    public $starting_month = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email:rfc,dns|unique:users',
        'ic' => 'required|min:12|unique:users',
        'password' => 'required',
        'nostaff' => 'required|unique:users',
        'position' => 'required',
        'department' => 'required',
        'unit' => 'required',
        'starting_month' => 'required'
    ];

    public function mount() {
        if(auth()->user()){
            redirect('/homepage');
        }
    }

    public function register() {
        $this->validate();
        if ($this->position == 'CEO (TM2)' || $this->position ==  'Director (TM1)' || $this->position == 'Senior Leadership Team (SLT) (UM1)') {
            $role = 'hr';
        } elseif ($this->position == 'Assistant Manager (M1)' || $this->position == 'Manager (M2)' || $this->position == 'Senior Manager (M3)') {
            $role = 'manager';
        } else {
            $role = 'employee';
        }

        $user = User::create([
            'name' => ucwords($this->name),
            'email' => $this->email,
            'ic' => $this->ic,
            'nostaff' => $this->nostaff,
            'position' => $this->position,
            'department' => $this->department,
            'unit' => $this->unit,
            'role' => $role,
            'password' => Hash::make($this->password),
            'starting_month' => $this->starting_month,
        ]);

        // auth()->login($user);

        return redirect('/login')->with('message', 'Your Account Has Been Created Successfully. Please Log In');
    }

    public function render()
    {
        $position = Position_::all();
        $department = Department_::all();
        $unit = Unit_::all();
        
        return view('livewire.auth.sign-up')->with(compact('position', 'department', 'unit'));
    }
}
