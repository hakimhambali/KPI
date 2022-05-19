<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\KPIAll_;

class DashboardManager extends Component
{
    public function render()
    {
        $unitOrder = "CASE WHEN position = 'CEO (TM2)' THEN 1 ";
        $unitOrder .= "WHEN position = 'Director (TM1)' THEN 2 ";
        $unitOrder .= "WHEN position = 'Senior Leadership Team (SLT) (UM1)' THEN 3 ";
        $unitOrder .= "WHEN position = 'Senior Manager (M3)' THEN 4 ";
        $unitOrder .= "WHEN position = 'Manager (M2)' THEN 5 ";
        $unitOrder .= "WHEN position = 'Assistant Manager (M1)' THEN 6 ";
        $unitOrder .= "WHEN position = 'Senior Executive (E3)' THEN 7 ";
        $unitOrder .= "WHEN position = 'Executive (E2)' THEN 8 ";
        $unitOrder .= "WHEN position = 'Junior Executive (E1)' THEN 9 ";
        $unitOrder .= "WHEN position = 'Senior Non-Executive (NE2)' THEN 10 ";
        $unitOrder .= "WHEN position = 'Junior Non-Executive (NE1)' THEN 11 ";
        $unitOrder .= "ELSE 12 END";

        $userdepartment = auth()->user()->department;
        $users = User::where([['department', '=', $userdepartment], ['role', '!=', 'admin'], ['role', '!=', 'moderator']])->where('name', 'not like', "%Test%")->orderByRaw($unitOrder)->get();
        $units = User::selectRaw('count(id) as total, unit')->groupBy('unit')->where('department', $userdepartment)->where('name', 'not like', "%Test%")->get();
        
        return view('livewire.dashboard.all-manager')->with(compact('users', 'userdepartment', 'units'));
    }
}
