<?php

namespace App\Http\Livewire;

use App\Models\KPI_;
use App\Models\KPIAll_;
use App\Models\KPIMaster_;
use App\Models\Kecekapan_;
use App\Models\Nilai_;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use App\Models\Function_;
use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Date_;

class Displaykpi extends Component
{
    public function changeup($date_id)
    {
        Date_::find($date_id)->update([
            'status'=> 'Submitted',
        ]);

        return redirect()->back()->with('message', 'The kpi has been signed & submitted!');
    }

    public function changedown($date_id)
    {
        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        return redirect()->back()->with('message', 'You have undo the signed & submitted kpi!');
    }

    public function view_all($id, $user_id, $year, $month) 
    {
        $function = Function_::where('status' , 'active')->get();

        $kpiArr[] = array();
        foreach ($function as $key => $functions) {
            $kpi = KPI_::where('fungsi', $functions->name)->Where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
            array_push($kpiArr, $kpi);
        }

        $kpiMasterArr[] = array();
        foreach ($function as $key => $functions) {
            $kpimaster = KPIMaster_::where('fungsi', $functions->name)->Where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->orderBy('created_at','desc')->get();
            array_push($kpiMasterArr, $kpimaster);
        }

        $users = User::whereIn('position', ['Junior Non-Executive (NE1)','Senior Non-Executive (NE2)'])->Where('role' , 'employee')->get();
        $hrs = User::Where('department' , 'Human Resource (HR) & Administration')->orWhere('role' , 'admin')->get();
        $date = Date_::where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->get();

        // All Data
        $kpiall = KPIAll_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $weightage_master = KPIAll_::where('user_id', Auth::user()->id)->where('year', $year)->where('month', $month)->value('weightage_master');

        // KPI Data
        $countKPI = KPIMaster_::where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->count();
        $totalPercent = KPIMaster_::where('user_id', Auth::user()->id)->where('year', $year)->where('month', $month)->sum('skor_KPI');
        $totalSebenar = KPIMaster_::where('user_id', Auth::user()->id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
       
        // KECEKAPAN Data
        $kecekapan = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecekapanscount2 = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $kecSebenar = Kecekapan_::where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
        $kecekapan_master = $kecekapanscount2 * 20;

        // Nilai Data
        $nilai = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $nilaiscount2 = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $nilaiSebenar = Nilai_::where('user_id', auth()->user()->id)->where('year', $year)->where('month', $month)->sum('skor_sebenar');
        $nilai_master = $nilaiscount2 * 20;

        return view('livewire.display-kpi.all-employee',
        compact( 'id', 'year', 'month', 'function', 'kpiArr', 'kpi', 'kpiMasterArr', 'kpimaster', 'users', 'hrs', 'date',
        'kpiall', 'weightage_master', 'countKPI', 'totalPercent', 'totalSebenar', 'kecekapan', 'kecekapanscount2', 'kecSebenar',
        'kecekapan_master', 'nilai', 'nilaiscount2', 'nilaiSebenar', 'nilai_master' ));
    }
    
        public function render()
    {
        return view('livewire.display-kpi.all-employee');
    }
}