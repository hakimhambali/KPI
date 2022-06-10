<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Controllers\DashboardHR;
use App\Http\Livewire\DashboardManager;
use App\Http\Livewire\Homepage;
use App\Http\Livewire\KPI;
use App\Http\Livewire\Date;
use App\Http\Livewire\Displaykpi;
use App\Http\Livewire\Kecekapan;
use App\Http\Livewire\KecekapanManager;
use App\Http\Livewire\Nilai;
use App\Http\Livewire\NilaiManager;
use App\Http\Livewire\ManagerKPI;
use App\Http\Livewire\Memo;
use App\Http\Livewire\SOP;
use App\Http\Livewire\Policy;
use App\Http\Livewire\Complaint;
use App\Http\Livewire\CoreValue;
use App\Http\Livewire\OrganizationalChart;
use App\Http\Livewire\UserManagement\ViewProfile;
use App\Http\Livewire\UserManagement\EditProfile;
use App\Http\Livewire\UserManagement\UserManagement;
use App\Http\Livewire\UserManagement\UserManagementAdmin;
use App\Http\Controllers\FindOwnerController;
use App\Http\Livewire\Training;
use App\Http\Livewire\Coaching;
use App\Http\Livewire\Moderator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Login::class)->name('login');
Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');
Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password',ResetPassword::class)->name('reset-password');
Route::post('/reset-password/update',[ResetPassword::class, 'reset_password'])->name('reset-save');

/////////////////// EMPLOYEE KPI //////////////////////////////////////////////////////////////////////////////////
// Date KPI
Route::get('/employee/edit/date/{date_id}/{user_id}/{year}/{month}', [Date::class, 'date_edit'])->name('Edit');
Route::post('/employee/update/date/{date_id}/{user_id}/{year}/{month}', [Date::class, 'date_update']);

// KPI
Route::get('/employee/kpi/{date_id}/{user_id}/{year}/{month}', KPI::class)->name('Kpi');
Route::post('/employee/save/kpi/{date_id}/{user_id}/{year}/{month}',[KPI::class, 'kpi_save']);
Route::get('/employee/edit/kpi/{id}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_edit']);
Route::post('/employee/update/kpi/{id}/{date_id}/{user_id}/{year}/{month}/{fungsikpi}', [KPI::class, 'kpi_update']);
Route::get('/employee/edit/kpimaster/{id}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_master_edit']);
Route::post('/employee/update/kpimaster/{id}/{fungsi}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_master_update']);
Route::get('/employee/changeup/kpi/{date_id}', [Displaykpi::class, 'changeup']); // status -> Submitted
Route::get('/employee/changedown/kpi/{date_id}', [Displaykpi::class, 'changedown']); // status -> Not Submitted
Route::get('/employee/displaykpi/{date_id}/{user_id}/{year}/{month}', [Displaykpi::class, 'view_all'])->name('Display-KPI');

// Kecekapan Teras
Route::get('/employee/kecekapan/{date_id}/{user_id}/{year}/{month}', Kecekapan::class)->name('Kecekapan');
Route::post('/employee/save/kecekapan/{date_id}/{user_id}/{year}/{month}',[Kecekapan::class, 'kecekapan_save']);
Route::get('/employee/edit/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}', [Kecekapan::class, 'kecekapan_edit']);
Route::post('/employee/update/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}', [Kecekapan::class, 'kecekapan_update']);

// Nilai Teras
Route::get('/employee/nilai/{date_id}/{user_id}/{year}/{month}', Nilai::class)->name('Nilai');
Route::post('/employee/save/nilai/{date_id}/{user_id}/{year}/{month}',[Nilai::class, 'nilai_save']);
Route::get('/employee/edit/nilai/{id}/{date_id}/{user_id}/{year}/{month}', [Nilai::class, 'nilai_edit']);
Route::post('/employee/update/nilai/{id}/{date_id}/{user_id}/{year}/{month}', [Nilai::class, 'nilai_update']);

// Display Training & Coaching Hour
Route::get('/view-hours', [Training::class, 'employee_view'])->name('view-hours');

/////////////////// MANAGER KPI //////////////////////////////////////////////////////////////////////////////////
// Manage Kecekapan
Route::get('/manager/edit/kecekapan/{id_user}/{date_id}/{user_id}/{year}/{month}', [KecekapanManager::class, 'kecekapan_edit']);
Route::post('/manager/update/kecekapan/{id_user}/{date_id}/{user_id}/{year}/{month}', [KecekapanManager::class, 'kecekapan_update']);

// Manage Nilai
Route::get('/manager/edit/nilai/{id_user}/{date_id}/{user_id}/{year}/{month}', [NilaiManager::class, 'nilai_edit']);
Route::post('/manager/update/nilai/{id_user}/{date_id}/{user_id}/{year}/{month}', [NilaiManager::class, 'nilai_update']);

// Selected KPI
Route::get('/manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}', ManagerKPI::class); // Display all
Route::get('/manager/changeup/kpi/{date_id}', [ManagerKPI::class, 'changeupmanager']); // status -> Signed By Manager
Route::get('/manager/changedown/kpi/{date_id}', [ManagerKPI::class, 'changedownmanager']); // status -> submitted
Route::post('/manager/messageup/kpi/{date_id}', [ManagerKPI::class, 'messageupmanager']);

/////////////////// HUMAN RESOURCE (HR) //////////////////////////////////////////////////////////////////////////////////
// HR KPI
Route::get('/hr/changeup/kpi/{date_id}', [ManagerKPI::class, 'changeuphr']);
Route::get('/hr/changedown/kpi/{date_id}', [ManagerKPI::class, 'changedownhr']);
Route::post('/hr/messageup/kpi/{date_id}', [ManagerKPI::class, 'messageuphr']);

