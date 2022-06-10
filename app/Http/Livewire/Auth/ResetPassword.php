<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Livewire\Component;

class ResetPassword extends Component
{
    // public $ic = '';
    // public $email = '';
    // public $password = '';
    // public $password_confirmation = '';

    // public $showSuccesNotification = false; 
    // public $showFailureNotification = false;

    // // public $showDemoNotification = false;

    // // public $urlID = '';

    // protected $rules = [
    //     'ic' => 'required|ic|unique:users',
    //     'email' => 'required|unique:users',
    //     'password' => 'required|min:8|confirmed'
    // ];  

    // // public function mount($id) {
    // //     $existingUser = User::find($id);
    // //     $this->urlID = intval($existingUser->id);
    // // }

    public function reset_password(Request $request) {
        $existingUser = User::where('ic', $request->ic)->where('email', $request->email)->first();

        if($existingUser) { 
            $validatedData = $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $existingUser->update([
                'password' => Hash::make($request->password) 
            ]);
            
            return redirect('reset-password')->with("success", "Password successfully changed!");
        } else {
            return redirect('reset-password')->with("error", "Please make sure the IC Number or Email Address you entered is correct.");
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('layouts.base');
    }
}
