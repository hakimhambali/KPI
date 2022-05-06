<?php

namespace App\Http\Livewire;

use App\Models\Role_;
use App\Models\Unit_;
use Livewire\Component;
use App\Models\Function_;
use App\Models\Position_;
use App\Models\Department_;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Moderator extends Component
{
    public function function()
    {
        $function = Function_::orderBy('id', 'asc')->get();
        return view('livewire.moderator.function', compact('function'));
    }

    public function create_function(Request $request)
    {
        $function = Function_::create([
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'name'=> $request->name,
            'status'=> 'active',
            ]);

        return redirect('/add-function')->with('message', 'Function has been added successfully');
    }

    public function up_function($id)
    {
        Function_::find($id)->update([
            'status'=> 'active',
        ]);

        return redirect('/add-function')->with('message', 'Function status changed from inactive to active successfully');
    }

    public function down_function($id)
    {
        Function_::find($id)->update([
            'status'=> 'inactive',
        ]);

        return redirect('/add-function')->with('message', 'Function status changed from active to inactive successfully');
    }

    public function department()
    {
        $department = Department_::orderBy('id', 'asc')->get();
        return view('livewire.moderator.department', compact('department'));
    }

    public function create_department(Request $request)
    {
        $department = Department_::create([
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'name'=> $request->name,
            'status'=> 'active',
        ]);

        return redirect('/add-department')->with('message', 'Department has been added successfully');
    }

    public function up_department($id)
    {
        Department_::find($id)->update([
            'status'=> 'active',
        ]);

        return redirect('/add-department')->with('message', 'Department status changed from inactive to active successfully');
    }

    public function down_department($id)
    {
        Department_::find($id)->update([
            'status'=> 'inactive',
        ]);

        return redirect('/add-department')->with('message', 'Department status changed from active to inactive successfully');
    }

    public function position()
    {
        $position = Position_::orderBy('id', 'asc')->get();
        return view('livewire.moderator.position', compact('position'));
    }

    public function create_position(Request $request)
    {
        $position = Position_::create([
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'name'=> $request->name,
            'status'=> 'active',
        ]);

        return redirect('/add-position')->with('message', 'Position has been added successfully');
    }

    public function up_position($id)
    {
        Position_::find($id)->update([
            'status'=> 'active',
        ]);

        return redirect('/add-position')->with('message', 'Position status changed from inactive to active successfully');
    }

    public function down_position($id)
    {
        Position_::find($id)->update([
            'status'=> 'inactive',
        ]);

        return redirect('/add-position')->with('message', 'Position status changed from active to inactive successfully');
    }

    public function role()
    {
        $role = Role_::orderBy('id', 'asc')->get();
        return view('livewire.moderator.role', compact('role'));
    }

    public function create_role(Request $request)
    {
        $role = Role_::create([
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'name'=> $request->name,
            'status'=> 'active',
        ]);

        return redirect('/add-role')->with('message', 'Role has been added successfully');
    }

    public function up_role($id)
    {
        Role_::find($id)->update([
            'status'=> 'active',
        ]);

        return redirect('/add-role')->with('message', 'Role status changed from inactive to active successfully');
    }

    public function down_role($id)
    {
        Role_::find($id)->update([
            'status'=> 'inactive',
        ]);

        return redirect('/add-role')->with('message', 'Role status changed from active to inactive successfully');
    }

    public function unit()
    {
        $unit = Unit_::orderBy('id', 'asc')->get();
        return view('livewire.moderator.unit', compact('unit'));
    }

    public function create_unit(Request $request)
    {
        $unit = Unit_::create([
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'name'=> $request->name,
            'status'=> 'active',
        ]);

        return redirect('/add-unit')->with('message', 'Unit has been added successfully');
    }

    public function up_unit($id)
    {
        Unit_::find($id)->update([
            'status'=> 'active',
        ]);

        return redirect('/add-unit')->with('message', 'Unit status changed from inactive to active successfully');
    }

    public function down_unit($id)
    {
        Unit_::find($id)->update([
            'status'=> 'inactive',
        ]);

        return redirect('/add-unit')->with('message', 'Unit status changed from active to inactive successfully');
    }

    public function render()
    {
        return view('livewire.moderator.all');
    }
}