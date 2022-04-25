@section('content')
  @extends('layouts.app')
<div>
    <div>
        <style>
            .solid {border-style: solid;}
            input[type=file]::file-selector-button {
            border: 2px solid #ffffff;
            padding: .2em .4em;
            border-radius: .7em;
            background-color: #252f40;
            border-color: #252f40;
            color: white;
            transition: 1s;
            }
      
            input[type=file]::file-selector-button:hover {
            background-color: #000000;
            border: 2px solid #000000;
            }
        </style>  
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
                          <div class="col-md-12 mb-3 mt-2">
                            <label class="form-label">Student Name<span class="text-danger">*</span></label>
                            <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">-- Choose Team --</option>
                            <option selected class="bg-secondary text-white" value="{{ $trainings->student_id }}" >{{ $trainings->student_id }}</option>
                            @foreach ($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach 
                            </select>
                        </div>

                        <div class="col-md-12 mb-3 mt-2">
                          <label class="form-label">Title<span class="text-danger">*</span></label>
                          <input class="form-control" type="text" name="title" value="{{ $trainings->title }}" placeholder="Offline Programme Coaching" required>
                      </div>

                        <div class="col-md-12 mb-3 mt-2">
                            <label class="form-label">Trainer Name<span class="text-danger">*</span></label>
                            <select class="form-select" id="trainer_id" name="trainer_id" required>
                            <option selected class="bg-secondary text-white" value="{{ $trainings->trainer_id }}" >{{ $trainings->trainer_id }}</option>
                            <option value="">-- Choose Trainer --</option>
                            @foreach ($user as $users)
                                <option value="{{$users->id}}">{{$users->name}}</option>
                            @endforeach 
                            </select>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>{{__("Date")}}<span class="text-danger">*</span></label>
                                <input type="datetime-local" name="date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($trainings->date)) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6 pr-1">
                          <div class="form-group">
                              <label class="form-label">Hours<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="6" id="hours" name="hours" value="{{ $trainings->hours }}" required >
                              @error('hours') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                          </div>
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
    
          @push('scripts')
          <script>
            document.addEventListener('livewire:load', function () {
              $(document).on("click", ".data-delete", function (e) 
                  {
                      e.preventDefault();
                      swal({
                      title: "Are you sure?",
                      text: "Once deleted, you will not be able to recover!",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                      })
                      .then((willDelete) => {
                      if (willDelete) {
                          e.preventDefault();
                          Livewire.emit('delete')
                      } 
                      });
                  });
            })
          </script>
          @endpush
    
        </body>
    </div>
    </div>
@endsection
    
    
    