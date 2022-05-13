@section('content')
  @extends('layouts.app')
    {{--------------------------------------------------- EMPLOYEE DETAILS --------------------------------------------------}}
    <div class="container-fluid pb-4">
      {{--------------------------------------------------- EMPLOYEE DETAILS ACCORDING TO THEIR DEPARTMENT --------------------------------------------------}}
      <?php $numDep= $department->count() ?>
      @foreach ($department as $key => $departments)
        @foreach ($departmentArr as $key => $departmentArrs)
          @foreach ($departmentArrs as $key => $departmentArrss)
            <?php $numOfTeamAll = $departmentArrss->count() ?>
          @endforeach
        @endforeach
      @endforeach
      @if(!empty($numOfTeamAll))
      <div class="row">
        <div class="col-md-4 pb-3">
          <div class="card bg-gradient-dark text-white text-center py-2">
            <h2 class="text-white">{{$numDep}}</h2>
            <p>Total Departments</p>
          </div>
        </div>

        <div class="col-md-4 pb-3">
          <div class="card bg-gradient-dark text-white text-center py-2">
            <h2 class="text-white">{{ count($unit)}}</h2>
            <p>Total Units</p>
          </div>
        </div>

        <div class="col-md-4 pb-3">
          <div class="card bg-gradient-danger text-white text-center py-2">
            <h2 class="text-white">{{$numOfTeamAll}}</h2>
            <p class="fs-6">Total Employees</p>
          </div>
        </div>
      </div>

      <div class="container-fluid pb-3">
        <div class="row">
          <div class="col-12">
            <form action="{{ url('/dashboard-hr') }}" method="GET" role="search">
              <div class="input-group">
                <button class="input-group-text btn-danger" data-bs-toggle="tooltip" data-bs-original-title="Refresh List"><span class="bi bi-arrow-repeat"></span></button>
                <input type="text" class="form-control" name="all" placeholder="Search Team Name..." id="all">
                <button class="input-group-text btn-dark" type="submit"><span class="bi bi-search"></span></button>
              </div>
            </form>
          </div>
        </div>
      </div> 

      @foreach ($department as $key1 => $departments)

        <div class="row">
          <div class="col-12">
            <div class="card mb-3">
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  
                      
                    @foreach ($departmentArr as $key2 => $departmentArrs)
                      @foreach ($departmentArrs as $key3 => $departmentArrss)
                        @if($departments->name == $departmentArrss->department)
                          
                          @if ($loop->last)
                            <div class="card-body">
                              <div class="fs-5 fw-bolder text-dark">
                                {{$departments->name}} Department 
                                <span class="float-end badge bg-success fs-6 text-dark py-2">{{$key3+1}} employees</span>
                              </div>

                              <thead class="text-center text-sm fw-bold">
                                <tr>
                                  <th class="col-5">NAME</th>
                                  <th>POSITION</th>
                                  <th>ID NO</th>
                                  <th>UNIT</th>
                                  <th>VIEW</th>
                                </tr>
                              </thead>
                          @endif
                          
                          <tbody>
                            <tr>
                              <td class="text-xs fw-bolder text-uppercase">
                                    <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">

                                {{$departmentArrss->name}}
                              </td>
                              <td class="text-xs fw-bold text-center">{{$departmentArrss->position}}</td>
                              <td class="text-xs fw-bold text-center">{{$departmentArrss->nostaff}}</td>
                              <td class="text-xs fw-bold text-center">{{$departmentArrss->unit}}</td>
                              <td class="text-center">
                                <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                                  <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu">
                                  <a href="{{ url('view-date/'.$departmentArrss->id) }}" class="dropdown-item text-dark fw-bold">KPI</a>
                                  <a href="{{ url('/hr-manager/view/training-coaching/'.$departmentArrss->id) }}" class="dropdown-item text-dark fw-bold">Training & Coaching</a>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        @endif
                      @endforeach
                    @endforeach

                  
                </table>
              </div>
            </div>
          </div>
        </div>
        
      @endforeach
      @else
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-md-12">      
            <div class="card">
              <div class="card-body">
              <p class="text-center">There's No Department Has Been Added. Please Contact Your Moderator For This System</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
@endsection