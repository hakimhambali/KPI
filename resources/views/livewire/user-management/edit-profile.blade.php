<body>

<div class="container-fluid py-4">
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
                          @if (Auth::user()->position != "CEO (TM2)")
                          <option value="CEO (TM2)">CEO (TM2)</option>
                          @endif
                          @if (Auth::user()->position != "Director (TM1)")
                          <option value="Director (TM1)">Director (TM1)</option>
                          @endif
                          @if (Auth::user()->position != "Senior Leadership Team (SLT) (UM1)")
                          <option value="Senior Leadership Team (SLT) (UM1)">Senior Leadership Team (SLT) (UM1)</option>
                          @endif
                          @if (Auth::user()->position != "Senior Manager (M3)")
                          <option value="Senior Manager (M3)">Senior Manager (M3)</option>
                          @endif
                          @if (Auth::user()->position != "Manager (M2)")
                          <option value="Manager (M2)">Manager (M2)</option>
                          @endif
                          @if (Auth::user()->position != "Assistant Manager (M1)")
                          <option value="Assistant Manager (M1)">Assistant Manager (M1)</option>
                          @endif
                          @if (Auth::user()->position != "Senior Executive (E3)")
                          <option value="Senior Executive (E3)">Senior Executive (E3)</option>
                          @endif
                          @if (Auth::user()->position != "Executive (E2)")
                          <option value="Executive (E2)">Executive (E2)</option>
                          @endif
                          @if (Auth::user()->position != "Junior Executive (E1)")
                          <option value="Junior Executive (E1)">Junior Executive (E1)</option>
                          @endif
                          @if (Auth::user()->position != "Senior Non-Executive (NE2)")
                          <option value="Senior Non-Executive (NE2)">Senior Non-Executive (NE2)</option>
                          @endif
                          @if (Auth::user()->position != "Junior Non-Executive (NE1)")
                          <option value="Junior Non-Executive (NE1)">Junior Non-Executive (NE1)</option>
                          @endif
                        </select>
                      </div>
                    </div>
                  
                    <div class="row">
                      <div class="col-md-2 mb-3">
                        <label>ID Number<span class="text-danger">*</span></label>
                        <input class="form-control form-control" type="text" name="nostaff" value="{{ Auth::user()->nostaff }}" required>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label>IC Number<span class="text-danger">*</span></label>
                        <input class="form-control form-control" type="text" name="ic" value="{{ Auth::user()->ic }}" readonly>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label>Email<span class="text-danger">*</span></label>
                        <input class="form-control form-control" type="text" name="email" value="{{ Auth::user()->email }}">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label>Department<span class="text-danger">*</span></label>
                        <select class="form-select form-select" id="department" name="department">
                          <option selected class="bg-secondary text-white" value="{{ Auth::user()->department }}" >{{ Auth::user()->department }}</option>
                            
                          @if (Auth::user()->department != "Senior Leadership Team (SLT)")
                            <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                          @endif

                          @if (Auth::user()->department != "CEO Office")
                            <option value="CEO Office">CEO Office</option>
                          @endif

                          @if (Auth::user()->department != "Human Resource (HR) & Administration")
                          <option value="Human Resource (HR) & Administration">Human Resource (HR) & Administration</option>
                          @else
                          @endif

                          @if (Auth::user()->department != "Account & Finance (A&F)")
                          <option value="Account & Finance (A&F)">Account & Finance (A&F)</option>
                          @else
                          @endif

                          @if (Auth::user()->department != "Sales")
                          <option value="Sales">Sales</option>
                          @else
                          @endif

                          @if (Auth::user()->department != "Marketing")
                          <option value="Marketing">Marketing</option>
                          @else
                          @endif
                          
                          @if (Auth::user()->department != "Operation")
                          <option value="Operation">Operation</option>
                          @else
                          @endif

                          @if (Auth::user()->department != "High Network Client (HNC)")
                          <option value="High Network Client (HNC)">High Network Client (HNC)</option>
                          @else
                          @endif

                          @if (Auth::user()->department != "Research & Development (R&D)")
                          <option value="Research & Development (R&D)">Research & Development (R&D)</option>
                          @else
                          @endif
                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label>Unit Staff<span class="text-danger">*</span></label>
                        <select class="form-select form-select" id="unit" name="unit">
                          <option selected class="bg-secondary text-white" value="{{ Auth::user()->unit }}" >{{ Auth::user()->unit }}</option>
                
                          <option class="text-center" value="">-- Others --</option>
                          @if (Auth::user()->unit != "Head Department")
                          <option value="Head Department">Head Department</option>
                          @endif
                          @if (Auth::user()->unit != "Senior Leadership Team (SLT)")
                          <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                          @endif

                          <option class="text-center" value="">-- CEO Office --</option>
                          @if (Auth::user()->unit != "Personal Assistant")
                          <option value="Personal Assistant">Personal Assistant</option>
                          @endif
                          @if (Auth::user()->unit != "Document Controller")
                          <option value="Document Controller">Document Controller</option>
                          @endif
                          @if (Auth::user()->unit != "Driver & Logistic")
                          <option value="Driver & Logistic">Driver & Logistic</option>
                          @endif

                          <option class="text-center" value="">-- Human Resource (HR) & Administration --</option>
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

                          <option class="text-center" value="">-- Account & Finance (A&F) --</option>
                          @if (Auth::user()->unit != "Account Receivable")
                          <option value="Account Receivable">Account Receivable</option>
                          @endif
                          @if (Auth::user()->unit != "Account Payable")
                          <option value="Account Payable">Account Payable</option>
                          @endif

                          <option class="text-center" value="">-- Sales --</option>
                          @if (Auth::user()->unit != "Customer Support & Closing")
                          <option value="Customer Support & Closing">Customer Support & Closing</option>
                          @endif
                          @if (Auth::user()->unit != "Program")
                          <option value="Program">Program</option>
                          @endif

                          <option class="text-center" value="">-- Marketing --</option>
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

                          <option class="text-center" value="">-- Operation --</option>
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

                          <option class="text-center" value="">-- High Network Client (HNC) --</option>
                          @if (Auth::user()->unit != "Platinum")
                          <option value="Platinum">Platinum</option>
                          @endif
                          @if (Auth::user()->unit != "Ultimate")
                          <option value="Ultimate">Ultimate</option>
                          @endif
                          @if (Auth::user()->unit != "Graphic")
                          <option value="Graphic">Graphic</option>
                          @endif

                          <option class="text-center" value="">-- Research & Development (R&D) --</option>
                          @if (Auth::user()->unit != "Web Designer")
                          <option value="Web Designer">Web Designer</option>
                          @endif
                          @if (Auth::user()->unit != "Web Developer")
                          <option value="Web Developer">Web Developer</option>
                          @endif
                          @if (Auth::user()->unit != "Data Analytic")
                          <option value="Data Analytic">Data Analytic</option>
                          @endif

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row p-3">
                    <div class="col-6">
                        <a class="btn bg-gradient-danger btn-sm" href="{{ route('view-profile') }}" title="Previous Page"><i class="bi bi-caret-left-fill"></i></a>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn bg-gradient-dark btn-sm px-4 text-end" type="submit" href="javascript:;">Save</button>
                    </div>
                  </div>

                 
                </div>
              </div>
        </div>
        </form>  
    </div>
</div>
</body>