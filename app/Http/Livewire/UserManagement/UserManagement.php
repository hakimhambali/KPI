<?php

namespace App\Http\Livewire\UserManagement;
use App\Models\User;
use App\Models\Role_;
use Livewire\Component;

class UserManagement extends Component
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
        $role = Role_::where('status' , 'active')->get();

        $roleArr[] = array();
        foreach ($role as $key => $roles) {
            $user = User::where('role', $roles->name)->orderBy('name', 'ASC')->get();
            array_push($roleArr, $user);
        }

        return view('livewire.user-management.user-management')->with(compact('role', 'roleArr'));
    }
}
