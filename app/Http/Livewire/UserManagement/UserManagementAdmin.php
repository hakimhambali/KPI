<?php

namespace App\Http\Livewire\UserManagement;
use App\Models\User;
use Livewire\Component;

class UserManagementAdmin extends Component
{
    public $id_user;
    public $action;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'delete'
    ];

    public function selectItem($id_user , $action)
    {
        $this->id_user = $id_user;
        $this->action = $action;
        if($action == "update")
        {
            $this->emit('getModelId' , $this->id_user);
        }
    }

    public function delete()
    {
        $user = User::find($this->id_user);
        $user->delete();
    }

    public function render()
    {
        $users = User::where('role', 'admin')->orWhere('role', 'manager')->orWhere('role', 'hr')->orWhere('role', 'moderator')->orderBy('role', 'ASC')->get();
        $employees = User::where('role', 'employee')->orderBy('name', 'ASC')->get();
        $userscount = $users->count();

        return view('livewire.user-management.user-management-admin')->with(compact('userscount', 'users', 'employees'));
    }
}
