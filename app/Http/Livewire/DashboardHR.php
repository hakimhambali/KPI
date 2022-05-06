<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role_;
use App\Models\KPIAll_;
use Livewire\Component;
use App\Models\Department_;
use App\Models\Unit_;

class DashboardHR extends Component
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

        $department = Department_::all();
        $unit = Unit_::where('status', 'active')->get();

        $departmentArr[] = array();
        foreach ($department as $key => $departments) {
            $user = User::where('role', '!=', 'moderator')->where('role', '!=', 'admin')->where('department', $departments->name)->orderByRaw($unitOrder)->orderBy('name')->get();
            array_push($departmentArr, $user);
        }
        

        return view('livewire.dashboard.all-hr')->with(compact('department', 'departmentArr', 'unit'));
    }
}
