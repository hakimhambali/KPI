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
        $kadskor = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kad Skor Korporat')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan1 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan2 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan2')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan3 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan3')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan4 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan4')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan5 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan5')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan6 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan6')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan7 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan7')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan8 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan8')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan9 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan9')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan10 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kewangan10')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $pelangganI = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Pelanggan (Internal)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $pelangganII = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Pelanggan (External)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan1 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kecemerlangan Operasi1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan2 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kecemerlangan Operasi2')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan3 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kecemerlangan Operasi3')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan4 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kecemerlangan Operasi4')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan5 = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kecemerlangan Operasi5')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $training = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Manusia & Proses (Training)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $ncr = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Manusia & Proses (NCROFI)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kolaborasi = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', 'Kolaborasi')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();

        $kadskorcount = $kadskor->count();
        $kewangan1count = $kewangan1->count();
        $kewangan2count = $kewangan2->count();
        $kewangan3count = $kewangan3->count();
        $kewangan4count = $kewangan4->count();
        $kewangan5count = $kewangan5->count();
        $kewangan6count = $kewangan6->count();
        $kewangan7count = $kewangan7->count();
        $kewangan8count = $kewangan8->count();
        $kewangan9count = $kewangan9->count();
        $kewangan10count = $kewangan10->count();
        $pelangganIcount = $pelangganI->count();
        $pelangganIIcount = $pelangganII->count();
        $kecemerlangan1count = $kecemerlangan1->count();
        $kecemerlangan2count = $kecemerlangan2->count();
        $kecemerlangan3count = $kecemerlangan3->count();
        $kecemerlangan4count = $kecemerlangan4->count();
        $kecemerlangan5count = $kecemerlangan5->count();
        $trainingcount = $training->count();
        $ncrcount = $ncr->count();
        $kolaborasicount = $kolaborasi->count();

        $users = User::whereIn('position', ['Junior Non-Executive (NE1)','Senior Non-Executive (NE2)'])->Where('role' , 'employee')->get();
        $hrs = User::Where('department' , 'Human Resource (HR) & Administration')->orWhere('role' , 'admin')->get();
        $user = User::where('id', '=', auth()->user()->id)->get();
        $kecekapan = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $nilai = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kpiall = KPIAll_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $weightage_master = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('weightage_master');
        $kecekapanscount2 = Kecekapan_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $nilaiscount2 = Nilai_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $kecekapan_master = $kecekapanscount2 * 20;
        $nilai_master = $nilaiscount2 * 20;
        $date = Date_::where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();

        return view('livewire.display-kpi.all-employee', compact('users', 'hrs', 'kecekapan', 'nilai', 'user', 'kadskor', 'kewangan1', 'kewangan2', 'kewangan3', 'kewangan4', 'kewangan5', 'kewangan6', 'kewangan7', 'kewangan8', 'kewangan9', 'kewangan10',
        'pelangganI', 'pelangganII', 'kecemerlangan1', 'kecemerlangan2', 'kecemerlangan3', 'kecemerlangan4', 'kecemerlangan5', 'training', 'ncr', 'kolaborasi', 'kadskorcount', 'kewangan1count', 'kewangan2count', 'kewangan3count', 'kewangan4count', 'kewangan5count', 'kewangan6count', 'kewangan7count', 'kewangan8count', 'kewangan9count', 'kewangan10count', 'pelangganIcount', 
        'pelangganIIcount', 'kecemerlangan1count', 'kecemerlangan2count', 'kecemerlangan3count', 'kecemerlangan4count', 'kecemerlangan5count', 'trainingcount', 'ncrcount', 'kolaborasicount', 'kpiall', 'weightage_master', 'date', 'kecekapan_master', 'nilai_master'));
    }
    
        public function render()
    {
        return view('livewire.display-kpi..all-employee');
    }
}