// Manage Memo
Route::post('/hr/create/memo', [Memo::class, 'create']);
Route::get('/hr/edit/memo/{id}', [Memo::class, 'edit'])->name('memo_edit');
Route::post('/hr/update/memo/{id}', [Memo::class, 'update']);
Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

// Manage Training
Route::post('/hr/create/training', [Training::class, 'create']);
Route::get('/hr/edit/training/{id}', [Training::class, 'edit'])->name('training_edit');
Route::post('/hr/update/training/{id}', [Training::class, 'update']);
Route::get('/hr-manager/view/training-coaching/{id}', [Training::class, 'manager_view']);
Route::get('/training-delete2/{id}', [Training::class, 'delTrain']);

// Manage Coaching
Route::post('/hr/create/coaching', [Coaching::class, 'create']);
Route::get('/hr/edit/coaching/{id}', [Coaching::class, 'edit'])->name('coaching_edit');
Route::post('/hr/update/coaching/{id}', [Coaching::class, 'update']);
Route::get('/training-delete1/{id}', [Training::class, 'delCoach']);

// Manage Policy
Route::post('/hr/create/policy', [Policy::class, 'create']);
Route::get('/hr/edit/policy/{id}', [Policy::class, 'edit'])->name('policy_edit');
Route::post('/hr/update/policy/{id}', [Policy::class, 'update']);

// ANNOUNCEMENT HOME PAGE
Route::post('/hr/announcementuphr/{id_announcement}', [Homepage::class, 'announcementuphr']);

/////////////////// DOCUMENT CONTROLLER (DC) /////////////////////////////////////////////////////////////////////////////////
// Manage SOP
Route::post('/dc/create/sop', [SOP::class, 'create']);
Route::get('/dc/edit/sop/{id}', [SOP::class, 'edit'])->name('sop_edit');
Route::post('/dc/update/sop/{id}', [SOP::class, 'update']);

/////////////////// PROCUREMET (PRO) /////////////////////////////////////////////////////////////////////////////////////////
//Complaint Route
Route::post('/pro/create/complaint', [Complaint::class, 'create']);
Route::post('/pro/update/complaint/{id}', [Complaint::class, 'update'])->name('complaint/update');

/////////////////// MODERATOR ///////////////////////////////////////////////////////////////////////////////////////////////
// Manage FUNCTION
Route::get('/add-function', [Moderator::class, 'function'])->name('add-function');
Route::post('/moderator/create/function', [Moderator::class, 'create_function']);
Route::get('/moderator/delete/function/{id}', [Moderator::class, 'delete_function']);

// Manage DEPARTMENT
Route::get('/add-department', [Moderator::class, 'department'])->name('add-department');
Route::post('/moderator/create/department', [Moderator::class, 'create_department']);
Route::get('/moderator/delete/department/{id}', [Moderator::class, 'delete_department']);

// Manage POSITION
Route::get('/add-position', [Moderator::class, 'position'])->name('add-position');
Route::post('/moderator/create/position', [Moderator::class, 'create_position']);
Route::get('/moderator/delete/position/{id}', [Moderator::class, 'delete_position']);

// Manage ROLE
Route::get('/add-role', [Moderator::class, 'role'])->name('add-role');
Route::post('/moderator/create/role', [Moderator::class, 'create_role']);
Route::get('/moderator/delete/role/{id}', [Moderator::class, 'delete_role']);

// Manage UNIT
Route::get('/add-unit', [Moderator::class, 'unit'])->name('add-unit');
Route::post('/moderator/create/unit', [Moderator::class, 'create_unit']);
Route::get('/moderator/delete/unit/{id}', [Moderator::class, 'delete_unit']);

/////////////////// INTEGRATION FINDOWNER //////////////////////////////////////////////////////////////////////////////
Route::get("/findowner", [FindOwnerController::class, "index"]);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard-hr',  [\App\Http\Controllers\DashboardHR::class, 'searchDashboard'])->name('dashboard-hr');
    Route::get('/dashboard-manager', DashboardManager::class)->name('dashboard-manager');
    Route::get('/homepage', Homepage::class)->name('homepage');

    Route::get('/profile/view', ViewProfile::class)->name('view-profile');
    Route::get('/profile/edit', EditProfile::class)->name('edit-profile');
    Route::post('/employee/profile/update/{id}',[EditProfile::class, 'profile_update']);
    Route::post('/employee/password/update/{id}',[ViewProfile::class, 'pwd_update']);

    Route::get('/add-date', Date::class)->name('add-date');
    Route::post('employee/duplicate/date/{date_id}/{user_id}/{year}/{month}',[Date::class, 'duplicate_all']);
    Route::get('/view-date/{user_id}', [Date::class, 'view_date']);
    Route::post('/date/save',[Date::class, 'date_save'])->name('date_save');
    Route::get('/training', Training::class)->name('training');
    Route::get('/coaching', Coaching::class)->name('coaching');

    Route::get('/memo', Memo::class)->name('memo');
    Route::get('/sop', SOP::class)->name('sop');
    Route::get('/policy', Policy::class)->name('policy');
    Route::get('/complaint', Complaint::class)->name('complaint');
    Route::get('/core-value', CoreValue::class)->name('core-value');
    Route::get('/organizational-chart', OrganizationalChart::class)->name('organizational-chart');
    //SAVE EMPLOYEE STARTING MONTH
    Route::post('/employee/month/save/{id}', [Training::class, 'employee_month_save']);

    Route::get('/user-management', UserManagement::class)->name('user-management');
    Route::get('/user-management-admin', UserManagementAdmin::class)->name('user-management-admin');
    
});