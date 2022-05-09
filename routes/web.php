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
Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

//Employee Route
// Route::post('/employee/save/kpi/{year}/{month}',[KPI::class, 'kpi_save']);
Route::post('/employee/save/kpi/{date_id}/{user_id}/{year}/{month}',[KPI::class, 'kpi_save']);
Route::get('/employee/edit/kpimaster/{id}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_master_edit']);
Route::post('/employee/update/kpimaster/{id}/{fungsi}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_master_update']);
// Route::post('/employee/save/kecekapan/{year}/{month}',[Kecekapan::class, 'kecekapan_save']);
Route::post('/employee/save/kecekapan/{date_id}/{user_id}/{year}/{month}',[Kecekapan::class, 'kecekapan_save']);
// Route::post('/employee/save/nilai/{year}/{month}',[Nilai::class, 'nilai_save']);
Route::post('/employee/save/nilai/{date_id}/{user_id}/{year}/{month}',[Nilai::class, 'nilai_save']);
Route::get('/employee/edit/kpi/{id}/{date_id}/{user_id}/{year}/{month}', [KPI::class, 'kpi_edit']);
Route::post('/employee/update/kpi/{id}/{date_id}/{user_id}/{year}/{month}/{fungsikpi}', [KPI::class, 'kpi_update']);
Route::get('/employee/edit/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}', [Kecekapan::class, 'kecekapan_edit']);
Route::post('/employee/update/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}', [Kecekapan::class, 'kecekapan_update']);
Route::get('/employee/edit/nilai/{id}/{date_id}/{user_id}/{year}/{month}', [Nilai::class, 'nilai_edit']);
Route::post('/employee/update/nilai/{id}/{date_id}/{user_id}/{year}/{month}', [Nilai::class, 'nilai_update']);
Route::get('/employee/changeup/kpi/{date_id}', [Displaykpi::class, 'changeup']);
Route::get('/employee/changedown/kpi/{date_id}', [Displaykpi::class, 'changedown']);
Route::get('/employee/kpi/{date_id}/{user_id}/{year}/{month}', KPI::class)->name('Kpi');
Route::get('/employee/kecekapan/{date_id}/{user_id}/{year}/{month}', Kecekapan::class)->name('Kecekapan');
Route::get('/employee/nilai/{date_id}/{user_id}/{year}/{month}', Nilai::class)->name('Nilai');
Route::get('/employee/displaykpi/{date_id}/{user_id}/{year}/{month}', [Displaykpi::class, 'view_all'])->name('Display-KPI');
Route::get('/employee/edit/date/{date_id}/{user_id}/{year}/{month}', [Date::class, 'date_edit'])->name('Edit');
Route::post('/employee/update/date/{date_id}/{user_id}/{year}/{month}', [Date::class, 'date_update']);

//Manager Route
Route::get('/manager/edit/kecekapan/{id_user}/{id}/{date_id}/{user_id}/{year}/{month}', [KecekapanManager::class, 'kecekapan_edit']);
Route::post('/manager/update/kecekapan/{id_user}/{id}/{date_id}/{user_id}/{year}/{month}', [KecekapanManager::class, 'kecekapan_update']);
Route::get('/manager/edit/nilai/{id_user}/{id}/{date_id}/{user_id}/{year}/{month}', [NilaiManager::class, 'nilai_edit']);
Route::post('/manager/update/nilai/{id_user}/{id}/{date_id}/{user_id}/{year}/{month}', [NilaiManager::class, 'nilai_update']);

// Route::get('/manager/changeup/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'changeupmanager']);
// Route::get('/manager/changedown/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'changedownmanager']);
// Route::post('/manager/messageup/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'messageupmanager']);
// Route::get('/manager/messagedown/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'messagedownmanager']);
Route::get('/manager/changeup/kpi/{date_id}', [ManagerKPI::class, 'changeupmanager']);
Route::get('/manager/changedown/kpi/{date_id}', [ManagerKPI::class, 'changedownmanager']);
Route::post('/manager/messageup/kpi/{date_id}', [ManagerKPI::class, 'messageupmanager']);

// Route::get('/manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}', [\App\Http\Controllers\ManagerKPI::class, 'index']);
Route::get('/manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}', ManagerKPI::class);

//HR Route
// Route::get('/hr/changeup/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'changeuphr']);
// Route::get('/hr/changedown/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'changedownhr']);
// Route::post('/hr/messageup/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'messageuphr']);
Route::get('/hr/changeup/kpi/{date_id}', [ManagerKPI::class, 'changeuphr']);
Route::get('/hr/changedown/kpi/{date_id}', [ManagerKPI::class, 'changedownhr']);
Route::post('/hr/messageup/kpi/{date_id}', [ManagerKPI::class, 'messageuphr']);
Route::get('/dashboard-hr',  [\App\Http\Controllers\DashboardHR::class, 'searchDashboard'])->name('dashboard-hr');
// Route::get('/dashboard-hr', DashboardHR::class)->name('dashboard-hr');
// Route::get('/hr/messagedown/kpi/{date_id}', [\App\Http\Controllers\ManagerKPI::class, 'messagedownhr']);

//Memo Route
Route::post('/hr/create/memo', [Memo::class, 'create']);
Route::get('/hr/edit/memo/{id}', [Memo::class, 'edit'])->name('memo_edit');
Route::post('/hr/update/memo/{id}', [Memo::class, 'update']);
Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead');

