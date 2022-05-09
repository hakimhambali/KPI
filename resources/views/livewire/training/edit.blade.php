@section('content')
  @extends('layouts.app')
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
                      <form action="{{ url('/hr/update/training/'.$id) }}" method="post" enctype="multipart/form-data">
                        @csrf  
                        <div class="card-body">
                          <h6>EDIT TRAINING FORM</h6><hr>

                          @foreach ($training as $trainings)
                            <div class="col-md-12 mb-3">
                              <label class="form-label">Title<span class="text-danger">*</span></label>
                              <input class="form-control" type="text" name="title" value="{{ $trainings->title }}" placeholder="Offline Programme Coaching" required>
                            </div>
                          
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label class="form-label">Student Name<span class="text-danger">*</span></label>
                                <input id="stud" class="form-control mb-1" placeholder="Insert Team Name" name="student" value="{{ $trainings->student->name }}" required>
                              </div>

                              <div class="col-md-6 mb-3 mt-2">
                                <label class="form-label">Trainer Name<span class="text-danger">*</span></label>
                                <input id="train" class="form-control mb-1" placeholder="Insert Team Name" name="trainer" value="@if (is_numeric($trainings->trainer_id)) {{ ucwords(strtolower($trainings->trainer->name)) }} @else {{ ucwords(strtolower($trainings->trainer_id))}} @endif" required>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label class="form-label">Date<span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($trainings->date)) }}" required>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label class="form-label">Hours<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="6" id="hours" name="hours" value="{{ $trainings->hours }}" required>
                              </div>
                            </div>

                            <div class="col-12 text-end">
                              <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                            </div>
                          @endforeach

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
@endsection
    
    
    