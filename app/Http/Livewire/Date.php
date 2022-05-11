<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Date_;
use App\Models\KPIAll_;
use App\Models\KPI_;
use App\Models\KPIMaster_;
use App\Models\Kecekapan_;
use App\Models\Nilai_;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use DB;

class Date extends Component
{
    public $id_date;
    public $year;
    public $month;
    public $model_id;
    public $action;

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
        $date = Date_::find($this->id_date);
        $kecekapans = Kecekapan_::whereIn('user_id', [$date->user_id])->whereIn('year', [$date->year])->whereIn('month', [$date->month])->delete(); 
        $nilais = Nilai_::whereIn('user_id', [$date->user_id])->whereIn('year', [$date->year])->whereIn('month', [$date->month])->delete();
        $kpis = KPI_::whereIn('user_id', [$date->user_id])->whereIn('year', [$date->year])->whereIn('month', [$date->month])->delete();
        $masters = KPIMaster_::whereIn('user_id', [$date->user_id])->whereIn('year', [$date->year])->whereIn('month', [$date->month])->delete();
        $alls = KPIAll_::whereIn('user_id', [$date->user_id])->whereIn('year', [$date->year])->whereIn('month', [$date->month])->delete();

        $date->delete();
        return redirect()->back()->with('message', 'All KPI data for this date has been deleted successfully');
    }

    public function date_save(Request $request)
    {
        $count_date = Date_::where('year', '=', $request->year)->where('month', '=', $request->month)->where('user_id', '=', auth()->user()->id)->count();
        if ($count_date == 0)
        {
            $validatedData = $request->validate([
                'year' => ['required'],
                'month' => ['required'],
            ]);
            $add = New Date_;
            $add->year = $request->year;
            $add->month = $request->month;
            $add->user_id= Auth::user()->id;
            $add->status= 'Not Submitted';
            $add->save();
            return redirect()->back()->with('message', 'Date has been successfully inserted!');
        }else
        {
            return redirect()->back()->with('fail', 'Date has already exists!');
        }
    }

    public function date_edit($date_id, $user_id, $year, $month) {
        $date = Date_::find($date_id);
        return view('livewire.date.edit-employee' , compact('date', 'date_id', 'user_id', 'year', 'month'));
    }

    public function date_update(Request $request, $date_id, $user_id, $year, $month) {
        $validatedData = $request->validate([
            'year' => ['required'],
            'month' => ['required'],
        ]);

        $count_date = Date_::where('year', '=', $request->year)->where('month', '=', $request->month)->where('user_id', '=', auth()->user()->id)->count();

        if ($count_date == 0)
        {
            Date_::find($date_id)->update([
                'year'=> $request->year,
                'month'=> $request->month,
                'status'=> 'Not Submitted',
            ]);
    
            DB::table('kpi')->where('user_id', Auth::user()->id)->where('year', $year)->update(['year' => $request->year]);
            DB::table('kpi')->where('user_id', Auth::user()->id)->where('month', $month)->update(['month' => $request->month]);
    
            DB::table('kpi_master')->where('user_id', Auth::user()->id)->where('year', $year)->update(['year' => $request->year]);
            DB::table('kpi_master')->where('user_id', Auth::user()->id)->where('month', $month)->update(['month' => $request->month]);
    
            DB::table('kpi_all')->where('user_id', Auth::user()->id)->where('year', $year)->update(['year' => $request->year]);
            DB::table('kpi_all')->where('user_id', Auth::user()->id)->where('month', $month)->update(['month' => $request->month]);
    
            DB::table('kecekapan')->where('user_id', Auth::user()->id)->where('year', $year)->update(['year' => $request->year]);
            DB::table('kecekapan')->where('user_id', Auth::user()->id)->where('month', $month)->update(['month' => $request->month]);
    
            DB::table('nilai')->where('user_id', Auth::user()->id)->where('year', $year)->update(['year' => $request->year]);
            DB::table('nilai')->where('user_id', Auth::user()->id)->where('month', $month)->update(['month' => $request->month]);

            return redirect('/add-date')->with('message', 'Date Updated Successfully');
        }else
        {
            return redirect()->back()->with('fail', 'Date has already exists!');
        }
    }

    public function duplicate_all(Request $request, $date_id, $user_id, $year, $month)
    {
        $count_date = Date_::where('year', '=', $request->year)->where('month', '=', $request->month)->where('user_id', '=', auth()->user()->id)->count();
        if ($count_date == 0) {
            $date = Date_::find($date_id);
            $newDate = $date->replicate();

            $newDate -> year = $request->year;
            $newDate -> month = $request->month;
            $newDate -> status = 'Not Submitted';
            $newDate -> message_manager = NULL;
            $newDate -> message_hr = NULL;
            $newDate -> manager_id = NULL;
            $newDate -> hr_id = NULL;
            $newDate -> created_at = Carbon::now();
            $newDate -> updated_at = Carbon::now();

            $newDate->save();

            $kecekapans = Kecekapan_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->get();
            foreach($kecekapans as $kecekapan) {
                $newKecekapan = $kecekapan->replicate();

                $newKecekapan -> year = $request->year;
                $newKecekapan -> month = $request->month;
                $newKecekapan -> skor_penyelia = NULL;
                $newKecekapan -> skor_sebenar = NULL;
                $newKecekapan -> created_at = Carbon::now();
                $newKecekapan -> updated_at = Carbon::now();

                $newKecekapan->save();
            }

            $nilais = Nilai_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->get();
            foreach($nilais as $nilai) {
                $newNilai = $nilai->replicate();

                $newNilai -> year = $request->year;
                $newNilai -> month = $request->month;
                $newNilai -> skor_penyelia = NULL;
                $newNilai -> skor_sebenar = NULL;
                $newNilai -> created_at = Carbon::now();
                $newNilai -> updated_at = Carbon::now();

                $newNilai->save();
            }

            $all = KPIAll_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->first();
            // dd($all);
            if($all) {
                $total_score_all = ($all->total_score_master)*0.8;
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

                $newAll = $all->replicate();
                
                $newAll -> total_score_all = $total_score_all;
                $newAll -> grade_all = $grade_all;
                $newAll -> created_at = Carbon::now();
                $newAll -> updated_at = Carbon::now();
                $newAll -> year = $request->year;
                $newAll -> month = $request->month;
                $newAll -> weightage_kecekapan = NULL;
                $newAll -> total_score_kecekapan = NULL;
                $newAll -> weightage_nilai = NULL;
                $newAll -> total_score_nilai = NULL;

                $newAll->save();
            }

            $allId = $newAll->id;
            $masters = KPIMaster_::where('user_id', $user_id)->where('year', $year)->where('month', $month)->get();
            foreach($masters as $master) {
                $newMaster = $master->replicate();
                
                $newMaster -> created_at = Carbon::now();
                $newMaster -> updated_at = Carbon::now();
                $newMaster -> kpiall_id = $allId;
                $newMaster -> year = $request->year;
                $newMaster -> month = $request->month;

                $newMaster->save();

                $masterId = $newMaster->id;
                $functions = KPI_::where('user_id', $user_id)->where('kpimaster_id', $master->id)->get();
                foreach($functions as $function) {
                    $newFunction = $function->replicate();

                    $newFunction -> year = $request->year;
                    $newFunction -> month = $request->month;
                    $newFunction -> created_at = Carbon::now();
                    $newFunction -> updated_at = Carbon::now();
                    $newFunction -> kpimaster_id = $masterId;

                    $newFunction->save();
                }
            }

            return redirect()->back()->with('message', 'Date and KPI duplicate succesfully.');
        } else {
            return redirect()->back()->with('fail', 'Fail to duplicate. Date has already exists!');
        }
    }

    public function view_date($user_id)
    {
        $yearOrder = "CASE WHEN year = '2032' THEN 1 ";
        $yearOrder .= "WHEN year = '2031' THEN 2 ";
        $yearOrder .= "WHEN year = '2030' THEN 3 ";
        $yearOrder .= "WHEN year = '2029' THEN 4 ";
        $yearOrder .= "WHEN year = '2028' THEN 5 ";
        $yearOrder .= "WHEN year = '2027' THEN 6 ";
        $yearOrder .= "WHEN year = '2026' THEN 7 ";
        $yearOrder .= "WHEN year = '2025' THEN 8 ";
        $yearOrder .= "WHEN year = '2024' THEN 9 ";
        $yearOrder .= "WHEN year = '2023' THEN 10 ";
        $yearOrder .= "WHEN year = '2022' THEN 11 ";
        $yearOrder .= "WHEN year = '2021' THEN 12 ";
        $yearOrder .= "ELSE 13 END";

        $monthOrder = "CASE WHEN month = 'December' THEN 1 ";
        $monthOrder .= "WHEN month = 'November' THEN 2 ";
        $monthOrder .= "WHEN month = 'October' THEN 3 ";
        $monthOrder .= "WHEN month = 'September' THEN 4 ";
        $monthOrder .= "WHEN month = 'August' THEN 5 ";
        $monthOrder .= "WHEN month = 'July' THEN 6 ";
        $monthOrder .= "WHEN month = 'June' THEN 7 ";
        $monthOrder .= "WHEN month = 'May' THEN 8 ";
        $monthOrder .= "WHEN month = 'April' THEN 9 ";
        $monthOrder .= "WHEN month = 'March' THEN 10 ";
        $monthOrder .= "WHEN month = 'February' THEN 11 ";
        $monthOrder .= "WHEN month = 'January' THEN 12 ";
        $monthOrder .= "ELSE 13 END";

        $kpiall = KPIAll_::all();
        $user = User::where('id', '=', $user_id)->get();
        if (auth()->user()->role == "manager") {
            $date = Date_::where('user_id', '=', $user_id)->orderByRaw($yearOrder)->orderByRaw($monthOrder)->get();
            $kpi = KPI_::where('user_id', '=', $user_id)->get();
        } else if(auth()->user()->role == "hr"){
            $date = Date_::where('user_id', '=', $user_id)->orderByRaw($yearOrder)->orderByRaw($monthOrder)->get();
            $kpi = KPI_::where('user_id', '=', $user_id)->get();
        }

        return view('livewire.date.all-manager-hr', compact('kpiall', 'date', 'kpi', 'user_id', 'user'));
    }
    
        public function render()
    {
        $yearOrder = "CASE WHEN year = '2032' THEN 1 ";
        $yearOrder .= "WHEN year = '2031' THEN 2 ";
        $yearOrder .= "WHEN year = '2030' THEN 3 ";
        $yearOrder .= "WHEN year = '2029' THEN 4 ";
        $yearOrder .= "WHEN year = '2028' THEN 5 ";
        $yearOrder .= "WHEN year = '2027' THEN 6 ";
        $yearOrder .= "WHEN year = '2026' THEN 7 ";
        $yearOrder .= "WHEN year = '2025' THEN 8 ";
        $yearOrder .= "WHEN year = '2024' THEN 9 ";
        $yearOrder .= "WHEN year = '2023' THEN 10 ";
        $yearOrder .= "WHEN year = '2022' THEN 11 ";
        $yearOrder .= "WHEN year = '2021' THEN 12 ";
        $yearOrder .= "ELSE 13 END";

        $monthOrder = "CASE WHEN month = 'December' THEN 1 ";
        $monthOrder .= "WHEN month = 'November' THEN 2 ";
        $monthOrder .= "WHEN month = 'October' THEN 3 ";
        $monthOrder .= "WHEN month = 'September' THEN 4 ";
        $monthOrder .= "WHEN month = 'August' THEN 5 ";
        $monthOrder .= "WHEN month = 'July' THEN 6 ";
        $monthOrder .= "WHEN month = 'June' THEN 7 ";
        $monthOrder .= "WHEN month = 'May' THEN 8 ";
        $monthOrder .= "WHEN month = 'April' THEN 9 ";
        $monthOrder .= "WHEN month = 'March' THEN 10 ";
        $monthOrder .= "WHEN month = 'February' THEN 11 ";
        $monthOrder .= "WHEN month = 'January' THEN 12 ";
        $monthOrder .= "ELSE 13 END";

        // $date = Date_::where('user_id', '=', auth()->user()->id)->orderBy('year','desc')->orderByRaw('January')->orderByRaw('February')->orderByRaw('March')->orderByRaw('April')->orderByRaw('May')->orderByRaw('June')->orderByRaw('July')->orderByRaw('August')->orderByRaw('September')->orderByRaw('October')->orderByRaw('November')->orderByRaw('December')->get();
        $date = Date_::where('user_id', '=', auth()->user()->id)->orderByRaw($yearOrder)->orderByRaw($monthOrder)->get();
        $kpi = KPI_::where('user_id', '=', auth()->user()->id)->get();
        
        return view('livewire.date.all-employee', compact('date', 'kpi'));
    }
}