//Training Route
Route::post('/hr/create/training', [Training::class, 'create']);
Route::get('/hr/edit/training/{id}', [Training::class, 'edit'])->name('training_edit');
Route::post('/hr/update/training/{id}', [Training::class, 'update']);
// Route::get('/hr/view/training-coaching/{id}', Training::class);
Route::get('/hr-manager/view/training-coaching/{id}', [Training::class, 'view']);
Route::get('/view-hours', [Training::class, 'employee_view'])->name('view-hours');
//get team name
Route::get('autocomplete', [Training::class, 'autocomplete'])->name('autocomplete');

//Coaching Route
Route::post('/hr/create/coaching', [Coaching::class, 'create']);
Route::get('/hr/edit/coaching/{id}', [Coaching::class, 'edit'])->name('coaching_edit');
Route::post('/hr/update/coaching/{id}', [Coaching::class, 'update']);

//SOP Route
Route::post('/dc/create/sop', [SOP::class, 'create']);
Route::get('/dc/edit/sop/{id}', [SOP::class, 'edit'])->name('sop_edit');
Route::post('/dc/update/sop/{id}', [SOP::class, 'update']);

//Policy Route
Route::post('/hr/create/policy', [Policy::class, 'create']);
Route::get('/hr/edit/policy/{id}', [Policy::class, 'edit'])->name('policy_edit');
Route::post('/hr/update/policy/{id}', [Policy::class, 'update']);

//Complaint Route
Route::post('/pro/create/complaint', [Complaint::class, 'create']);
Route::post('/pro/update/complaint/{id}', [Complaint::class, 'update'])->name('complaint/update');

//ANNOUNCEMENT FOR HOME PAGE
Route::post('/hr/announcementuphr/{id_announcement}', [Homepage::class, 'announcementuphr']);

//INTEGRATION TO FINDOWNER
Route::get("/findowner", [FindOwnerController::class, "index"]);

//ADD FUNCTION
Route::get('/add-function', [Moderator::class, 'function'])->name('add-function');
Route::post('/moderator/create/function', [Moderator::class, 'create_function']);
Route::get('/moderator/up/function/{id}', [Moderator::class, 'up_function']);
Route::get('/moderator/down/function/{id}', [Moderator::class, 'down_function']);

//ADD DEPARTMENT
Route::get('/add-department', [Moderator::class, 'department'])->name('add-department');
Route::post('/moderator/create/department', [Moderator::class, 'create_department']);
Route::get('/moderator/up/department/{id}', [Moderator::class, 'up_department']);
Route::get('/moderator/down/department/{id}', [Moderator::class, 'down_department']);

//ADD POSITION
Route::get('/add-position', [Moderator::class, 'position'])->name('add-position');
Route::post('/moderator/create/position', [Moderator::class, 'create_position']);
Route::get('/moderator/up/position/{id}', [Moderator::class, 'up_position']);
Route::get('/moderator/down/position/{id}', [Moderator::class, 'down_position']);

//ADD ROLE
Route::get('/add-role', [Moderator::class, 'role'])->name('add-role');
Route::post('/moderator/create/role', [Moderator::class, 'create_role']);
Route::get('/moderator/up/role/{id}', [Moderator::class, 'up_role']);
Route::get('/moderator/down/role/{id}', [Moderator::class, 'down_role']);

//ADD UNIT
Route::get('/add-unit', [Moderator::class, 'unit'])->name('add-unit');
Route::post('/moderator/create/unit', [Moderator::class, 'create_unit']);
Route::get('/moderator/up/unit/{id}', [Moderator::class, 'up_unit']);
Route::get('/moderator/down/unit/{id}', [Moderator::class, 'down_unit']);

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard-hr', DashboardHR::class)->name('dashboard-hr');
    Route::get('/dashboard-manager', DashboardManager::class)->name('dashboard-manager');
    Route::get('/homepage', Homepage::class)->name('homepage');
    Route::post('/employee/profile/update/{id}',[EditProfile::class, 'profile_update']);
    Route::get('/add-date', Date::class)->name('add-date');
    Route::get('/memo', Memo::class)->name('memo');
    Route::get('/sop', SOP::class)->name('sop');
    Route::get('/policy', Policy::class)->name('policy');
    Route::get('/complaint', Complaint::class)->name('complaint');
    // Route::get('/findowner', FindOwnerController::class)->name('findowner');
    Route::get('/core-value', CoreValue::class)->name('core-value');
    Route::get('/organizational-chart', OrganizationalChart::class)->name('organizational-chart');
    Route::get('/view-date/{user_id}', [Date::class, 'view_date']);
    Route::post('/date/save',[Date::class, 'date_save'])->name('date_save');
    Route::get('/profile/view', ViewProfile::class)->name('view-profile');
    Route::get('/profile/edit', EditProfile::class)->name('edit-profile');
    Route::get('/user-management', UserManagement::class)->name('user-management');
    Route::get('/user-management-admin', UserManagementAdmin::class)->name('user-management-admin');
    Route::get('/training', Training::class)->name('training');
    Route::get('/coaching', Coaching::class)->name('coaching');
});

// Route::post('/hr/create/sop', [SOP::class, 'create'] ,function ( Request $request ) {
//     dd( $request->input('departmentview') ); // print array of values of selected checkboxes
// });