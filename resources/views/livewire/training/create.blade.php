<div>
  <div>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">        
    <body>
      <div class="container-fluid py-4">
        
        <div class="row">
          <div class="col-lg-12">
                
            <div class="row">
              <div class="col-md-12 mb-lg-0 mb-4">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>{{ session('message') }}</strong></div>	
                @endif
                @if (session('fail'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>{{ session('fail') }}</strong></div>
                @endif

                <div class="card">
                  <form action="{{ url('/hr/create/training') }}" method="post" enctype="multipart/form-data">
                  @csrf  
                    <div class="card-body">
                      <h6>TRAINING FORM</h6><hr>
                    
                    <div class="col-md-12 mb-3">
                      <label class="form-label">Title<span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Offline Programme Training" required>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Student Name<span class="text-danger">*</span></label>
                        <input id="stud" class="form-control mb-1" placeholder="Insert Team Name" name="student" required>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Trainer<span class="text-danger">*</span></label>
                        <input id="train" class="form-control mb-1" placeholder="Insert Trainer Name" name="trainer" required>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>{{__("Date")}}<span class="text-danger">*</span></label>
                            <input type="datetime-local" name="date" class="form-control" value="" required>
                        </div>
                    </div>

                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                          <label class="form-label">Hours<span class="text-danger">*</span></label>
                          <input type="number" step=".01" class="form-control" id="hours" name="hours" placeholder="Insert Training Hour" required>
                          @error('hours') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                      </div>
                    </div>
                    </div>

                    <div class="col-12 text-end">
                      <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                    </div>

                    </div>
                  </form>     
                </div>

              </div>
            </div>
            

          </div>
        </div>
      </div>

      <script>
        $( function() {
          var lists =  @json($names);

          $( "#stud" ).autocomplete({
            source: lists
          });
          $( "#train" ).autocomplete({
            source: lists
          });
        } );
      </script>

    </body>
  </div>
</div> 