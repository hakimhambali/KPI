<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\KPIAll_;

class DashboardManager extends Component
{
    public function render()
    {
        $userdepartment = auth()->user()->department;
        $users = User::where([['department', '=', $userdepartment] , ['role', '!=', 'admin']])->Where([['department', '=', $userdepartment] , ['role', '!=', 'moderator']])->orderBy('created_at','desc')->get();
        return view('livewire.dashboard.all-manager')->with(compact('users', 'userdepartment'));
    }
}
