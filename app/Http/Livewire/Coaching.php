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
        $trainId = User::where('name',$request->trainer)->first();
        if($trainId == null ) {
            return redirect()->back()->with('fail', 'Team not exists.');
        }

        $title = Coaching_::where('title', $request->title)->where('trainer_id', $trainId->id)->whereDate('date', date($request->date))->first();
        if($title == null) {     
            $newCoaching = Coaching_::create([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'title'=> $request->title,
                'trainer_id'=> $trainId->id,
                'date'=> $request->date,
                'hours'=> $request->hours,
                ]);

            return redirect()->back()->with('message', 'Coaching inserted successfully for '.$trainId->name);
        } else {
            return redirect()->back()->with('fail', 'Coaching already exists for this trainer.');
        }
    }

    public function edit($id)
    {
        $coaching = Coaching_::where('id', $id)->get();
        $user = User::all();
        $names = [];
        foreach($user as $numering => $num) {
            $names[] = ucwords(strtolower($num->name));
        }

        return view('livewire.coaching.edit', compact('id', 'coaching', 'user', 'names'));
    }

    public function update(Request $request, $id) 
    {
        $trainId = User::where('name',$request->trainer)->first();
        if($trainId == null ) {
            return redirect()->back()->with('fail', 'Team not exists.');
        }
        
        $title = Coaching_::where('title', $request->title)->where('trainer_id', $trainId->id)->whereDate('date', date($request->date))->first();
        if($title == null) {            
            Coaching_::find($id)->update([
                'user_id'=> auth()->user()->id,
                'updated_at'=> Carbon::now(),
                'title'=> $request->title,
                'trainer_id'=> $trainId->id,
                'date'=> $request->date,
                'hours'=> $request->hours,
                ]);

            return redirect('/hr-manager/view/training-coaching/'.$trainId->id)->with('message', 'Coaching updated successfully');
        } else {
            return redirect()->back()->with('fail', 'Coaching already exists for this trainer.');
        }
    }

    public function render()
    {
        $user = User::all();
        $names = [];
        foreach($user as $numering => $num) {
            $names[] = ucwords(strtolower($num->name));
        }

        return view('livewire.coaching.create', compact('user', 'names'));
    }
}
