<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KPI_;
use App\Models\KPIMaster_;
use App\Models\Kecekapan_;
use App\Models\Nilai_;
use App\Models\KpiAll_;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class KecekapanManager extends Component
{
    public function kecekapan_edit($id_user, $id, $date_id, $user_id, $year, $month) {
        $kecekapan = Kecekapan_::find($id);
        $user = User::find($id_user);

        return view('livewire.kecekapan-manager.edit' , compact('kecekapan', 'user', 'date_id', 'user_id', 'year', 'month'));
    }
    
    public function kecekapan_update(Request $request,$id_user, $id, $date_id, $user_id, $year, $month) {
        $validatedData = $request->validate([
            'skor_penyelia' => ['required'],
        ]);
    
        $update = Kecekapan_::find($id)->update([
            'skor_penyelia'=> $request->skor_penyelia,
            'skor_sebenar' => $request->skor_sebenar,
        ]);

        if (KPIAll_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->count() == 1) {
            $kpiall = KPIAll_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->get();
            $kpiall_id = count($kpiall) > 0 ? $kpiall->sortByDesc('created_at')->first()->id : '0';
            $total_score_kecekapan = Kecekapan_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_nilai = Nilai_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_kpi = KPIMaster_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->sum('skor_sebenar');
            $total_score_all = ($total_score_kecekapan*0.1) + (($total_score_nilai/1.2)*0.1) + ($total_score_kpi*0.8);
            $weightage = Kecekapan_::where('user_id', '=', $id_user)->where('year', '=', $year)->where('month', '=', $month)->sum('peratus');

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
                'total_score_all'=>  $total_score_all,
                'grade_all'=>  $grade_all,
                'total_score_kecekapan'=> $total_score_kecekapan,
                'weightage_kecekapan'=> $weightage,
            ]);
        }
        else {
            KPIAll_::insert([              
                'user_id'=> $id_user,
            ]);
        }

        return redirect('manager-hr/view/kpi/'.$id_user.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month)->with('message', 'Skor penyelia Updated Successfully');
    }

    public function render()
    {
        // $kecekapan = Kecekapan_::where('user_id', '=', auth()->user()->id)->orderBy('kecekapan_teras')->get();
        // $userdepartment = auth()->user()->department;
        // $users = User::where([['department', '=', $userdepartment] , ['role', '=', 'employee']])->orderBy('created_at','desc')->get();
        
        // return view('livewire.kecekapan.all', compact('kecekapan', 'users'));
        return view('livewire.kecekapan.all');
    }
}