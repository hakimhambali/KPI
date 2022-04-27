<div class="container-fluid py-4">
  <div class="row">
    <div class="col-md-6 pb-3">
      <div class="card bg-gradient-dark text-white text-center py-2">
        <h2 class="text-white">{{ count($units) }}</h2>
        <p>Total Units</p>
      </div>
    </div>

    <div class="col-md-6 pb-3">
      <div class="card bg-gradient-dark text-white text-center py-2">
        <h2 class="text-white">{{ $users->count() }}</h2>
        <p>Total Employees</p>
      </div>
    </div>
  </div>
  {{--------------------------------------------------- EMPLOYEE DETAILS FOR MANAGER'S DEPARTMENT --------------------------------------------------}}
  <div class="row">
    <div class="col-12">
      <div class="card mb-3">
  
        <div class="card-body">
          <h6>{{$userdepartment}} Department</h6><hr>
      
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="text-center text-sm fw-bold text-dark">
                <tr>
                  <th class="col-5">NAME</th>
                  <th>POSITION</th>
                  <th>ID NO</th>
                  <th>UNIT</th>
                  <th>VIEW</th>
                </tr>
              </thead>
              
              <tbody>
                @foreach ($users as $users)
                  <tr>
                    <td class="text-xs fw-bolder text-uppercase">
                      <img src="../assets/img/profileavatar.png" class="avatar avatar-sm me-3" alt="user1">
                      {{ $users->name }}
                    </td>
                    <td class="text-xs fw-bold text-center">{{$users->position}}</td>
                    <td class="text-xs fw-bold text-center">{{$users->nostaff}}</td>
                    <td class="text-xs fw-bold text-center">{{$users->unit}}</td>
                    <td class="text-center">
                      <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu">
                        <a href="{{ url('view-date/'.$users->id) }}" class="dropdown-item text-dark fw-bold">KPI</a>
                        <a href="{{ url('/hr/view/training-coaching/'.$departmentArrss->id) }}" class="dropdown-item text-dark fw-bold">Training & Coaching</a>
                        {{-- <a href="" class="dropdown-item text-dark fw-bold">Training & Coaching</a> --}}
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>