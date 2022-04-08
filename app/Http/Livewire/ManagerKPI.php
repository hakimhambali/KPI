<?php

namespace App\Http\Livewire;

use App\Models\KPI_;
use App\Models\KPIAll_;
use App\Models\Kecekapan_;
use App\Models\KPIMaster_;
use App\Models\Nilai_;
use App\Models\User;
use App\Models\Date_;
use Illuminate\Http\Request;
use Livewire\Component;

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

        $kadskor = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kad Skor Korporat1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan1 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan2 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan2')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan3 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan3')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan4 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan4')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan5 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan5')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan6 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan6')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan7 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan7')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan8 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan8')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan9 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan9')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kewangan10 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kewangan10')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $pelangganIn1 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Pelanggan1 (Internal)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $pelangganEx1 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Pelanggan1 (External)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $pelangganEx2 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Pelanggan2 (External)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan1 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kecemerlangan Operasi1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan2 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kecemerlangan Operasi2')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan3 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kecemerlangan Operasi3')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan4 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kecemerlangan Operasi4')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kecemerlangan5 = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kecemerlangan Operasi5')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $training = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Manusia & Proses1 (Training)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $ncr = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Manusia & Proses1 (NCROFI)')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();
        $kolaborasi = KPI_::where('user_id', '=', $user_id)->where('fungsi', '=', 'Kolaborasi1')->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->get();

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
        $pelangganIn1count = $pelangganIn1->count();
        $pelangganEx1count = $pelangganEx1->count();
        $pelangganEx2count = $pelangganEx2->count();
        $kecemerlangan1count = $kecemerlangan1->count();
        $kecemerlangan2count = $kecemerlangan2->count();
        $kecemerlangan3count = $kecemerlangan3->count();
        $kecemerlangan4count = $kecemerlangan4->count();
        $kecemerlangan5count = $kecemerlangan5->count();
        $trainingcount = $training->count();
        $ncrcount = $ncr->count();
        $kolaborasicount = $kolaborasi->count();

        $kpi = KPI_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kpimaster = KPIMaster_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $user = User::where('id', '=', $user_id)->get();
        $kecekapan = Kecekapan_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $nilai = Nilai_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kpiall = KPIAll_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $date = Date_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $weightage_master = KPIAll_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->value('weightage_master');
        $kecekapanscount2 = Kecekapan_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $nilaiscount2 = Nilai_::where('user_id', '=', $user_id)->where('year', '=', $year)->where('month', '=', $month)->count();
        $kecekapan_master = $kecekapanscount2 * 20;
        $nilai_master = $nilaiscount2 * 20;

        return view('livewire.display-kpi.all-manager-hr', compact('kpi', 'kpimaster', 'user', 'kecekapan' , 'nilai', 'kpiall', 'kadskor', 'kewangan1', 'kewangan2', 'kewangan3', 'kewangan4', 'kewangan5', 'kewangan6', 'kewangan7', 'kewangan8', 'kewangan9', 'kewangan10',
        'pelangganIn1', 'pelangganEx1', 'pelangganEx2', 'kecemerlangan1', 'kecemerlangan2', 'kecemerlangan3', 'kecemerlangan4', 'kecemerlangan5', 'training', 'ncr', 'kolaborasi', 'date_id', 'user_id', 'year', 'month', 'date', 
        'weightage_master', 'kadskorcount', 'kewangan1count', 'kewangan2count', 'kewangan3count', 'kewangan4count', 'kewangan5count', 'kewangan6count', 'kewangan7count', 'kewangan8count', 'kewangan9count', 'kewangan10count', 'pelangganIn1count', 'pelangganEx1count', 'pelangganEx2count' , 'kecemerlangan1count', 'kecemerlangan2count', 'kecemerlangan3count', 'kecemerlangan4count', 'kecemerlangan5count', 'trainingcount',
        'ncrcount', 'kolaborasicount', 'kecekapan_master', 'nilai_master'));
    }
}
