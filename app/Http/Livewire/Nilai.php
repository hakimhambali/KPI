<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KPI_;
use App\Models\Nilai_;
use App\Models\User;
use App\Models\Date_;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class Nilai extends Component
{
    public $id_nilai;
    public $action;

    protected $listeners = [
        'delete'
    ];

    public function selectItem($id_nilai)
    {
        $this->id_nilai = $id_nilai;
    }

    public function delete()
    {
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;
        $nilai = Nilai_::find($this->id_nilai);
        $nilai->delete();
        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);
        return redirect()->back()->with('message', 'Nilai deleted successfully');
    }

    public function mount($date_id, $user_id, $year, $month)
    {
        if(auth()->user()) {
            $this->date_id = $date_id;
            $this->user_id = $user_id;
            $this->year = $year;
            $this->month = $month;
        } else {
            return redirect()->to('/');
        }
    }

    public function nilai_save(Request $request, $date_id, $user_id, $year, $month){
        //CHECK HERE
        $nilais = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $total_percent = 0;
        foreach ($nilais as $key => $nilai) {
            $total_percent = $total_percent + $nilai->peratus;
        }
        if ($total_percent > 119.99999) {
            return redirect()->back()->with('fail', 'Sorry, you have exceed the maximum of Nilai Teras which is 100 percent only');
        }
        $validatedData = $request->validate([
            'nilai_teras' => ['required'],
            'skor_pekerja' => ['required'],
        ]);

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $nilaiscount = Nilai_::where('user_id', '=', auth()->user()->id)->where('nilai_teras', '=', $request->nilai_teras)->where('year', '=', $year)->where('month', '=', $month)->count();
        if ($nilaiscount == 0) {
            Nilai_::insert([
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'weightage'=> '20',
            'nilai_teras'=> $request->nilai_teras,
            'skor_pekerja'=> $request->skor_pekerja,
            'peratus'=> '20',
            'ukuran'=> 'Percentage (%)',
            'year'=> $year,
            'month'=> $month,
            ]);
        } else {
            return redirect()->back()->with('fail', 'Sorry, This type of Nilai Teras already exist');
        }

        return redirect()->back()->with('message', 'Nilai Teras has been successfully inserted');
    } 
    
    public function nilai_edit($id, $date_id, $user_id, $year, $month) {
        $nilai = Nilai_::find($id);
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        return view('livewire.nilai.edit' , compact('nilai', 'date_id', 'user_id', 'year', 'month', 'status'));
    }

    public function nilai_update(Request $request, $id, $date_id, $user_id, $year, $month) {
        if(Auth::user()->role == 'employee') {
            $validatedData = $request->validate([
                'nilai_teras' => ['required'],
                'skor_pekerja' => ['required'],
            ]);
        }

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $update = Nilai_::find($id)->update([
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'weightage'=> '20',
            'nilai_teras'=> $request->nilai_teras,
            'skor_pekerja'=> $request->skor_pekerja,
            'skor_penyelia'=> $request->skor_penyelia,
        ]);

        return redirect('employee/nilai/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month)->with('message', 'Nilai Updated Successfully');
    }

    public function render()
    {
        // if (Auth::user()->role == "manager" || Auth::user()->role == "hr") {
        //     $date_id = $this->date_id;
        //     $user_id = $this->user_id;
        //     $year = $this->year;
        //     $month = $this->month;
        //     $nilai = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('nilai_teras')->get();
        //     $userdepartment = auth()->user()->department;
        //     $users = User::where([['department', '=', $userdepartment] , ['role', '=', 'employee']])->orderBy('created_at','desc')->get();
        //     $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        //     return view('livewire.nilai-manager.all', compact('nilai', 'users', 'date_id', 'user_id', 'year', 'month', 'status'));
        // }

        // else {
            $date_id = $this->date_id;
            $user_id = $this->user_id;
            $year = $this->year;
            $month = $this->month;
            $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
            $nilai = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('nilai_teras')->get();
            return view('livewire.nilai.all', compact('nilai', 'date_id', 'user_id', 'year', 'month', 'status'));
        // }
    }
}