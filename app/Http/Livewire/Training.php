<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
use App\Models\Coaching_;
use App\Models\Training_;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Training extends Component
{

    public function delete1($id)
    {
        $coaching = Coaching_::find($id);
        $coaching->delete();

        return redirect()->back()->with('message', 'Coaching deleted successfully');
    }

    public function delete2($id)
    {
        $training = Training_::find($id);
        $training->delete();

        return redirect()->back()->with('message', 'Training deleted successfully');
    }

    public function create(Request $request)
    {
        
        $studId = User::where('name',$request->student)->first();
        if($studId == null ) {
            return redirect()->back()->with('fail', 'Team not exists.');
        }

        $title = Training_::where('title', $request->title)->where('student_id', $studId->id)->whereDate('date', date($request->date))->first();

        if($title == null) {
            $trainId = User::where('name',$request->trainer)->first();
            if($trainId == null) {
                $training = $request->trainer;
            } else {
                $training = $trainId->id;
            }
            
            $newTraining = Training_::create([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'title'=> $request->title,
                'trainer_id'=> $training,
                'date'=> $request->date,
                'hours'=> $request->hours,
                'student_id'=> $studId->id,
                ]);

            return redirect()->back()->with('message', 'Training inserted successfully for '.$studId->name);
        } else {
            return redirect()->back()->with('fail', 'Training already exists for this student.');
        }
    }

    public function edit($id)
    {
        $user = User::all();
        $training = Training_::where('id', $id)->get();
        foreach($user as $numering => $num) {
            $names[] = ucwords(strtolower($num->name));
        }

        return view('livewire.training.edit', compact('id', 'training', 'user', 'names'));
    }

    public function update(Request $request, $id) 
    {
        $studId = User::where('name',$request->student)->first();
        if($studId == null ) {
            return redirect()->back()->with('fail', 'Team not exists.');
        }
        
        $title = Training_::where('title', $request->title)->where('student_id', $studId->id)->whereDate('date', date($request->date))->first();

        if($title == null) {
            $trainId = User::where('name',$request->trainer)->first();
            if($trainId == null) {
                $training = $request->trainer;
            } else {
                $training = $trainId->id;
            }
            
            Training_::find($id)->update([
                'user_id'=> auth()->user()->id,
                'updated_at'=> Carbon::now(),
                'title'=> $request->title,
                'trainer_id'=> $training,
                'date'=> $request->date,
                'hours'=> $request->hours,
                'student_id'=> $studId->id
                ]);

            return redirect('/hr-manager/view/training-coaching/'.$studId->id)->with('message', 'Training updated successfully');
        } else {
            return redirect()->back()->with('fail', 'Training already exists for this student.');
        }
    }

    public function manager_view($user_id) 
    {
        $training = Training_::where('student_id', $user_id)->orderBy('updated_at', 'DESC')->get();
        $coaching = Coaching_::where('trainer_id', $user_id)->orderBy('updated_at', 'DESC')->get();
        $user = User::where('id', $user_id)->get();
        // $user = User::find($student_id);
        // $name = $user->name;
        // $searchName = User::where('name' , 'like' , '%'.$name.'%')->orderBy('created_at','desc')->get();
        return view('livewire.training.all-manager', compact('training', 'coaching', 'user', 'user_id'));
    }

    public function employee_view() 
    {
        $training = Training_::where('student_id', auth()->user()->id)->get();
        $coaching = Coaching_::where('trainer_id', auth()->user()->id)->get();
        $user = User::where('id', auth()->user()->id)->get();
        return view('livewire.training.all-employee', compact('training', 'coaching', 'user'));
    }

    public function employee_month_save(Request $request, $user_id) 
    {
        User::find($user_id)->update([
            'starting_month'=> $request->month,
            ]);

        return redirect()->back()->with('messagemonth', 'User training updated successfully');
    }

    public function render()
    {
        $user = User::all();
        $names = [];
        foreach($user as $numering => $num) {
            $names[] = ucwords(strtolower($num->name));
        }

        return view('livewire.training.create', compact('user', 'names'));
    }
}
