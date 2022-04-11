<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KPIAll_;
use App\Models\Date_;
use App\Models\KPI_;
use App\Models\KPIMaster_;
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
        $date->delete();
        return redirect()->back()->with('message', 'Date deleted successfully');
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

    public function view_date($user_id)
    {
        $yearOrder = "CASE WHEN year = '2021' THEN 1 ";
        $yearOrder .= "WHEN year = '2022' THEN 2 ";
        $yearOrder .= "WHEN year = '2023' THEN 3 ";
        $yearOrder .= "WHEN year = '2024' THEN 4 ";
        $yearOrder .= "WHEN year = '2025' THEN 5 ";
        $yearOrder .= "WHEN year = '2026' THEN 6 ";
        $yearOrder .= "WHEN year = '2027' THEN 7 ";
        $yearOrder .= "WHEN year = '2028' THEN 8 ";
        $yearOrder .= "WHEN year = '2029' THEN 9 ";
        $yearOrder .= "WHEN year = '2030' THEN 10 ";
        $yearOrder .= "WHEN year = '2031' THEN 11 ";
        $yearOrder .= "WHEN year = '2032' THEN 12 ";
        $yearOrder .= "ELSE 13 END";

        $monthOrder = "CASE WHEN month = 'January' THEN 1 ";
        $monthOrder .= "WHEN month = 'February' THEN 2 ";
        $monthOrder .= "WHEN month = 'March' THEN 3 ";
        $monthOrder .= "WHEN month = 'April' THEN 4 ";
        $monthOrder .= "WHEN month = 'May' THEN 5 ";
        $monthOrder .= "WHEN month = 'June' THEN 6 ";
        $monthOrder .= "WHEN month = 'July' THEN 7 ";
        $monthOrder .= "WHEN month = 'August' THEN 8 ";
        $monthOrder .= "WHEN month = 'September' THEN 9 ";
        $monthOrder .= "WHEN month = 'October' THEN 10 ";
        $monthOrder .= "WHEN month = 'November' THEN 11 ";
        $monthOrder .= "WHEN month = 'December' THEN 12 ";
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
        $yearOrder = "CASE WHEN year = '2021' THEN 1 ";
        $yearOrder .= "WHEN year = '2022' THEN 2 ";
        $yearOrder .= "WHEN year = '2023' THEN 3 ";
        $yearOrder .= "WHEN year = '2024' THEN 4 ";
        $yearOrder .= "WHEN year = '2025' THEN 5 ";
        $yearOrder .= "WHEN year = '2026' THEN 6 ";
        $yearOrder .= "WHEN year = '2027' THEN 7 ";
        $yearOrder .= "WHEN year = '2028' THEN 8 ";
        $yearOrder .= "WHEN year = '2029' THEN 9 ";
        $yearOrder .= "WHEN year = '2030' THEN 10 ";
        $yearOrder .= "WHEN year = '2031' THEN 11 ";
        $yearOrder .= "WHEN year = '2032' THEN 12 ";
        $yearOrder .= "ELSE 13 END";

        $monthOrder = "CASE WHEN month = 'January' THEN 1 ";
        $monthOrder .= "WHEN month = 'February' THEN 2 ";
        $monthOrder .= "WHEN month = 'March' THEN 3 ";
        $monthOrder .= "WHEN month = 'April' THEN 4 ";
        $monthOrder .= "WHEN month = 'May' THEN 5 ";
        $monthOrder .= "WHEN month = 'June' THEN 6 ";
        $monthOrder .= "WHEN month = 'July' THEN 7 ";
        $monthOrder .= "WHEN month = 'August' THEN 8 ";
        $monthOrder .= "WHEN month = 'September' THEN 9 ";
        $monthOrder .= "WHEN month = 'October' THEN 10 ";
        $monthOrder .= "WHEN month = 'November' THEN 11 ";
        $monthOrder .= "WHEN month = 'December' THEN 12 ";
        $monthOrder .= "ELSE 13 END";

        // $date = Date_::where('user_id', '=', auth()->user()->id)->orderBy('year','desc')->orderByRaw('January')->orderByRaw('February')->orderByRaw('March')->orderByRaw('April')->orderByRaw('May')->orderByRaw('June')->orderByRaw('July')->orderByRaw('August')->orderByRaw('September')->orderByRaw('October')->orderByRaw('November')->orderByRaw('December')->get();
        $date = Date_::where('user_id', '=', auth()->user()->id)->orderByRaw($yearOrder)->orderByRaw($monthOrder)->get();
        $kpi = KPI_::where('user_id', '=', auth()->user()->id)->get();
        
        return view('livewire.date.all-employee', compact('date', 'kpi'));
    }
}