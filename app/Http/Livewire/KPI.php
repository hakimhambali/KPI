<?php

namespace App\Http\Livewire;
use DB;
use Auth;
use App\Models\KPI_;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Livewire\Component;
use App\Models\KPIMaster_;
use App\Models\Kecekapan_;
use App\Models\Nilai_;
use App\Models\KPIAll_;
use App\Models\Function_;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\Date_;
use URL;

class KPI extends Component
{
    use WithFileUploads;
    public $id_kpi;
    public $action;
    public $name;
    public $model_id;
    public $bukti_path;

    protected $listeners = [
        'delete'
    ];

    public function selectItem($id_kpiall , $id_kpimaster , $id_kpi)
    {
        $this->id_kpi = $id_kpi;
        $this->id_kpimaster = $id_kpimaster;
        $this->id_kpiall = $id_kpiall;
    }

    public function delete()
    {
        // dd($this->id_kpi);
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;
        $kpi = KPI_::find($this->id_kpi);
        dd($kpi);
        $fungsi = KPI_::find($this->id_kpi)->value('fungsi');
        $kpi->delete();

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $count_KPI = KPI_::where('fungsi', '=', $fungsi)->where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->count();
        if ($count_KPI == 0) {
            $kpimaster = KPIMaster_::find($this->id_kpimaster);
            $kpimaster->delete();
            $weightage = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
            KPIAll_::find($this->id_kpiall)->update([
                'weightage_master'=> $weightage,
                'updated_at'=> Carbon::now(),
            ]);
        }

        return redirect()->back()->with('message', 'Kpi deleted successfully');
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

    public function kpi_master_edit1($id, $date_id, $user_id, $year, $month) {
        $kadskormastercount = KPIMaster_::where('fungsi', '=', 'Kad Skor Korporat1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Kad Skor Korporat1';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kadskormastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit2($id, $date_id, $user_id, $year, $month) {
        if(auth()->user()) {
            $this->date_id = $date_id;
            $this->user_id = $user_id;
            $this->year = $year;
            $this->month = $month;
            $this->id = $id;

            $kewangan1mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
            $fungsi = 'Kewangan1';
            $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
            if ($kewangan1mastercount == 1) {
                $kpimasters = KPIMaster_::find($id);
                return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
            }
        } else {
            return redirect()->to('/');
        }
    }
    
    public function kpi_master_edit13($id, $date_id, $user_id, $year, $month) {
        $kewangan2mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan2';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan2mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit14($id, $date_id, $user_id, $year, $month) {
        $kewangan3mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan3';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan3mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit15($id, $date_id, $user_id, $year, $month) {
        $kewangan4mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan4';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan4mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit16($id, $date_id, $user_id, $year, $month) {
        $kewangan5mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan5';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan5mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit17($id, $date_id, $user_id, $year, $month) {
        $kewangan6mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan6')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan6';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan6mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit18($id, $date_id, $user_id, $year, $month) {
        $kewangan7mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan7')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan7';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan7mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit19($id, $date_id, $user_id, $year, $month) {
        $kewangan8mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan8')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan8';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan8mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit20($id, $date_id, $user_id, $year, $month) {
        $kewangan9mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan9')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan9';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan9mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit21($id, $date_id, $user_id, $year, $month) {
        $kewangan10mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan10')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kewangan10';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kewangan10mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit3($id, $date_id, $user_id, $year, $month) {
        $pelangganIn1mastercount = KPIMaster_::where('fungsi', '=', 'Pelanggan1 (Internal)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Pelanggan1 (Internal)';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($pelangganIn1mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit4($id, $date_id, $user_id, $year, $month) {
        $pelangganEx1mastercount = KPIMaster_::where('fungsi', '=', 'Pelanggan1 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Pelanggan1 (External)';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($pelangganEx1mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit22($id, $date_id, $user_id, $year, $month) {
        $pelangganEx2mastercount = KPIMaster_::where('fungsi', '=', 'Pelanggan2 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Pelanggan2 (External)';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($pelangganEx2mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit5($id, $date_id, $user_id, $year, $month) {
        $kecemerlangan1mastercount = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kecemerlangan Operasi1';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kecemerlangan1mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }
    public function kpi_master_edit9($id, $date_id, $user_id, $year, $month) {
        $kecemerlangan2mastercount = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kecemerlangan Operasi2';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kecemerlangan2mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }
    public function kpi_master_edit10($id, $date_id, $user_id, $year, $month) {
        $kecemerlangan3mastercount = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kecemerlangan Operasi3';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kecemerlangan3mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }
    public function kpi_master_edit11($id, $date_id, $user_id, $year, $month) {
        $kecemerlangan4mastercount = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
        $fungsi = 'Kecemerlangan Operasi4';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kecemerlangan4mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }
    public function kpi_master_edit12($id, $date_id, $user_id, $year, $month) {
        $kecemerlangan5mastercount = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Kecemerlangan Operasi5';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($kecemerlangan5mastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit6($id, $date_id, $user_id, $year, $month) {
        $trainingmastercount = KPIMaster_::where('fungsi', '=', 'Manusia & Proses1 (Training)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Manusia & Proses1 (Training)';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($trainingmastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit7($id, $date_id, $user_id, $year, $month) {
        $ncrmastercount = KPIMaster_::where('fungsi', '=', 'Manusia & Proses1 (NCROFI)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Manusia & Proses1 (NCROFI)';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        if ($ncrmastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_edit8($id, $date_id, $user_id, $year, $month) {
        $kolaborasimastercount = KPIMaster_::where('fungsi', '=', 'Kolaborasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->count();
        $fungsi = 'Kolaborasi1';
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        // dd($fungsi);
        if ($kolaborasimastercount == 1) {
            $kpimasters = KPIMaster_::find($id);
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        }
    }

    public function kpi_master_update(Request $request, $id, $fungsi, $date_id, $user_id, $year, $month) {
        $validatedData = $request->validate([
            'percent_master' => ['required'],
            // 'link' => ['required'],
            'objektif' => ['required'],
            'updated_at'=> Carbon::now(),
        ]);

        $input['link'] = json_encode($request->all()['link']);

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $kpimasters = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
        $kpimasters_id = count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0';
        $total_score = KPI_::where('fungsi', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
        $skor_kpi = 0;
        $skor_sebenar = 0;
        if ($total_score < 30 ) {
            $skor_kpi = $total_score;
            $skor_sebenar = (($request->percent_master/100)*$skor_kpi);
        }
        elseif ($total_score >= 30 && $total_score < 65) {
            $value1 = $total_score - 30;
            $value2 = 65 - 30;

            $skor_kpi = ((($value1/$value2)*35)+30);
            $skor_sebenar = (($request->percent_master/100)*$skor_kpi);
        }
        elseif ($total_score >= 65 && $total_score < 100) {
            $value1 = $total_score - 65;
            $value2 = 100 - 65;

            $skor_kpi = ((($value1/$value2)*35)+65);
            $skor_sebenar = (($request->percent_master/100)*$skor_kpi);
        }
        elseif ($total_score >= 100) {
            $skor_kpi = 100;
            $skor_sebenar = (($request->percent_master/100)*$skor_kpi);
        }

        $update = KPIMaster_::find($id)->update([
            'objektif'=> $request->objektif,
            'link'=> $input['link'],
            'percent_master'=> $request->percent_master,
            'pencapaian'=> $total_score,
            'skor_KPI'=> $skor_kpi,
            'skor_sebenar'=> $skor_sebenar,
            'updated_at'=> Carbon::now(),
        ]);

        if (KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';

            $total_score_master = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');

            $grade = '';
            if ($total_score_master >= 80 ) {
                $grade = 'PLATINUM';
            }
            elseif ($total_score_master >= 75 && $total_score_master <= 79.99) {
                $grade = 'HIGH GOLD';
            }
            elseif ($total_score_master >= 70 && $total_score_master <= 74.99) {
                $grade = 'MID GOLD';
            }
            elseif ($total_score_master >= 65 && $total_score_master <= 69.99) {
                $grade = 'LOW GOLD';
            }
            elseif ($total_score_master >= 60 && $total_score_master <= 64.99) {
                $grade = 'HIGH SILVER';
            }
            elseif ($total_score_master >= 50 && $total_score_master <= 59.99) {
                $grade = 'LOW SILVER';
            }
            elseif ($total_score_master >= 1 && $total_score_master <= 49.99) {
                $grade = 'BRONZE';
            }
            else {
                $grade = 'NO GRED';
            }
            
            $weightage_master = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('percent_master');
            if ($weightage_master == NULL || $weightage_master == 0) {
                $weightage_past = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
                $weightage_present = $request->percent_master;
                $weightage = $weightage_past + $weightage_present;
            }
            else {
                $weightage_past = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
                $weightage_present = $request->percent_master;
                $weightage = $weightage_past + $weightage_present - $weightage_master;
            }
           
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_master*0.8);

            $grade_all = '';
            if ($total_score_all >= 80 ) {
                $grade_all = 'PLATINUM';
            }
            elseif ($total_score_all >= 75 && $total_score_all <= 79.99) {
                $grade_all = 'HIGH GOLD';
            }
            elseif ($total_score_all >= 70 && $total_score_all <= 74.99) {
                $grade_all = 'MID GOLD';
            }
            elseif ($total_score_all >= 65 && $total_score_all <= 69.99) {
                $grade_all = 'LOW GOLD';
            }
            elseif ($total_score_all >= 60 && $total_score_all <= 64.99) {
                $grade_all = 'HIGH SILVER';
            }
            elseif ($total_score_all >= 50 && $total_score_all <= 59.99) {
                $grade_all = 'LOW SILVER';
            }
            elseif ($total_score_all >= 1 && $total_score_all <= 49.99) {
                $grade_all = 'BRONZE';
            }
            else {
                $grade_all = 'NO GRED';
            }

            KPIAll_::find($kpiall_id)->update([
                'total_score_master'=>  $total_score_master,
                'grade_master'=>  $grade,
                'weightage_master'=>  $weightage,
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'updated_at'=> Carbon::now(),
            ]);
        }
        else {
            KPIAll_::insert([              
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now(),
            ]);
        }

        return redirect('employee/kpi/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month)->with('message', 'KPI Master Updated Successfully');
    }
    
    public function kpi_save(Request $request, $date_id, $user_id, $year, $month){
       
        $function = KPI_::where('user_id', '=', auth()->user()->id)->where('fungsi', '=', $request->fungsi)->where('year', '=', $year)->where('month', '=', $month)->get();

        $total_percent = 0;

        foreach ($function as $key => $functions) {
            $total_percent = $total_percent + $functions->peratus;
        }
        
        if (($total_percent + $request->peratus) > 100) {
            return redirect()->back()->with('fail', 'Sorry, you have exceed the maximum of KPI for '.$request->fungsi.' function which is 100 percent only');
        }

        $validatedData = $request->validate([
            'fungsi' => ['required'],
            'bukti' => ['required'],
            'peratus' => ['required'],
            'ukuran' => ['required'],
            'threshold' => ['required'],
            'base' => ['required'],
            'stretch' => ['required'],
            'pencapaian' => ['required'],
            'skor_KPI' => ['required'],
            'skor_sebenar' => ['required'],
        ]);

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        if (KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';
            $total_score_master = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $grade = '';
            if ($total_score_master >= 80 ) {
                $grade = 'PLATINUM';
            }
            elseif ($total_score_master >= 75 && $total_score_master <= 79.99) {
                $grade = 'HIGH GOLD';
            }
            elseif ($total_score_master >= 70 && $total_score_master <= 74.99) {
                $grade = 'MID GOLD';
            }
            elseif ($total_score_master >= 65 && $total_score_master <= 69.99) {
                $grade = 'LOW GOLD';
            }
            elseif ($total_score_master >= 60 && $total_score_master <= 64.99) {
                $grade = 'HIGH SILVER';
            }
            elseif ($total_score_master >= 50 && $total_score_master <= 59.99) {
                $grade = 'LOW SILVER';
            }
            elseif ($total_score_master >= 1 && $total_score_master <= 49.99) {
                $grade = 'BRONZE';
            }
            else {
                $grade = 'NO GRED';
            }
            $weightage = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_master*0.8);
            $grade_all = '';
            if ($total_score_all >= 80 ) {
                $grade_all = 'PLATINUM';
            }
            elseif ($total_score_all >= 75 && $total_score_all <= 79.99) {
                $grade_all = 'HIGH GOLD';
            }
            elseif ($total_score_all >= 70 && $total_score_all <= 74.99) {
                $grade_all = 'MID GOLD';
            }
            elseif ($total_score_all >= 65 && $total_score_all <= 69.99) {
                $grade_all = 'LOW GOLD';
            }
            elseif ($total_score_all >= 60 && $total_score_all <= 64.99) {
                $grade_all = 'HIGH SILVER';
            }
            elseif ($total_score_all >= 50 && $total_score_all <= 59.99) {
                $grade_all = 'LOW SILVER';
            }
            elseif ($total_score_all >= 1 && $total_score_all <= 49.99) {
                $grade_all = 'BRONZE';
            }
            else {
                $grade_all = 'NO GRED';
            }
            KPIAll_::find($kpiall_id)->update([
                'total_score_master'=>  $total_score_master,
                'grade_master'=>  $grade,
                'weightage_master'=>  $weightage,
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'updated_at'=> Carbon::now(),
            ]);
        }
        else {
            KPIAll_::insert([              
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now(),
                'year'=>  $year,
                'month'=>  $month,
            ]);
        }

        if (KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpimasters = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpimasters_id = count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0';
            $total_past = KPI_::where('fungsi', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_present = $request->skor_sebenar;
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $percent_master = DB::table('kpi_master')->where('id', '=', $kpimasters_id)->where('year', '=', $year)->where('month', '=', $month)->value('percent_master');
            $total_score = $total_past + $total_present;
            $skor_kpi =0;
            $skor_sebenar = 0;
 
            if ($total_score < 30 ) {
                $skor_kpi = $total_score;
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 30 && $total_score < 65) {
                $value1 = $total_score - 30;
                $value2 = 65 - 30;
                $skor_kpi = ((($value1/$value2)*35)+30);
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 65 && $total_score < 100) {
                $value1 = $total_score - 65;
                $value2 = 100 - 65;
                $skor_kpi = ((($value1/$value2)*35)+65);
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 100) {
                $skor_kpi = 100;
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }

            KPIMaster_::find($kpimasters_id)->update([
                'pencapaian'=>  $total_score,
                'skor_KPI'=>  $skor_kpi,
                'skor_sebenar'=>  $skor_sebenar,
                'kpiall_id'=>  count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0',
                'updated_at'=> Carbon::now(),
            ]);
        }
        else {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpimaster = KPIMaster_::insert([
                'created_at'=> Carbon::now(),
                'fungsi'=> $request->fungsi,
                'user_id'=> Auth::user()->id,
                'pencapaian'=> $request->skor_sebenar,
                'kpiall_id'=>  count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0',
                'year'=>  $year,
                'month'=>  $month,
            ]);
        }
        if (KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';
            $total_score_master = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $grade = '';
            if ($total_score_master >= 80 ) {
                $grade = 'PLATINUM';
            }
            elseif ($total_score_master >= 75 && $total_score_master <= 79.99) {
                $grade = 'HIGH GOLD';
            }
            elseif ($total_score_master >= 70 && $total_score_master <= 74.99) {
                $grade = 'MID GOLD';
            }
            elseif ($total_score_master >= 65 && $total_score_master <= 69.99) {
                $grade = 'LOW GOLD';
            }
            elseif ($total_score_master >= 60 && $total_score_master <= 64.99) {
                $grade = 'HIGH SILVER';
            }
            elseif ($total_score_master >= 50 && $total_score_master <= 59.99) {
                $grade = 'LOW SILVER';
            }
            elseif ($total_score_master >= 1 && $total_score_master <= 49.99) {
                $grade = 'BRONZE';
            }
            else {
                $grade = 'NO GRED';
            }
            $weightage = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_master*0.8);
            $grade_all = '';
            if ($total_score_all >= 80 ) {
                $grade_all = 'PLATINUM';
            }
            elseif ($total_score_all >= 75 && $total_score_all <= 79.99) {
                $grade_all = 'HIGH GOLD';
            }
            elseif ($total_score_all >= 70 && $total_score_all <= 74.99) {
                $grade_all = 'MID GOLD';
            }
            elseif ($total_score_all >= 65 && $total_score_all <= 69.99) {
                $grade_all = 'LOW GOLD';
            }
            elseif ($total_score_all >= 60 && $total_score_all <= 64.99) {
                $grade_all = 'HIGH SILVER';
            }
            elseif ($total_score_all >= 50 && $total_score_all <= 59.99) {
                $grade_all = 'LOW SILVER';
            }
            elseif ($total_score_all >= 1 && $total_score_all <= 49.99) {
                $grade_all = 'BRONZE';
            }
            else {
                $grade_all = 'NO GRED';
            }
            KPIAll_::find($kpiall_id)->update([
                'total_score_master'=>  $total_score_master,
                'grade_master'=>  $grade,
                'weightage_master'=>  $weightage,
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'updated_at'=> Carbon::now(),
            ]);
        }

        $kpimasters = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();

        $this->bukti_path = $request->bukti_path;
        if ($this->bukti_path != NULL) {
            $filenameWithExt = $this->bukti_path->getClientOriginalName();
            $extension = $this->bukti_path->getClientOriginalExtension();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $this->bukti_path->storeAs('public' . DIRECTORY_SEPARATOR . 'filebukti', $fileNameToStore);
            $path = '' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'filebukti' . DIRECTORY_SEPARATOR . '' . $fileNameToStore;

            KPI_::insert([
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'year'=> $year,
            'month'=> $month,
            'fungsi'=> $request->fungsi,
            'bukti'=> $request->bukti,
            'ukuran'=> $request->ukuran,
            'peratus'=> $request->peratus,
            'threshold'=> $request->threshold,
            'base'=> $request->base,
            'stretch'=> $request->stretch,
            'pencapaian'=> $request->pencapaian,
            'skor_KPI'=> $request->skor_KPI,
            'skor_sebenar'=> $request->skor_sebenar,
            // 'bukti_path'=> $path,
            'bukti_path'=> ''.URL::to('').$path.'',
            'kpimaster_id' => count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0',
            ]);
        }else   {
            KPI_::insert([
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'year'=> $year,
            'month'=> $month,
            'fungsi'=> $request->fungsi,
            'bukti'=> $request->bukti,
            'ukuran'=> $request->ukuran,
            'peratus'=> $request->peratus,
            'threshold'=> $request->threshold,
            'base'=> $request->base,
            'stretch'=> $request->stretch,
            'pencapaian'=> $request->pencapaian,
            'skor_KPI'=> $request->skor_KPI,
            'skor_sebenar'=> $request->skor_sebenar,
            'kpimaster_id' => count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0',
            ]);
        }

        return redirect()->back()->with('message', 'KPI has been successfully inserted');
    } 
       
    public function kpi_edit($id, $date_id, $user_id, $year, $month) {
        $kpi = KPI_::find($id);
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        return view('livewire.kpi.edit' , compact('kpi', 'date_id', 'user_id', 'year', 'month', 'status'));
    }

    public function kpi_update(Request $request, $id, $date_id, $user_id, $year, $month) {
        $validatedData = $request->validate([
            'fungsi' => ['required'],
            'bukti' => ['required'],
            'peratus' => ['required'],
            'ukuran' => ['required'],
            'threshold' => ['required'],
            'base' => ['required'],
            'stretch' => ['required'],
            'pencapaian' => ['required'],
            'skor_KPI' => ['required'],
            'skor_sebenar' => ['required'],
        ]);

        Date_::find($date_id)->update([
            'status'=> 'Not Submitted',
        ]);

        $this->bukti_path = $request->bukti_path;
        if ($this->bukti_path != NULL) {
            $filenameWithExt = $this->bukti_path->getClientOriginalName();
            $extension = $this->bukti_path->getClientOriginalExtension();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $this->bukti_path->storeAs('public' . DIRECTORY_SEPARATOR . 'filebukti', $fileNameToStore);
            $path = '' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'filebukti' . DIRECTORY_SEPARATOR . '' . $fileNameToStore;

            $update = KPI_::find($id)->update([
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'year'=> $request->year,
                'month'=> $request->month,
                'fungsi'=> $request->fungsi,
                'bukti'=> $request->bukti,
                'ukuran'=> $request->ukuran,
                'peratus'=> $request->peratus,
                'threshold'=> $request->threshold,
                'base'=> $request->base,
                'stretch'=> $request->stretch,
                'pencapaian'=> $request->pencapaian,
                'skor_KPI'=> $request->skor_KPI,
                'skor_sebenar'=> $request->skor_sebenar,
                'bukti_path'=> ''.URL::to('').$path.'',
            ]);
        }

        if ($this->bukti_path == NULL) {
            $update = KPI_::find($id)->update([
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'year'=> $request->year,
                'month'=> $request->month,
                'fungsi'=> $request->fungsi,
                'bukti'=> $request->bukti,
                'ukuran'=> $request->ukuran,
                'peratus'=> $request->peratus,
                'threshold'=> $request->threshold,
                'base'=> $request->base,
                'stretch'=> $request->stretch,
                'pencapaian'=> $request->pencapaian,
                'skor_KPI'=> $request->skor_KPI,
                'skor_sebenar'=> $request->skor_sebenar,
            ]);
        }

        if (KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';
            $total_score_master = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $grade = '';
            if ($total_score_master >= 80 ) {
                $grade = 'PLATINUM';
            }
            elseif ($total_score_master >= 75 && $total_score_master <= 79.99) {
                $grade = 'HIGH GOLD';
            }
            elseif ($total_score_master >= 70 && $total_score_master <= 74.99) {
                $grade = 'MID GOLD';
            }
            elseif ($total_score_master >= 65 && $total_score_master <= 69.99) {
                $grade = 'LOW GOLD';
            }
            elseif ($total_score_master >= 60 && $total_score_master <= 64.99) {
                $grade = 'HIGH SILVER';
            }
            elseif ($total_score_master >= 50 && $total_score_master <= 59.99) {
                $grade = 'LOW SILVER';
            }
            elseif ($total_score_master >= 1 && $total_score_master <= 49.99) {
                $grade = 'BRONZE';
            }
            else {
                $grade = 'NO GRED';
            }
            $weightage = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_master*0.8);
            $grade_all = '';
            if ($total_score_all >= 80 ) {
                $grade_all = 'PLATINUM';
            }
            elseif ($total_score_all >= 75 && $total_score_all <= 79.99) {
                $grade_all = 'HIGH GOLD';
            }
            elseif ($total_score_all >= 70 && $total_score_all <= 74.99) {
                $grade_all = 'MID GOLD';
            }
            elseif ($total_score_all >= 65 && $total_score_all <= 69.99) {
                $grade_all = 'LOW GOLD';
            }
            elseif ($total_score_all >= 60 && $total_score_all <= 64.99) {
                $grade_all = 'HIGH SILVER';
            }
            elseif ($total_score_all >= 50 && $total_score_all <= 59.99) {
                $grade_all = 'LOW SILVER';
            }
            elseif ($total_score_all >= 1 && $total_score_all <= 49.99) {
                $grade_all = 'BRONZE';
            }
            else {
                $grade_all = 'NO GRED';
            }
            KPIAll_::find($kpiall_id)->update([
                'total_score_master'=>  $total_score_master,
                'grade_master'=>  $grade,
                'weightage_master'=>  $weightage,
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'updated_at'=> Carbon::now(),
            ]);
        }
        else {
            KPIAll_::insert([              
                'user_id'=> Auth::user()->id,
                'created_at'=> Carbon::now(),
                'year'=>  $year,
                'month'=>  $month,
            ]);
        }

        if (KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpimasters = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpimasters_id = count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0';
            $total_score = KPI_::where('fungsi', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $percent_master = DB::table('kpi_master')->where('id', '=', $kpimasters_id)->where('year', '=', $year)->where('month', '=', $month)->value('percent_master');
            $skor_kpi = 0;
            $skor_sebenar = 0;
 
            if ($total_score < 30 ) {
                $skor_kpi = $total_score;
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 30 && $total_score < 65) {
                $value1 = $total_score - 30;
                $value2 = 65 - 30;
                $skor_kpi = ((($value1/$value2)*35)+30);
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 65 && $total_score < 100) {
                $value1 = $total_score - 65;
                $value2 = 100 - 65;
                $skor_kpi = ((($value1/$value2)*35)+65);
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }
            elseif ($total_score >= 100) {
                $skor_kpi = 100;
                $skor_sebenar = (($percent_master/100)*$skor_kpi);
            }

            KPIMaster_::find($kpimasters_id)->update([
                'pencapaian'=>  $total_score,
                'skor_KPI'=>  $skor_kpi,
                'skor_sebenar'=>  $skor_sebenar,
                'kpiall_id'=>  count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0',
                'updated_at'=> Carbon::now(),
            ]);
        }
        else {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpimaster = KPIMaster_::insert([
                'created_at'=> Carbon::now(),
                'fungsi'=> $request->fungsi,
                'user_id'=> Auth::user()->id,
                'pencapaian'=> $request->skor_sebenar,
                'kpiall_id'=>  count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0',
                'year'=>  $year,
                'month'=>  $month,
            ]);
        }
        if (KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';
            $total_score_master = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $grade = '';
            if ($total_score_master >= 80 ) {
                $grade = 'PLATINUM';
            }
            elseif ($total_score_master >= 75 && $total_score_master <= 79.99) {
                $grade = 'HIGH GOLD';
            }
            elseif ($total_score_master >= 70 && $total_score_master <= 74.99) {
                $grade = 'MID GOLD';
            }
            elseif ($total_score_master >= 65 && $total_score_master <= 69.99) {
                $grade = 'LOW GOLD';
            }
            elseif ($total_score_master >= 60 && $total_score_master <= 64.99) {
                $grade = 'HIGH SILVER';
            }
            elseif ($total_score_master >= 50 && $total_score_master <= 59.99) {
                $grade = 'LOW SILVER';
            }
            elseif ($total_score_master >= 1 && $total_score_master <= 49.99) {
                $grade = 'BRONZE';
            }
            else {
                $grade = 'NO GRED';
            }
            $weightage = KPIMaster_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('percent_master');
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_master*0.8);
            $grade_all = '';
            if ($total_score_all >= 80 ) {
                $grade_all = 'PLATINUM';
            }
            elseif ($total_score_all >= 75 && $total_score_all <= 79.99) {
                $grade_all = 'HIGH GOLD';
            }
            elseif ($total_score_all >= 70 && $total_score_all <= 74.99) {
                $grade_all = 'MID GOLD';
            }
            elseif ($total_score_all >= 65 && $total_score_all <= 69.99) {
                $grade_all = 'LOW GOLD';
            }
            elseif ($total_score_all >= 60 && $total_score_all <= 64.99) {
                $grade_all = 'HIGH SILVER';
            }
            elseif ($total_score_all >= 50 && $total_score_all <= 59.99) {
                $grade_all = 'LOW SILVER';
            }
            elseif ($total_score_all >= 1 && $total_score_all <= 49.99) {
                $grade_all = 'BRONZE';
            }
            else {
                $grade_all = 'NO GRED';
            }
            KPIAll_::find($kpiall_id)->update([
                'total_score_master'=>  $total_score_master,
                'grade_master'=>  $grade,
                'weightage_master'=>  $weightage,
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'updated_at'=> Carbon::now(),
            ]);
        }

        $kpimasters = KPIMaster_::where('fungsi', '=', $request->fungsi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();

        return redirect('employee/kpi/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month)->with('message', 'KPI Updated Successfully');
    }
    
    // public function add_kpi($date_id, $user_id, $year, $month) {
    //     $kadskor = KPI_::where('fungsi', '=', 'Kad Skor Korporat')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan1 = KPI_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan2 = KPI_::where('fungsi', '=', 'Kewangan2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan3 = KPI_::where('fungsi', '=', 'Kewangan3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan4 = KPI_::where('fungsi', '=', 'Kewangan4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan5 = KPI_::where('fungsi', '=', 'Kewangan5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan6 = KPI_::where('fungsi', '=', 'Kewangan6')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan7 = KPI_::where('fungsi', '=', 'Kewangan7')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan8 = KPI_::where('fungsi', '=', 'Kewangan8')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan9 = KPI_::where('fungsi', '=', 'Kewangan9')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kewangan10 = KPI_::where('fungsi', '=', 'Kewangan10')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $pelangganI = KPI_::where('fungsi', '=', 'Pelanggan (Internal)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $pelangganII = KPI_::where('fungsi', '=', 'Pelanggan (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kecemerlangan1 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kecemerlangan2 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kecemerlangan3 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kecemerlangan4 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kecemerlangan5 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $training = KPI_::where('fungsi', '=', 'Manusia & Proses (Training)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $ncr = KPI_::where('fungsi', '=', 'Manusia & Proses (NCROFI)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
    //     $kolaborasi = KPI_::where('fungsi', '=', 'Kolaborasi')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();

    //     $kadskorcount = $kadskor->count();
    //     $kewangan1count = $kewangan1->count();
    //     $kewangan2count = $kewangan2->count();
    //     $kewangan3count = $kewangan3->count();
    //     $kewangan4count = $kewangan4->count();
    //     $kewangan5count = $kewangan5->count();
    //     $kewangan6count = $kewangan6->count();
    //     $kewangan7count = $kewangan7->count();
    //     $kewangan8count = $kewangan8->count();
    //     $kewangan9count = $kewangan9->count();
    //     $kewangan10count = $kewangan10->count();
    //     $pelangganIcount = $pelangganI->count();
    //     $pelangganIIcount = $pelangganII->count();
    //     $kecemerlangan1count = $kecemerlangan1->count();
    //     $kecemerlangan2count = $kecemerlangan2->count();
    //     $kecemerlangan3count = $kecemerlangan3->count();
    //     $kecemerlangan4count = $kecemerlangan4->count();
    //     $kecemerlangan5count = $kecemerlangan5->count();
    //     $trainingcount = $training->count();
    //     $ncrcount = $ncr->count();
    //     $kolaborasicount = $kolaborasi->count();

    //     $kadskormaster = KPIMaster_::where('fungsi', '=', 'Kad Skor Korporat')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan1master = KPIMaster_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan2master = KPIMaster_::where('fungsi', '=', 'Kewangan2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan3master = KPIMaster_::where('fungsi', '=', 'Kewangan3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan4master = KPIMaster_::where('fungsi', '=', 'Kewangan4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan5master = KPIMaster_::where('fungsi', '=', 'Kewangan5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan6master = KPIMaster_::where('fungsi', '=', 'Kewangan6')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan7master = KPIMaster_::where('fungsi', '=', 'Kewangan7')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan8master = KPIMaster_::where('fungsi', '=', 'Kewangan8')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan9master = KPIMaster_::where('fungsi', '=', 'Kewangan9')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kewangan10master = KPIMaster_::where('fungsi', '=', 'Kewangan10')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $pelangganImaster = KPIMaster_::where('fungsi', '=', 'Pelanggan (Internal)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $pelangganIImaster = KPIMaster_::where('fungsi', '=', 'Pelanggan (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kecemerlangan1master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kecemerlangan2master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kecemerlangan3master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kecemerlangan4master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kecemerlangan5master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $trainingmaster = KPIMaster_::where('fungsi', '=', 'Manusia & Proses (Training)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $ncrmaster = KPIMaster_::where('fungsi', '=', 'Manusia & Proses (NCROFI)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
    //     $kolaborasimaster = KPIMaster_::where('fungsi', '=', 'Kolaborasi')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();

    //     $weightage_master = KpiAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('weightage_master');
    //     $weightage_kadskor = $kadskor->sum('peratus');
    //     $weightage_kewangan1 = $kewangan1->sum('peratus');
    //     $weightage_kewangan2 = $kewangan2->sum('peratus');
    //     $weightage_kewangan3 = $kewangan3->sum('peratus');
    //     $weightage_kewangan4 = $kewangan4->sum('peratus');
    //     $weightage_kewangan5 = $kewangan5->sum('peratus');
    //     $weightage_kewangan6 = $kewangan6->sum('peratus');
    //     $weightage_kewangan7 = $kewangan7->sum('peratus');
    //     $weightage_kewangan8 = $kewangan8->sum('peratus');
    //     $weightage_kewangan9 = $kewangan9->sum('peratus');
    //     $weightage_kewangan10 = $kewangan10->sum('peratus');
    //     $weightage_pelangganI = $pelangganI->sum('peratus');
    //     $weightage_pelangganII = $pelangganII->sum('peratus');
    //     $weightage_kecemerlangan1 = $kecemerlangan1->sum('peratus');
    //     $weightage_kecemerlangan2 = $kecemerlangan2->sum('peratus');
    //     $weightage_kecemerlangan3 = $kecemerlangan3->sum('peratus');
    //     $weightage_kecemerlangan4 = $kecemerlangan4->sum('peratus');
    //     $weightage_kecemerlangan5 = $kecemerlangan5->sum('peratus');
    //     $weightage_training = $training->sum('peratus');
    //     $weightage_ncr = $ncr->sum('peratus');
    //     $weightage_kolaborasi = $kolaborasi->sum('peratus');

    //     return view('livewire.kpi.all', compact('kadskor', 'kewangan1', 'kewangan2', 'kewangan3', 'kewangan4', 'kewangan5', 'kewangan6', 'kewangan7', 'kewangan8', 'kewangan9', 'kewangan10', 'pelangganI', 'pelangganII', 'kecemerlangan1', 'kecemerlangan2', 'kecemerlangan3', 'kecemerlangan4', 'kecemerlangan5', 
    //     'training', 'ncr', 'kolaborasi', 'kadskorcount', 'kewangan1count', 'kewangan2count', 'kewangan3count', 'kewangan4count', 'kewangan5count', 'kewangan6count', 'kewangan7count', 'kewangan8count', 'kewangan9count', 'kewangan10count',  'pelangganIcount', 'pelangganIIcount', 'kecemerlangan1count', 'kecemerlangan2count', 'kecemerlangan3count', 'kecemerlangan4count', 'kecemerlangan5count', 
    //     'trainingcount', 'ncrcount', 'kolaborasicount', 'kadskormaster', 'kewangan1master', 'kewangan2master', 'kewangan3master', 'kewangan4master', 'kewangan5master', 'kewangan6master', 'kewangan7master', 'kewangan8master', 'kewangan9master', 'kewangan10master', 'pelangganImaster', 'pelangganIImaster', 
    //     'kecemerlangan1master', 'kecemerlangan2master', 'kecemerlangan3master', 'kecemerlangan4master', 'kecemerlangan5master', 'trainingmaster', 'ncrmaster', 'kolaborasimaster' , 'weightage_master', 'year', 'month', 'date_id', 'user_id',
    //     'weightage_kadskor', 'weightage_kewangan1', 'weightage_kewangan2', 'weightage_kewangan3', 'weightage_kewangan4', 'weightage_kewangan5', 'weightage_kewangan6', 'weightage_kewangan7', 'weightage_kewangan8', 'weightage_kewangan9', 'weightage_kewangan10', 'weightage_pelangganI', 'weightage_pelangganII', 'weightage_kecemerlangan1', 'weightage_kecemerlangan2', 'weightage_kecemerlangan3', 'weightage_kecemerlangan4', 'weightage_kecemerlangan5',
    //     'weightage_training', 'weightage_ncr', 'weightage_kolaborasi'));
    // }

        public function render()
    {
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;

        $kadskor = KPI_::where('fungsi', '=', 'Kad Skor Korporat1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan1 = KPI_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan2 = KPI_::where('fungsi', '=', 'Kewangan2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan3 = KPI_::where('fungsi', '=', 'Kewangan3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan4 = KPI_::where('fungsi', '=', 'Kewangan4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan5 = KPI_::where('fungsi', '=', 'Kewangan5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan6 = KPI_::where('fungsi', '=', 'Kewangan6')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan7 = KPI_::where('fungsi', '=', 'Kewangan7')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan8 = KPI_::where('fungsi', '=', 'Kewangan8')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan9 = KPI_::where('fungsi', '=', 'Kewangan9')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kewangan10 = KPI_::where('fungsi', '=', 'Kewangan10')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $pelangganIn1 = KPI_::where('fungsi', '=', 'Pelanggan1 (Internal)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $pelangganEx1 = KPI_::where('fungsi', '=', 'Pelanggan1 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $pelangganEx2 = KPI_::where('fungsi', '=', 'Pelanggan2 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kecemerlangan1 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kecemerlangan2 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kecemerlangan3 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kecemerlangan4 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kecemerlangan5 = KPI_::where('fungsi', '=', 'Kecemerlangan Operasi5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $training = KPI_::where('fungsi', '=', 'Manusia & Proses1 (Training)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $ncr = KPI_::where('fungsi', '=', 'Manusia & Proses1 (NCROFI)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
        $kolaborasi = KPI_::where('fungsi', '=', 'Kolaborasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();

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

        $kadskormaster = KPIMaster_::where('fungsi', '=', 'Kad Skor Korporat1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan1master = KPIMaster_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan2master = KPIMaster_::where('fungsi', '=', 'Kewangan2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan3master = KPIMaster_::where('fungsi', '=', 'Kewangan3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan4master = KPIMaster_::where('fungsi', '=', 'Kewangan4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan5master = KPIMaster_::where('fungsi', '=', 'Kewangan5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan6master = KPIMaster_::where('fungsi', '=', 'Kewangan6')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan7master = KPIMaster_::where('fungsi', '=', 'Kewangan7')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan8master = KPIMaster_::where('fungsi', '=', 'Kewangan8')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan9master = KPIMaster_::where('fungsi', '=', 'Kewangan9')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kewangan10master = KPIMaster_::where('fungsi', '=', 'Kewangan10')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $pelangganIn1master = KPIMaster_::where('fungsi', '=', 'Pelanggan1 (Internal)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $pelangganEx1master = KPIMaster_::where('fungsi', '=', 'Pelanggan1 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $pelangganEx2master = KPIMaster_::where('fungsi', '=', 'Pelanggan2 (External)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecemerlangan1master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecemerlangan2master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi2')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecemerlangan3master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi3')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecemerlangan4master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi4')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kecemerlangan5master = KPIMaster_::where('fungsi', '=', 'Kecemerlangan Operasi5')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $trainingmaster = KPIMaster_::where('fungsi', '=', 'Manusia & Proses1 (Training)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $ncrmaster = KPIMaster_::where('fungsi', '=', 'Manusia & Proses1 (NCROFI)')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
        $kolaborasimaster = KPIMaster_::where('fungsi', '=', 'Kolaborasi1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();

        $weightage_master = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('weightage_master');
        $weightage_kadskor = $kadskor->sum('peratus');
        $weightage_kewangan1 = $kewangan1->sum('peratus');
        $weightage_kewangan2 = $kewangan2->sum('peratus');
        $weightage_kewangan3 = $kewangan3->sum('peratus');
        $weightage_kewangan4 = $kewangan4->sum('peratus');
        $weightage_kewangan5 = $kewangan5->sum('peratus');
        $weightage_kewangan6 = $kewangan6->sum('peratus');
        $weightage_kewangan7 = $kewangan7->sum('peratus');
        $weightage_kewangan8 = $kewangan8->sum('peratus');
        $weightage_kewangan9 = $kewangan9->sum('peratus');
        $weightage_kewangan10 = $kewangan10->sum('peratus');
        $weightage_pelangganIn1 = $pelangganIn1->sum('peratus');
        $weightage_pelangganEx1 = $pelangganEx1->sum('peratus');
        $weightage_pelangganEx2 = $pelangganEx2->sum('peratus');
        $weightage_kecemerlangan1 = $kecemerlangan1->sum('peratus');
        $weightage_kecemerlangan2 = $kecemerlangan2->sum('peratus');
        $weightage_kecemerlangan3 = $kecemerlangan3->sum('peratus');
        $weightage_kecemerlangan4 = $kecemerlangan4->sum('peratus');
        $weightage_kecemerlangan5 = $kecemerlangan5->sum('peratus');
        $weightage_training = $training->sum('peratus');
        $weightage_ncr = $ncr->sum('peratus');
        $weightage_kolaborasi = $kolaborasi->sum('peratus');

        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        $function = Function_::all();

        return view('livewire.kpi.all', compact('kadskor', 'kewangan1', 'kewangan2', 'kewangan3', 'kewangan4', 'kewangan5', 'kewangan6', 'kewangan7', 'kewangan8', 'kewangan9', 'kewangan10', 'pelangganIn1', 'pelangganEx1', 'pelangganEx2', 'kecemerlangan1', 'kecemerlangan2', 'kecemerlangan3', 'kecemerlangan4', 'kecemerlangan5', 
        'training', 'ncr', 'kolaborasi', 'kadskorcount', 'kewangan1count', 'kewangan2count', 'kewangan3count', 'kewangan4count', 'kewangan5count', 'kewangan6count', 'kewangan7count', 'kewangan8count', 'kewangan9count', 'kewangan10count', 'pelangganIn1count', 'pelangganEx1count', 'pelangganEx2count', 'kecemerlangan1count', 'kecemerlangan2count', 'kecemerlangan3count', 'kecemerlangan4count', 'kecemerlangan5count', 
        'trainingcount', 'ncrcount', 'kolaborasicount', 'kadskormaster', 'kewangan1master', 'kewangan2master', 'kewangan3master', 'kewangan4master', 'kewangan5master', 'kewangan6master', 'kewangan7master', 'kewangan8master', 'kewangan9master', 'kewangan10master', 'pelangganIn1master', 'pelangganEx1master', 'pelangganEx2master', 
        'kecemerlangan1master', 'kecemerlangan2master', 'kecemerlangan3master', 'kecemerlangan4master', 'kecemerlangan5master', 'trainingmaster', 'ncrmaster', 'kolaborasimaster' , 'weightage_master', 'year', 'month', 'date_id', 'user_id',
        'weightage_kadskor', 'weightage_kewangan1', 'weightage_kewangan2', 'weightage_kewangan3', 'weightage_kewangan4', 'weightage_kewangan5', 'weightage_kewangan6', 'weightage_kewangan7', 'weightage_kewangan8', 'weightage_kewangan9', 'weightage_kewangan10', 'weightage_pelangganIn1', 'weightage_pelangganEx1', 'weightage_pelangganEx2', 'weightage_kecemerlangan1', 'weightage_kecemerlangan2', 'weightage_kecemerlangan3', 'weightage_kecemerlangan4', 'weightage_kecemerlangan5',
        'weightage_training', 'weightage_ncr', 'weightage_kolaborasi', 'status', 'function'));
    }
}