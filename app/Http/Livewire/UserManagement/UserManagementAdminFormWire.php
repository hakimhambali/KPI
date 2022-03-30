<?php

namespace App\Http\Livewire\UserManagement;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UserManagementAdminFormWire extends Component
{
    public $id_user;
    public $name;
    public $ic;
    public $role;
    public $password;
    public $model_id;
    public $action;

    protected $listeners = [
        'getModelId'
    ];

    public function getModelId($model_id)
    {
        $user = User::find($model_id);
        $this->model_id = $user->id;
        $this->name = $user->name;
        $this->ic = $user->ic;
        $this->password = $user->password;
        $this->role = $user->role;
    }

    public function store()
    { 
        if($this->model_id)
        {
            $this->validate([
                'name' => 'required|string|max:255',
                'ic' => 'required|min:12|unique:users',
                'role' => 'required',
            ]);
            $update = User::find($this->model_id);
            $update->name = $this->name;
            $update->ic = $this->ic;
            if(($this->password != null) || ($this->password != ''))
            {
                $this->validate([
                   
                    'password' => 'required|string|min:6',
                    
                ]);
                $update->password = Hash::make($this->password);
            }
            $update->role = $this->role;
            $update->save();
            session()->flash('message', 'User successfully updated');
        }
        else
        {
            $this->validate([
                'name' => 'required|string|max:255',
                'ic' => 'required|min:12|unique:users',
                'password' => 'required|string|min:6',
                'role' => 'required',
            ]);
            $add = New User;
            $add->name = $this->name;
            $add->ic = $this->ic;
            $add->password = Hash::make($this->password);
            $add->role = $this->role;
            $add->save();
            session()->flash('message', 'New user successfully added');
        }
        $this->emit('refreshParent');
    }
    
    public function render()
    {
        return view('livewire.user-management.user-management-admin-form-wire');
    }
}
