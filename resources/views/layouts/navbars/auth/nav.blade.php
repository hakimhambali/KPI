{{-- {{dd($kpiall)}} --}}
<main class="main-content mt-1 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    @if (Route::currentRouteName() == 'edit-profile')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/profile/view">View Profile</a>
                        </li>
                    @endif

                    {{-- {{dd(request()->route()->uri)}} --}}
                    {{-- {{dd(Route::currentRouteName())}} --}}
                    @if (Auth::user()->role == "hr")
                        @if (request()->route()->uri == 'view-date/{user_id}' || request()->route()->uri == 'hr-manager/view/training-coaching/{id}')
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/dashboard-hr">Dashboard Hr</a>
                            </li>
                        @endif
                    @endif

                    @if (Auth::user()->role == "manager")
                        @if (request()->route()->uri == 'view-date/{user_id}' || request()->route()->uri == 'hr-manager/view/training-coaching/{id}')
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/dashboard-manager">Dashboard Manager</a>
                            </li>
                        @endif

                        {{-- @if (request()->route()->uri == 'manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}')
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/dashboard-manager">Dashboard Manager</a>
                            </li>
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/view-date/{user_id}">View Date KPI Employee</a>
                            </li>
                        @endif

                        @if (request()->route()->uri == 'manager/edit/kecekapan/{id_user}/{date_id}/{user_id}/{year}/{month}')
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/dashboard-manager">Dashboard Manager</a>
                            </li>
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/view-date/{user_id}">View Date KPI Employee</a>
                            </li>
                            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}">View KPI Employee</a>
                            </li>
                        @endif --}}
                    @endif

                    @if (request()->route()->uri == 'hr/edit/coaching/{id}')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/dashboard-hr">Dashboard Hr</a>
                        </li>
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/hr-manager/view/training-coaching/{{$id}}">View Training & Coaching Employee</a>
                        </li>
                    @endif

                    @if (request()->route()->uri == 'employee/edit/kpi/{id}/{date_id}/{user_id}/{year}/{month}' || request()->route()->uri == 'employee/edit/kpimaster/{id}/{date_id}/{user_id}/{year}/{month}')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/add-date">Add Date</a>
                        </li>
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/employee/kpi/{date_id}/{user_id}/{year}/{month}">Kpi</a>
                        </li>
                    @endif

                    @if (request()->route()->uri == 'employee/edit/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/add-date">Add Date</a>
                        </li>
                    @endif

                    @if (request()->route()->uri == 'employee/edit/nilai/{id}/{date_id}/{user_id}/{year}/{month}')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/add-date">Add Date</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'Kpi' || Route::currentRouteName() == 'Kecekapan' || Route::currentRouteName() == 'Nilai' || Route::currentRouteName() == 'Display-KPI' || Route::currentRouteName() == 'Edit')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/add-date">Add Date</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'policy_edit')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/policy">Policy</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'sop_edit')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/sop">SOP</a>
                        </li>
                    @endif

                    @if (Route::currentRouteName() == 'memo_edit')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="/memo">Memo</a>
                        </li>
                    @endif

                    {{-- @if (Route::currentRouteName() == 'user-management')
                        <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="javascript:;">User Management</a>
                        </li>
                    @endif --}}
                    
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        @if (Route::currentRouteName() == 'coaching_edit')
                            {{ str_replace('-', ' ', 'Edit Training & Coaching Employee') }}</li>
                        @elseif (Route::currentRouteName() == 'policy_edit')
                            {{ str_replace('-', ' ', 'Edit Policy') }}</li>
                        @elseif (Route::currentRouteName() == 'sop_edit')
                            {{ str_replace('-', ' ', 'Edit SOP') }}</li>
                        @elseif (Route::currentRouteName() == 'Edit')
                            {{ str_replace('-', ' ', 'Edit Date') }}</li>
                        @elseif (Route::currentRouteName() == 'memo_edit')
                            {{ str_replace('-', ' ', 'Edit Memo') }}</li>
                        @elseif (Route::currentRouteName() != NULL)
                            {{ str_replace('-', ' ', Route::currentRouteName()) }}</li>
                        @elseif (request()->route()->uri == 'view-date/{user_id}')
                            {{ str_replace('-', ' ', 'View KPI Employee') }}</li>
                        @elseif (request()->route()->uri == 'hr-manager/view/training-coaching/{id}')
                            {{ str_replace('-', ' ', 'View Training & Coaching Employee') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kpi/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPI') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kpimaster/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPIMaster') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit Kecekapan') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/nilai/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit Nilai') }}</li>
                        @elseif (request()->route()->uri == 'view-date/{user_id}')
                            {{ str_replace('-', ' ', 'View Date KPI Employee') }}</li>
                        {{-- @elseif (request()->route()->uri == 'manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'View KPI Employee') }}</li>
                        @elseif (request()->route()->uri == 'manager/edit/kecekapan/{id_user}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPI Employee') }}</li> --}}
                        @endif
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">
                        @if (Route::currentRouteName() == 'coaching_edit')
                            {{ str_replace('-', ' ', 'Edit Training & Coaching Employee') }}</li>
                        @elseif (Route::currentRouteName() == 'policy_edit')
                            {{ str_replace('-', ' ', 'Edit Policy') }}</li>
                        @elseif (Route::currentRouteName() == 'sop_edit')
                            {{ str_replace('-', ' ', 'Edit SOP') }}</li>
                        @elseif (Route::currentRouteName() == 'Edit')
                            {{ str_replace('-', ' ', 'Edit Date') }}</li>
                        @elseif (Route::currentRouteName() == 'memo_edit')
                            {{ str_replace('-', ' ', 'Edit Memo') }}</li>
                        @elseif (Route::currentRouteName() != NULL)
                            {{ str_replace('-', ' ', Route::currentRouteName()) }}</li>
                        @elseif (request()->route()->uri == 'view-date/{user_id}')
                            {{ str_replace('-', ' ', 'View KPI Employee') }}</li>
                        @elseif (request()->route()->uri == 'hr-manager/view/training-coaching/{id}')
                            {{ str_replace('-', ' ', 'View Training & Coaching Employee') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kpi/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPI') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kpimaster/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPIMaster') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/kecekapan/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit Kecekapan') }}</li>
                        @elseif (request()->route()->uri == 'employee/edit/nilai/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit Nilai') }}</li>
                        @elseif (request()->route()->uri == 'view-date/{user_id}')
                            {{ str_replace('-', ' ', 'View Date KPI Employee') }}</li>
                        {{-- @elseif (request()->route()->uri == 'manager-hr/view/kpi/{id}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'View KPI Employee') }}</li>
                        @elseif (request()->route()->uri == 'manager/edit/kecekapan/{id_user}/{date_id}/{user_id}/{year}/{month}')
                            {{ str_replace('-', ' ', 'Edit KPI Employee') }}</li> --}}
                        @endif
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
                <ul class="navbar-nav justify-content-end">
<!-- s ---------------------------------------->
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge bg-gradient-dark"><i class="fa fa-bell cursor-pointer"></i>&nbsp;&nbsp;{{ $user->unreadNotifications->count() }}</span>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-1 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            @if ($user->notifications->count() > 0)
                                <li>
                                    <a class="dropdown-item border-radius-md" style="color: green" href="{{ route('markRead') }}">Mark all as Read</a>
                                </li>
                                @foreach ($user->unreadNotifications as $notification)
                                    <li>
                                        <a class="dropdown-item border-radius-sm bg-dark" href="/memo">
                                            <div class="d-flex">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span style="color: white"><b>New Memo</b> {{ $notification->data['title'] }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach

                                @foreach ($user->readNotifications as $notification)
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="/memo">
                                            <div class="d-flex">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">{{ $notification->data['title'] }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <a class="dropdown-item border-radius-md" href="">
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">No Memo
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

<!-- s ---------------------------------------->

                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                            <livewire:auth.logout />
                        </a>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

