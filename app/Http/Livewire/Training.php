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
    public $id_training;
    public $id_coaching;
    public $model1;
    public $model2;
    // public $name;

    protected $listeners = [
        'delete1',
        'delete2',
        // 'refreshParent' => '$refresh',
        // 'postSearch',
    ];

    // public function postSearch($name)
    // {
    //     $this->name = $name;
    //     $this->emit('refreshParent');
    // }

    public function selectItem1($model1)
    {
        $this->id_training = $model1;
    }

    public function selectItem2($model2)
    {
        $this->id_coaching = $model2;
    }

    public function delete1()
    {
        $coaching = Coaching_::find($this->id_coaching);
        $coaching->delete();

        return redirect()->back()->with('message', 'Coaching deleted successfully');
    }

    public function delete2()
    {
        $training = Training_::find($this->id_training);
        $training->delete();

        return redirect()->back()->with('message', 'Training deleted successfully');
    }

    public function create(Request $request)
    {
        $newTraining = Training_::create([
            'user_id'=> auth()->user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'trainer_id'=> $request->trainer_id,
            'date'=> $request->date,
            'hours'=> $request->hours,
            'student_id'=> $request->student_id,
            ]);

        $user = User::find($request->student_id);
        $name = $user->name;

        return redirect()->back()->with('message', 'Training inserted successfully for '.$name);
    }

    public function edit($id)
    {
        $user = User::all();
        $training = Training_::where('id', $id)->get();
        return view('livewire.training.edit', compact('id', 'training', 'user'));
    }

    public function update(Request $request, $id) 
    {
        Training_::find($id)->update([
            'user_id'=> auth()->user()->id,
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'trainer_id'=> $request->trainer_id,
            'date'=> $request->date,
            'hours'=> $request->hours,
            'student_id'=> $request->student_id
            ]);

        return redirect('/training')->with('message', 'Training updated successfully');
    }

    public function view($student_id) 
    {
        $training = Training_::where('student_id', $student_id)->get();
        $coaching = Coaching_::where('trainer_id', $student_id)->get();
        $user = User::where('id', $student_id)->get();
        // $user = User::find($student_id);
        // $name = $user->name;
        // $searchName = User::where('name' , 'like' , '%'.$name.'%')->orderBy('created_at','desc')->get();
        return view('livewire.training.all', compact('training', 'coaching', 'user'));
    }

    public function employee_view() 
    {
        $training = Training_::where('student_id', auth()->user()->id)->get();
        $coaching = Coaching_::where('trainer_id', auth()->user()->id)->get();
        $user = User::where('id', auth()->user()->id)->get();
        return view('livewire.training.all', compact('training', 'coaching', 'user'));
    }

    public function render()
    {
        // $searchName = User::where('name' , 'like' , '%'.$this->name.'%')->orderBy('created_at','desc')->get();

        $user = User::all();
        return view('livewire.training.create', compact('user'));
        // return view('livewire.training.create', compact('user', 'searchName'));
        // $student_id = '25';
        // $training = Training_::where('student_id', $student_id)->get();
        // $coaching = Coaching_::where('trainer_id', $student_id)->get();
        // return view('livewire.training.all', compact('training', 'coaching'));
    }
}
