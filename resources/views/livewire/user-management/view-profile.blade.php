{{-- {{dd($kpiall)}} --}}
@include('layouts.navbars.auth.nav')
@section('content')
<body>  
<div>
  <div>
    <div class="container-fluid">
      {{-- <div class="col-md-12 mt-3 pr-10">
        <small><nav aria-label="breadcrumb">
            <ol class="breadcrumb" >
              <li class="breadcrumb-item"><a href="{{ url('/profile/view') }}" style="color: blue">View Profile</a></li>
            </ol>
        </nav></small>
      </div> --}}
        <div class="page-header min-height-250 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
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
            </ul>
          </div>
        </div>
      </div>
      
     
      <!-- <div class="col-lg-5 ms-auto text-center mt-lg-0">
        <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
        <div class="position-relative d-flex align-items-center justify-content-center h-100">
            @foreach ($kpialls as $key => $kpiall)
              @if ($kpiall->grade_all == 'PLATINUM')
                <img class="w-100 position-relative z-index-2" src="../assets/img/platinum.png" alt="platinum">
              @elseif($kpiall->grade_all == 'HIGH GOLD')
                <img class="w-100 position-relative z-index-2" src="../assets/img/gold.png" alt="gold">
              @elseif($kpiall->grade_all == 'MID GOLD')
                <img class="w-100 position-relative z-index-2" src="../assets/img/gold.png" alt="gold">
              @elseif($kpiall->grade_all == 'LOW GOLD')
                <img class="w-100 position-relative z-index-2" src="../assets/img/gold.png" alt="gold">
              @elseif($kpiall->grade_all == 'HIGH SILVER')
                <img class="w-100 position-relative z-index-2" src="../assets/img/gold.png" alt="silver">
              @elseif($kpiall->grade_all == 'MID SILVER')
                <img class="w-100 position-relative z-index-2" src="../assets/img/gold.png" alt="silver">
              @elseif($kpiall->grade_all == 'LOW SILVER')
                <img class="w-100 position-relative z-index-2" src="../assets/img/silver.png" alt="silver">
              @elseif($kpiall->grade_all == 'BRONZE')
                <img class="w-100 position-relative z-index-2" src="../assets/img/bronze.png" alt="bronze">
              @else
                <img class="w-100 position-relative z-index-2" src="../assets/img/none.png" alt="none">
              @endif
            @endforeach
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">KPI</p>
                  @foreach ($kpialls as $key => $kpiall)  
                  <h5 class="font-weight-bolder mb-4">
                    {{ $kpiall -> total_score_master }}%
                  </h5>
                  @endforeach
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Score Akhir</p>
                  @foreach ($kpialls as $key => $kpiall)  
                  <h5 class="font-weight-bolder mb-4">
                    {{ round($kpiall -> total_score_all,2) }}%
                  </h5>
                  @endforeach
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Kecekapan Teras</p>
                  @foreach ($kpialls as $key => $kpiall)  
                  <h5 class="font-weight-bolder mb-4">
                    {{ $kpiall -> total_score_kecekapan }}%
                  </h5>
                  @endforeach
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Nilai Teras</p>
                  @foreach ($kpialls as $key => $kpiall)  
                  <h5 class="font-weight-bolder mb-0">
                    {{ $kpiall -> total_score_nilai }}%
                  </h5>
                  @endforeach
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      
    </div>
</div> 
</body>
@endsection