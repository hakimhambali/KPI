<?php

namespace App\Http\Livewire\UserManagement;
use Auth;

use App\Models\User;
use App\Models\Unit_;
use Livewire\Component;
use App\Models\Position_;
use App\Models\Department_;
use Illuminate\Http\Request;

class EditProfile extends Component
{
    public User $user;
    public $showSuccesNotification  = false;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.ic' => 'required|min:12|unique:users',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3'
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function save() {
        if(env('IS_DEMO')) {
           $this->showDemoNotification = true;
        } else {
            $this->validate();
            $this->user->save();
            $this->showSuccesNotification = true;
        }
    }

    public function profile_update(Request $request, $id) { 
        $profile = User::find($id)->update([
            'name' => $request->name,
            'ic' => $request->ic,
            'nostaff' => $request->nostaff,
            'position' => $request->position,
            'department' => $request->department,
            'unit' => $request->unit,
        ]);
        return redirect()->back()->with('message', 'Profile Updated Successfully');
    }

    public function render()
    {
        $position = Position_::all();
        $department = Department_::all();
        $unit = Unit_::all();
        return view('livewire.user-management.edit-profile')->with(compact('position', 'department', 'unit'));
    }
}
