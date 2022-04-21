<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Role_;
use App\Models\KPIAll_;
use Livewire\Component;
use App\Models\Department_;

class DashboardHR extends Component
{
    public function render()
    {
        $department = Department_::all();

        $departmentArr[] = array();
        foreach ($department as $key => $departments) {
            $user = User::where('role', '!=', 'moderator')->where('role', '!=', 'admin')->where('department', $departments->name)->get();
            array_push($departmentArr, $user);
        }

        return view('livewire.dashboard.all-hr')->with(compact('department', 'departmentArr'));
    }
}
