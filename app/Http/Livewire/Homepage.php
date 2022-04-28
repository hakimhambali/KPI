<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Memo_;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Announcement_;
use Illuminate\Support\Facades\Http;
use Response;
use GuzzleHttp\Client;
use Carbon\Carbon;

class Homepage extends Component
{
    public $id_announcement;
    public $model_id;
    public $action;

    protected $listeners = [
        'delete',
    ];
    
    public function selectItem($model_id, $action)
    {
        $this->id_announcement = $model_id;
        $this->action = $action;
    }

    public function delete()
    {
        Announcement_::find($this->id_announcement)->update([
        'announcement'=> '',
        'user_id'=> '',
        'created_at'=> NULL,
        ]);
        return redirect()->back()->with('message', 'Your message to this employee has been deleted!');
    }

    public function announcementuphr(Request $request, $id_announcement)
    {
        Announcement_::find($id_announcement)->update([
        'announcement'=> $request->announcement,
        'user_id'=> auth()->user()->id,
        'created_at'=> Carbon::now('Asia/Kuala_Lumpur'),
        ]);
        return redirect()->back()->with('message', 'Your message has been submitted!');
    }

    public function render()
    {        
        $data = Http::get("http://miapp.admin.x61tbrxchx-ewx3lmoq56zq.p.runcloud.link/api/programs/latest");
        $test= json_decode($data);

        $announcement = Announcement_::all();
        $memo = Memo_::orderBy('created_at','desc')->take(4)->get();
        $users = User::orderBy('created_at','desc')->get();
        $userscount = $users->count();
        return view('livewire.homepage')->with(compact('test', 'users', 'userscount', 'memo', 'announcement'));
    }
}
