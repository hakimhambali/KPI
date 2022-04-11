<?php

namespace App\Http\Livewire\UserManagement;
use App\Models\User;
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
        $employee = User::where('role', 'employee')->get();
        $manager = User::where('role', 'manager')->get();
        $hr = User::where('role', 'hr')->get();
        $moderator = User::where('role', 'moderator')->get();
        $dc = User::where('role', 'dc')->get();
        $pro = User::where('role', 'pro')->get();
        $alluser = User::all();
        $allusercount = $alluser->count();

        return view('livewire.user-management.user-management')->with(compact('employee', 'manager', 'hr', 'moderator','alluser', 'allusercount', 'dc', 'pro'));
    }
}
