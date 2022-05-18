@include('layouts.navbars.auth.nav')
<body>

<div class="container-fluid py-4">
  {{-- <div class="col-md-12 mt-3 pr-10">
    <small>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb" >
            <li class="breadcrumb-item"><a href="{{ url('/profile/view') }}" style="color: blue">View Profile</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/profile/edit') }}" style="color: blue">Edit Profile</a></li>
        </ol>
      </nav>
    </small>
  </div> --}}
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
                
                          {{-- <option class="text-center bg-dark text-white" value="">-- Others --</option>
                          @if (Auth::user()->unit != "Head Department")
                          <option value="Head Department">Head Department</option>
                          @endif
                          @if (Auth::user()->unit != "Senior Leadership Team (SLT)")
                          <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- CEO Office --</option>
                          @if (Auth::user()->unit != "Personal Assistant")
                          <option value="Personal Assistant">Personal Assistant</option>
                          @endif
                          @if (Auth::user()->unit != "Document Controller")
                          <option value="Document Controller">Document Controller</option>
                          @endif
                          @if (Auth::user()->unit != "Driver & Logistic")
                          <option value="Driver & Logistic">Driver & Logistic</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Human Resource (HR) & Administration --</option>
                          @if (Auth::user()->unit != "Payroll and C&B")
                          <option value="Payroll and C&B">Payroll and C&B</option>
                          @endif
                          @if (Auth::user()->unit != "Training & Development")
                          <option value="Training & Development">Training & Development</option>
                          @endif
                          @if (Auth::user()->unit != "Admin Procurement")
                          <option value="Admin Procurement">Admin Procurement</option>
                          @endif
                          @if (Auth::user()->unit != "Recruitment")
                          <option value="Recruitment">Recruitment</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Account & Finance (A&F) --</option>
                          @if (Auth::user()->unit != "Account Receivable")
                          <option value="Account Receivable">Account Receivable</option>
                          @endif
                          @if (Auth::user()->unit != "Account Payable")
                          <option value="Account Payable">Account Payable</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Sales --</option>
                          @if (Auth::user()->unit != "Customer Support & Closing")
                          <option value="Customer Support & Closing">Customer Support & Closing</option>
                          @endif
                          @if (Auth::user()->unit != "Program")
                          <option value="Program">Program</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Marketing --</option>
                          @if (Auth::user()->unit != "Creative Director")
                          <option value="Creative Director">Creative Director</option>
                          @endif
                          @if (Auth::user()->unit != "Media Director")
                          <option value="Media Director">Media Director</option>
                          @endif
                          @if (Auth::user()->unit != "Social Media")
                          <option value="Social Media">Social Media</option>
                          @endif
                          @if (Auth::user()->unit != "Digital Marketer")
                          <option value="Digital Marketer">Digital Marketer</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Operation --</option>
                          @if (Auth::user()->unit != "Admin & Procurement")
                          <option value="Admin & Procurement">Admin & Procurement</option>
                          @endif
                          @if (Auth::user()->unit != "Backstage")
                          <option value="Backstage">Backstage</option>
                          @endif
                          @if (Auth::user()->unit != "Inventory & Logistic")
                          <option value="Inventory & Logistic">Inventory & Logistic</option>
                          @endif
                          @if (Auth::user()->unit != "General Worker")
                          <option value="General Worker">General Worker</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- High Network Client (HNC) --</option>
                          @if (Auth::user()->unit != "Platinum")
                          <option value="Platinum">Platinum</option>
                          @endif
                          @if (Auth::user()->unit != "Ultimate")
                          <option value="Ultimate">Ultimate</option>
                          @endif
                          @if (Auth::user()->unit != "Graphic")
                          <option value="Graphic">Graphic</option>
                          @endif

                          <option class="text-center bg-dark text-white" value="">-- Research & Development (R&D) --</option>
                          @if (Auth::user()->unit != "Web Designer")
                          <option value="Web Designer">Web Designer</option>
                          @endif
                          @if (Auth::user()->unit != "Web Developer")
                          <option value="Web Developer">Web Developer</option>
                          @endif
                          @if (Auth::user()->unit != "Data Analytic")
                          <option value="Data Analytic">Data Analytic</option>
                          @endif --}}

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