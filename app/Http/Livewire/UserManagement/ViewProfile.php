<?php

namespace App\Http\Livewire\UserManagement;
use App\Models\User;
use App\Models\KPIAll_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Livewire\Component;

class ViewProfile extends Component
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

    // update password
    public function pwd_update(Request $request, $id)
    {
        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect('profile/view')->with("error", "Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect('profile/view')->with("error", "New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        $update = User::find(auth()->user()->id)->update([
            'password' => Hash::make($request->get('new-password'))
        ]);

        return redirect('profile/view')->with("success", "Password successfully changed!");
    }
    
    public function render()
    {
        $year = KPIALL_::where('user_id', '=', auth()->user()->id)->orderBy('year','desc')->pluck('year')->first();
        $month = KPIALL_::where('user_id', '=', auth()->user()->id)->orderBy('month','desc')->pluck('month')->first();
        $kpialls = KPIAll_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $kpiall = KPIAll_::where('user_id', '=', auth()->user()->id)->get();
        $userdata = User::where('id', '=', auth()->user()->id)->first();

        return view('livewire.user-management.view-profile', compact('kpiall','kpialls','userdata'));
    }
}
