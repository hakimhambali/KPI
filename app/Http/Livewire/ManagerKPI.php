<?php

namespace App\Http\Livewire;

use App\Models\KPI_;
use App\Models\User;
use App\Models\Date_;
use App\Models\Nilai_;
use App\Models\KPIAll_;
use Livewire\Component;
use App\Models\Function_;
use App\Models\Kecekapan_;
use App\Models\KPIMaster_;
use Illuminate\Http\Request;

class ManagerKPI extends Component
{
    public $id_date;
    public $year;
    public $month;
    public $model_id;
    public $action;

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

    protected $listeners = [
        'delete',
    ];
    
    public function selectItem($model_id, $action)
    {
        $this->id_date = $model_id;
        $this->action = $action;
    }

    public function delete()
    {
        if (auth()->user()->role == "manager") {
            Date_::find($this->id_date)->update([
            'message_manager'=> '',
            'manager_id'=> '',
            ]);
        } else if(auth()->user()->role == "hr"){
            Date_::find($this->id_date)->update([
            'message_hr'=> '',
            'hr_id'=> '',
            ]);
        }

        return redirect()->back()->with('message', 'Your message to this employee has been deleted!');
    }
    
    public function changeupmanager($date_id)
    {
        Date_::find($date_id)->update([
        'status'=> 'Signed By Manager',
        ]);

        return redirect()->back()->with('message', 'The kpi has been signed & appraised!');
    }

    public function changedownmanager($date_id)
    {
        Date_::find($date_id)->update([
        'status'=> 'Submitted',
        ]);

        return redirect()->back()->with('message', 'You have undo the signed & undo the appraised kpi!');
    }

    public function messageupmanager(Request $request, $date_id)
    {
        Date_::find($date_id)->update([
        'message_manager'=> $request->message_manager,
        'manager_id'=> auth()->user()->id,
        ]);

        return redirect()->back()->with('message', 'Your message has been submitted!');
    }

    public function changeuphr($date_id)
    {
        Date_::find($date_id)->update([
        'status'=> 'Completed',
        ]);

        return redirect()->back()->with('message', 'The kpi has been signed & completed!');
    }

    public function changedownhr($date_id)
    {
        Date_::find($date_id)->update([
        'status'=> 'Signed By Manager',
        ]);
        
        return redirect()->back()->with('message', 'You have undo the signed & undo the completed kpi!');
    }

    public function messageuphr(Request $request, $date_id)
    {
        Date_::find($date_id)->update([
        'message_hr'=> $request->message_hr,
        'hr_id'=> auth()->user()->id,
        ]);

        return redirect()->back()->with('message', 'Your message has been submitted!');
    }

    public function render()
    {
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;

        $function = Function_::where('status' , 'active')->get();

        $kpiArr[] = array();
        foreach ($function as $key => $functions) {
            $kpi = KPI_::where('fungsi', '=', $functions->name)->Where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
            array_push($kpiArr, $kpi);
        }

        $kpiMasterArr[] = array();
        foreach ($function as $key => $functions) {
            $kpimaster = KPIMaster_::where('fungsi', '=', $functions->name)->Where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
            array_push($kpiMasterArr, $kpimaster);
        }

        $date = Date_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->get();
        $user = User::where('id', $user_id)->get();
        $kpi = KPI_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->orderBy('created_at','desc')->get();
        
        // All Data
        $kpiall = KPIAll_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->get();
        $weightage_master = KPIAll_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->value('weightage_master');

        // KPI Data
        $kpimaster = KPIMaster_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->orderBy('created_at','desc')->get();
        $countKPI = KPIMaster_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->count();
        $totalPercent = KPIMaster_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->sum('skor_KPI');
        $totalSebenar = KPIMaster_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
       
        // KECEKAPAN Data
        $kecekapan = Kecekapan_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->orderBy('created_at','desc')->get();
        $kecekapanscount2 = Kecekapan_::where('user_id', $user_id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $kecSebenar = Kecekapan_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
        $kecekapan_master = $kecekapanscount2 * 20;

        // Nilai Data
        $nilai = Nilai_::where('user_id', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $nilaiscount2 = Nilai_::where('user_id', $user_id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $nilaiSebenar = Nilai_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
        $nilai_master = $nilaiscount2 * 20;

        return view('livewire.display-kpi.all-manager-hr',
        compact('date_id', 'user_id', 'year', 'month', 'function', 'kpiArr', 'kpiMasterArr', 'date', 'user', 'kpi', 'kpiall', 'weightage_master',
                'kpimaster', 'countKPI', 'totalPercent', 'totalSebenar', 'kecekapan', 'kecekapanscount2', 'kecSebenar', 'kecekapan_master',
                'nilai', 'nilaiscount2', 'nilaiSebenar', 'nilai_master'));
    }
}
