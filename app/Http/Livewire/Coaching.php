<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
use App\Models\Coaching_;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Coaching extends Component
{
    // public $id_coaching;

    // protected $listeners = [
    //     'delete'
    // ];

    // public function selectItem($id_coaching)
    // {
    //     $this->id_coaching = $id_coaching;
    // }

    // public function delete()
    // {
        // $coaching = Coaching_::find($this->id_coaching);
        // $coaching->delete();        

    //     return redirect()->back()->with('message', 'Coaching deleted successfully');
    // }

    public function create(Request $request)
    {
        $newCoaching = Coaching_::create([
            'user_id'=> auth()->user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'trainer_id'=> $request->trainer_id,
            'date'=> $request->date,
            'hours'=> $request->hours,
            ]);
        
        $user = User::find($request->trainer_id);
        $name = $user->name;

        return redirect()->back()->with('message', 'Coaching inserted successfully for '.$name);
    }

    public function edit($id)
    {
        $coaching = Coaching_::where('id', $id)->get();
        $user = User::all();
        return view('livewire.coaching.edit', compact('id', 'coaching', 'user'));
    }

    public function update(Request $request, $id) 
    {
        Coaching_::find($id)->update([
            'user_id'=> auth()->user()->id,
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'trainer_id'=> $request->trainer_id,
            'date'=> $request->date,
            'hours'=> $request->hours,
            ]);

        return redirect('/coaching')->with('message', 'Coaching updated successfully');
    }

    public function render()
    {
        $user = User::all();
        return view('livewire.coaching.create', compact('user'));
    }
}
