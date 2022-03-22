<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Date_;
use App\Models\KpiAll_;
use App\Models\KPIMaster_;
use App\Models\KPI_;
use App\Models\Kecekapan_;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class Kecekapan extends Component
{
    public $id_kecekapan;
    public $id_date;
    public $year;
    public $month;
    public $date_id;
    public $user_id;
    public $model_id;
    public $action;

    protected $listeners = [
        'delete',
    ];

    public function selectItem($id_kecekapan)
    {
        $this->id_kecekapan = $id_kecekapan;
    }

    public function delete()
    {
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;
        $kecekapan = Kecekapan_::find($this->id_kecekapan);
        $kecekapan->delete();
        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        return redirect()->back()->with('message', 'Kecekapan deleted successfully');
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

    public function kecekapan_save(Request $request, $date_id, $user_id, $year, $month){
        //CHECK HERE
        $kecekapans = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $total_percent = 0;
        foreach ($kecekapans as $key => $kecekapan) {
            $total_percent = $total_percent + $kecekapan->peratus;
        }
        if ($total_percent > 99.99999) {
            return redirect()->back()->with('fail', 'Sorry, you have exceed the maximum of Kecekepan Teras which is 100 percent only');
        }

        $validatedData = $request->validate([
            'kecekapan_teras' => ['required'],
            'skor_pekerja' => ['required'],
        ]);

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $kecekapanscount = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('kecekapan_teras', '=', $request->kecekapan_teras)->where('year', '=', $year)->where('month', '=', $month)->count();

        if ($kecekapanscount == 0) {
            Kecekapan_::insert([
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'weightage'=> '20',
            'kecekapan_teras'=> $request->kecekapan_teras,
            'skor_pekerja'=> $request->skor_pekerja,
            'peratus'=> '20',
            'ukuran'=> 'Percentage (%)',
            'year'=> $year,
            'month'=> $month,
            ]);
        } else {
            return redirect()->back()->with('fail', 'Sorry, This type of Kecekapan Teras already exist');
        }

        return redirect()->back()->with('message', 'Kecekapan Teras has been successfully inserted');
    } 
       

    public function kecekapan_edit($id, $date_id, $user_id, $year, $month) {
        $kecekapan = Kecekapan_::find($id);
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        return view('livewire.kecekapan.edit' , compact('kecekapan', 'date_id', 'user_id', 'year', 'month', 'status'));
    }

    public function kecekapan_update(Request $request, $id, $date_id, $user_id, $year, $month) {
        if(Auth::user()->role == 'employee') {
            $validatedData = $request->validate([
                'kecekapan_teras' => ['required'],
                'skor_pekerja' => ['required'],
            ]);
        }

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $update = Kecekapan_::find($id)->update([
            'updated_at'=> Carbon::now(),
            'skor_pekerja'=> $request->skor_pekerja,
        ]);

        return redirect('employee/kecekapan/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month)->with('message', 'Kecekapan Updated Successfully');
    }

    public function render()
    {
        // if (Auth::user()->role == "manager" || Auth::user()->role == "hr") {
        //     $date_id = $this->date_id;
        //     $user_id = $this->user_id;
        //     $year = $this->year;
        //     $month = $this->month;
        //     $kecekapan = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('kecekapan_teras')->get();
        //     $userdepartment = auth()->user()->department;
        //     $users = User::where([['department', '=', $userdepartment] , ['role', '=', 'employee']])->orderBy('created_at','desc')->get();
        //     $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
            
        //     return view('livewire.kecekapan-manager.all', compact('kecekapan', 'users', 'date_id', 'user_id', 'year', 'month', 'status'));
        // }
        // else {
            $date_id = $this->date_id;
            $user_id = $this->user_id;
            $year = $this->year;
            $month = $this->month;
            $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
            $kecekapan = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('kecekapan_teras')->get();

            return view('livewire.kecekapan.all', compact('kecekapan', 'date_id', 'user_id', 'year', 'month', 'status'));
        // }
    }
}