@include('layouts.navbars.auth.nav')
<body>

<div class="container-fluid py-4">
{{--------------------------------------------------- EDIT PERSONAL PROFILE --------------------------------------------------}}
<body>
  <div class="container-fluid pb-4">
    <div class="row">
      <form action="{{ url('employee/profile/update/'.Auth::user()->id) }}" method="post">   
        @csrf 
        <div class="col-12">
          @if (session('message'))
            <div class="alert alert-success alert-dismissible">
                <strong>{{ session('message') }}</strong>
            </div>	
          @endif

          <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                </div>
              </div>

              <div class="card-body p-3">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label>Full Name (Same as IC)<span class="text-danger">*</span></label>  
                    <input class="form-control form-control" type="text" name="name" value="{{ Auth::user()->name }}" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Position<span class="text-danger">*</span></label>
                    <select class="form-select form-select" id="position" name="position" >
                      <option selected class="bg-secondary text-white" value="{{ Auth::user()->position }}" >{{ Auth::user()->position }}</option>
                      @foreach ($position as $positions)
                        <option value="{{$positions->name}}">{{$positions->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              
                <div class="row">
                  <div class="col-md-2 mb-3">
                    <label>ID Number<span class="text-danger">*</span></label>
                    <input class="form form-control" type="text" name="nostaff" value="{{ Auth::user()->nostaff }}" required>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label>IC Number<span class="text-danger">*</span></label>
                    <input class="form form-control bg-white" type="text" name="ic" value="{{ Auth::user()->ic }}" readonly>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label>Email<span class="text-danger">*</span></label>
                    <input class="form form-control" type="text" name="email" value="{{ Auth::user()->email }}">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label>Department<span class="text-danger">*</span></label>
                    <select class="form-select form-select" id="department" name="department">
                      <option selected class="bg-secondary text-white" value="{{ Auth::user()->department }}" >{{ Auth::user()->department }}</option>
                      @foreach ($department as $departments)
                        <option value="{{$departments->name}}">{{$departments->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label>Unit Staff<span class="text-danger">*</span></label>
                    <select class="form-select form-select" id="unit" name="unit">
                      <option selected class="bg-secondary text-white" value="{{ Auth::user()->unit }}" >{{ Auth::user()->unit }}</option>
                      @foreach ($unit as $units)
                        <option value="{{$units->name}}">{{$units->name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
              </div>

              <div class="row p-3">
                <div class="col-6">
                    <a class="btn bg-gradient-danger btn-sm" href="{{ route('view-profile') }}" title="Previous Page"><i class="bi bi-caret-left-fill"></i></a>
                </div>
                <div class="col-6">
                    <button class="btn bg-gradient-dark btn-sm px-4 float-end" type="submit" href="javascript:;">Save</button>
                </div>
              </div>

              
            </div>
          </div>
        </div>
        </form>  
    </div>
</div>
</body>