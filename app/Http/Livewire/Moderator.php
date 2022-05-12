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

    public function delete_function($id)
    {
        $function = Function_::find($id);
        $function->delete();

        return redirect()->back()->with('message', 'Function deleted successfully');
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

    public function delete_department($id)
    {
        $department = Department_::find($id);
        $department->delete();

        return redirect()->back()->with('message', 'Department deleted successfully');
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

    public function delete_position($id)
    {
        $position = Position_::find($id);
        $position->delete();

        return redirect()->back()->with('message', 'Position deleted successfully');
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

    public function delete_role($id)
    {
        $role = Role_::find($id);
        $role->delete();

        return redirect()->back()->with('message', 'Role deleted successfully');
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

    public function delete_unit($id)
    {
        $unit = Unit_::find($id);
        $unit->delete();

        return redirect()->back()->with('message', 'Unit deleted successfully');
    }

    public function render()
    {
        return view('livewire.moderator.all');
    }
}