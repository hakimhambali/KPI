<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Complaint_;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;

class Complaint extends Component
{
    use WithFileUploads;
    public $complaint_path;
    public $id_complaint;

    protected $listeners = [
        'delete'
    ];

    public function selectItem($id)
    {
        $this->id_complaint = $id;
    }

    public function delete()
    {
        $complaint = Complaint_::find($this->id_complaint);
        $complaint->delete();

        return redirect()->back()->with('message', 'Complaint deleted successfully');
    }

    public function create(Request $request)
    {
        if ($request->all()['office'] != NULL) 
        {
            $input['office'] = json_encode($request->all()['office']);
            $input['category'] = json_encode($request->all()['category']);

            Complaint_::insert([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'location'=> $request->location,
                'level'=> $request->level,
                'office'=> $input['office'],
                'category'=> $input['category'],
                'description'=> $request->description,
                ]);
        } else {
            $input['category'] = json_encode($request->all()['category']);

            Complaint_::insert([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'location'=> $request->location,
                'level'=> $request->level,
                'category'=> $input['category'],
                'description'=> $request->description,
                ]);
        } 

        return redirect()->back()->with('message', 'Complaint has been successfully inserted');
    }

    public function edit($id)
    {
        $complaint = Complaint_::where('id', '=', $id)->get();
        $office = Complaint_::where('id', $id)->pluck('office')->first();
        $category = Complaint_::where('id', $id)->pluck('category')->first();
        return view('livewire.complaint.edit', compact('id', 'complaint', 'office', 'category'));
    }

    public function update(Request $request, $id) 
    {
        if ($request->all()['office'] != NULL) 
        {
            $input['office'] = json_encode($request->all()['office']);
            $input['category'] = json_encode($request->all()['category']);

            Complaint_::find($id)->update([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'location'=> $request->location,
                'level'=> $request->level,
                'office'=> $input['office'],
                'category'=> $input['category'],
                'description'=> $request->description,
                ]);
        } else {
            $input['category'] = json_encode($request->all()['category']);

            Complaint_::insert([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'location'=> $request->location,
                'level'=> $request->level,
                'category'=> $input['category'],
                'description'=> $request->description,
                ]);
        } 

        return redirect('/complaint')->with('message', 'Complaint Updated Successfully');
    }

    public function render()
    {
        $complaint = Complaint_::all();
        return view('livewire.complaint.all', compact('complaint'));
    }
}
