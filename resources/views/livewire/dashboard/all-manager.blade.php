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
              <thead class="text-center text-sm fw-bold opacity-7">
                <tr>
                  <th class="col-5">Name</th>
                  <th>Position</th>
                  <th>ID No</th>
                  <th>Unit</th>
                  <th></th>
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
                    <td class="text-xs fw-bold"><a href="{{ url('view-date/'.$users->id) }}" class="btn btn-info btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="View KPI"><i class="bi bi-list-columns-reverse"></i></a></td>
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