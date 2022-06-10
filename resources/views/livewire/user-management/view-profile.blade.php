@include('layouts.navbars.auth.nav')
{{--------------------------------------------------- VIEW PERSONAL PROFILE --------------------------------------------------}}
@section('content')
  <body> 
    <div class="container-fluid">
      <div class="page-header min-height-200 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
        
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../assets/img/profileavatar.png" alt="profile_image" class="w-70 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1 text-capitalize">
                  {{ Auth::user()->name }}
              </h5>
              <p class="mb-0 font-weight-bold text-sm text-capitalize">
                  {{ Auth::user()->role }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-6">
          <div class="card h-200">
            
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="{{ route('edit-profile') }}">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div><hr>

            <div class="card-body p-3">
              <p class="text-sm">
                Hi, I’m {{ Auth::user()->name }}, <br>
                My ID No is {{ Auth::user()->nostaff }} and i'm in {{ Auth::user()->unit }} unit at {{ Auth::user()->department }} department.
              </p>
              <hr>
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm text-capitalize"><strong class="text-dark">Full Name:</strong> {{ Auth::user()->name }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">ID No:</strong> {{ Auth::user()->nostaff }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Position:</strong> {{ Auth::user()->position }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Department:</strong> {{ Auth::user()->department }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Unit:</strong> {{ Auth::user()->unit }}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">IC Number:</strong> {{ Auth::user()->ic}}</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Date Start Working:</strong> @if(Auth::user()->starting_month == '') - @else {{ date('j F Y', strtotime(Auth::user()->starting_month)) }} @endif </li>
              </ul>
            </div>

          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <h6 class="mb-0">Update Password</h6>
              </div>
            </div><hr>

            @if (session('success'))
              <div class="alert alert-success alert-dismissible p-2 mx-2">
                  <strong><small>{{ session('success') }}</small></strong>
              </div>	
            @elseif (session('error'))
              <div class="alert alert-warning alert-dismissible p-2 mx-2">
                <strong><small>{{ session('error') }}</small></strong>
              </div>
            @endif

            <form action="{{ url('employee/password/update/'.Auth::user()->id) }}" method="post">   
              @csrf 
              <div class="card-body p-3">
                <div class="row justify-content-center">
                  <div class="col-md-10 mb-2">
                    <label>Current Password<span class="text-danger">*</span></label>
                    <input type="password" name="current-password" id="current-password" class="form-control" placeholder="Enter Current Password" required>
                    @if ($errors->has('current-password'))
                      <span class="help-block mb-1">
                        <strong><small class="text-danger">{{ $errors->first('current-password') }}</small></strong>
                      </span>
                    @endif
                  </div>
                  
                  <div class="col-md-10 mb-2">
                    <label>New Password<span class="text-danger">*</span></label>
                    <input type="password" name="new-password" id="new-password" class="form-control" placeholder="Enter New Password" required>
                    @if ($errors->has('new-password'))
                      <span class="help-block mb-1">
                        <strong><small class="text-danger">{{ $errors->first('new-password') }}</small></strong>
                      </span>
                    @endif
                  </div>
                  
                  <div class="col-md-10 mb-4">
                    <label>Confirm New Password<span class="text-danger">*</span></label>
                    <input type="password" name="new-password_confirmation" id="new-password_confirmation" class="form-control" placeholder="Enter Confirm Password" required>
                  </div>
                </div>

                <div class="row justify-content-end">
                  <div class="col-4">
                    <button class="btn bg-gradient-dark btn-sm" type="submit">Save Change</button>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div> 
  </body>
@endsection