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
            </div>

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
      </div>
    </div> 
  </body>
@endsection