<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\KPIAll_;

class DashboardManager extends Component
{
    public function render()
    {
        // groupBy('unit')->whereNotNull('unit')->
        $userdepartment = auth()->user()->department;
        $users = User::where([['department', '=', $userdepartment], ['role', '!=', 'admin'], ['role', '!=', 'moderator']])->orderBy('created_at','desc')->get();
        $units = User::selectRaw('count(id) as total, unit')->groupBy('unit')->where('department', $userdepartment)->get();
        // dd($units);
        
        return view('livewire.dashboard.all-manager')->with(compact('users', 'userdepartment', 'units'));
    }
}
