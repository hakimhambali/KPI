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
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;
        $kpi = KPI_::find($this->id_kpi);
        $fungsi = $kpi->fungsi;
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

    public function kpi_master_edit($id, $date_id, $user_id, $year, $month) {
        if(auth()->user()) {
            $this->date_id = $date_id;
            $this->user_id = $user_id;
            $this->year = $year;
            $this->month = $month;
            $this->id = $id;

        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        $kpimasters = KPIMaster_::find($id);
        $fungsi = $kpimasters->fungsi;
            return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
        } else {
        return redirect()->to('/');
        }
    }

    // public function kpi_master_edit2($id, $date_id, $user_id, $year, $month) {
    //     if(auth()->user()) {
    //         $this->date_id = $date_id;
    //         $this->user_id = $user_id;
    //         $this->year = $year;
    //         $this->month = $month;
    //         $this->id = $id;

    //         $kewangan1mastercount = KPIMaster_::where('fungsi', '=', 'Kewangan1')->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','asc')->count();
    //         $fungsi = 'Kewangan1';
    //         $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
    //         if ($kewangan1mastercount == 1) {
    //             $kpimasters = KPIMaster_::find($id);
    //             return view('livewire.kpi.edit-kpimaster' , compact('kpimasters', 'fungsi', 'date_id', 'user_id', 'year', 'month', 'status'));
    //         }
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }

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
        $function = Function_::all();
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');
        $fungsikpi = $kpi->fungsi;
        return view('livewire.kpi.edit' , compact('kpi', 'date_id', 'user_id', 'year', 'month', 'status', 'function', 'fungsikpi'));
    }

    public function kpi_update(Request $request, $id, $date_id, $user_id, $year, $month, $fungsikpi) {
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
        elseif (KPIMaster_::where('fungsi', '=', $fungsikpi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpimasters = KPIMaster_::where('fungsi', '=', $fungsikpi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpimasters_id = count($kpimasters) > 0 ? $kpimasters->sortByDesc('created_at')->first()->id : '0';
            $total_score = KPI_::where('fungsi', $fungsikpi)->where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
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
                'fungsi'=> $request->fungsi,
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

        public function render()
    {
        $date_id = $this->date_id;
        $user_id = $this->user_id;
        $year = $this->year;
        $month = $this->month;

        $function = Function_::where('status' , 'active')->get();

        $kpiArr[] = array();
        foreach ($function as $key => $functions) {
            $kpi = KPI_::where('fungsi', '=', $functions->name)->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('bukti','asc')->orderBy('created_at','asc')->get();
            array_push($kpiArr, $kpi);
        }

        $kpiMasterArr[] = array();
        foreach ($function as $key => $functions) {
            $kpimaster = KPIMaster_::where('fungsi', '=', $functions->name)->Where('user_id', '=', auth()->user()->id)->where('year', '=', $year)->where('month', '=', $month)->orderBy('created_at','desc')->get();
            array_push($kpiMasterArr, $kpimaster);
        }

        $weightage_master = KPIAll_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('weightage_master');
        $status = Date_::where('user_id', '=', Auth::user()->id)->where('year', '=', $year)->where('month', '=', $month)->value('status');

        return view('livewire.kpi.all', compact('year', 'month', 'date_id', 'user_id', 'status', 'function', 'kpiArr', 'kpiMasterArr', 'weightage_master'));
    }
}