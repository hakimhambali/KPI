{{-- View TRAINING & COACHING (HR) -----------------------------------------------------------------------}}
<?php $total_training = 0; ?>
@foreach ($training as $key => $trainings)
  <?php $total_training += $trainings->hours ?>
@endforeach

<?php $total_coaching = 0; ?>
@foreach ($coaching as $key => $coachings)
  <?php $total_coaching += $coachings->hours ?>
@endforeach

@foreach ($user as $users)
  @if ($users->starting_month != NULL)
    <?php $trainingprorate = number_format( (80/12*(13-$users->starting_month)), 2); ?>
  @else
    <?php $trainingprorate = NULL ?>
  @endif
@endforeach 

@foreach ($user as $users)
  @if ($users->starting_month != NULL)  
    <?php $coachingprorate = number_format( (15/12*(13-$users->starting_month)), 2); ?>
  @else
    <?php $coachingprorate = NULL ?>
  @endif
@endforeach

@section('content')
@include('layouts.navbars.auth.nav')
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
          <div class="container-fluid">      
            <div class="row">
              <div class="col-12">
                <div class="card bg-gradient-dark text-white shadow-blur mb-3">
                  <div class="card-body">
                    @foreach ($user as $data)
                      <span class="fw-bolder text-uppercase">{{ $data->name }}</span><br>
                      <span class="fst-italic">{{ $data->department }}</span><br>
                      <span class="fst-italic" style="font-size:15px">{{ $data->unit }}</span>
                    @endforeach  
                  </div>
                </div>
              </div>
            </div>

            @if (session('messagemonth'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('messagemonth') }}</strong>
              </div>	
            @endif

            {{-- START WORKING FORM (HR & ADMIN Only) -----------------------------------------------------------}}
            @if ((Auth::user()->role == "admin") ||  (Auth::user()->role == "hr") || ($user_id != NULL))
              <div class="row">
                <div class="col-md-12 mb-2">      
                  <div class="card">
                    <div class="card-body">

                      <form action="{{ url('employee/month/save/'.$user_id) }}" method="post">
                        @csrf  
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Start Working (Month)<span class="text-danger">*</span></label>
                            <div class="mb-0" class="@error('month') @enderror">
                              <select class="form-select" wire:model="month" name="month" id="month" tabindex="1" required>
                                @foreach ($user as $users)
                                <option selected class="bg-secondary text-white" value="{{ $users->starting_month }}" >
                                  @if ($users->starting_month == '1') 1 (January) 
                                  @elseif ($users->starting_month == '2') 2 (February) 
                                  @elseif ($users->starting_month == '3') 3 (March)
                                  @elseif ($users->starting_month == '4') 4 (April)
                                  @elseif ($users->starting_month == '5') 5 (May)
                                  @elseif ($users->starting_month == '6') 6 (June)
                                  @elseif ($users->starting_month == '7') 7 (July)
                                  @elseif ($users->starting_month == '8') 8 (August)
                                  @elseif ($users->starting_month == '9') 9 (September)
                                  @elseif ($users->starting_month == '10') 10 (October)
                                  @elseif ($users->starting_month == '11') 11 (November)
                                  @elseif ($users->starting_month == '12') 12 (December)
                                  @endif
                                </option>
                                @endforeach  
                                <option value="">-- Choose Months --</option>
                                <option value="1" >1 (January)</option>
                                <option value="2" >2 (February)</option> 
                                <option value="3" >3 (March)</option> 
                                <option value="4" >4 (April)</option>
                                <option value="5" >5 (May)</option>
                                <option value="6" >6 (June)</option>
                                <option value="7" >7 (July)</option>
                                <option value="8" >8 (August)</option>
                                <option value="9" >9 (September)</option>
                                <option value="10" >10 (October)</option>
                                <option value="11" >11 (November)</option>
                                <option value="12" >12 (December)</option>
                              </select>
                              @error('month') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                          </div>
                          <div class="col-md-6 my-auto text-end">
                            <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                          </div>
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            @endif

            {{-- COACHING History & Hours -----------------------------------------------------------}}
            <div class="row">
              <div class="col-md-12">
                @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('message') }}</strong>
                </div>	
                @endif

                @if (session('fail'))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('fail') }}</strong>
                  </div>	
                @endif
                
                <div class="card mb-2">
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">
                        @if ($total_coaching >= $coachingprorate)
                          <h6 class="mb-3">ALL COACHING HOURS <span style="color:green;">(Total hours = {{$total_coaching}}) </span><i class="bi bi-check2-circle"></i></h6>
                        @else
                          <h6 class="mb-3">ALL COACHING HOURS <span style="color:red;">(Total hours = {{$total_coaching}}) </span><i class="bi bi-x-circle"></i></h6>
                        @endif
                      </div>
                      <div class="col-md-6 text-end">
                        @if ($coachingprorate != NULL)
                          <h6 class="mb-3 fst-italic">(PRO RATE HOURS = {{$coachingprorate}})</span></h6>
                        @endif
                      </div>
                    </div>              
        
                    @if(!empty($coaching) && $coaching->count())
                      <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                          <thead class="text-center text-xxs fw-bolder">
                            <tr>
                              <th>NO</th>
                              <th>TITLE</th>
                              <th>DATE</th>
                              <th>HOURS</th>
                              @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                              <th class="col-2">ACTION</th>
                              @endif
                            </tr>
                          </thead>
        
                          <tbody>
                            @php($i = 1)
                            @foreach ($coaching as $key => $coachings)
                              <tr>
                                <td class="text-sm text-center">{{ $key + 1 }}</td>
                                <td class="text-xs fw-bold text-center">{{ $coachings->title }}</td>
                                <td class="text-xs text-center">{{ date('j F Y', strtotime($coachings->updated_at)) }}</td>
                                <td class="text-xs text-center">{{ $coachings->hours }}</td>

                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                                <td class="text-center mx-auto">
                                    <a href="{{ url('hr/edit/coaching/'.$coachings->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    {{-- <button type="button" wire:click="selectItem2({{$coachings->id}})" class="btn btn-danger btn-sm btn-icon data-delete1" data-form="{{$coachings->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button> --}}
                                    <button type="button" datax="{{$coachings->id}}" class="btn btn-danger btn-sm btn-icon data-delete1" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                    {{-- {{dd(data-form)}} --}}
                                </td>
                                @endif
                                
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
        
                      @else
                        <p class="text-center">There's No coaching Has Been Added.</p>
                      @endif
                  </div>
                </div>

              </div>
            </div>
        
            {{-- TRAINING History & Hours -----------------------------------------------------------}}
            <div class="row">
              <div class="col-md-12">
                
                <div class="card">
                  <div class="card-body">

                    <div class="row">
                      <div class="col-md-6">
                        @if ($total_training >= $trainingprorate)
                          <h6 class="mb-3">ALL TRAINING HOURS <span style="color:green;">(Total hours = {{$total_training}}) </span><i class="bi bi-check2-circle"></i></h6>
                        @else
                          <h6 class="mb-3">ALL TRAINING HOURS <span style="color:red;">(Total hours = {{$total_training}}) </span><i class="bi bi-x-circle"></i></h6>
                        @endif
                      </div>
                      <div class="col-md-6 text-end">
                        @if ($trainingprorate != NULL)
                          <h6 class="mb-3 fst-italic">(PRO RATE HOURS = {{$trainingprorate}})</span></h6>
                        @endif
                      </div>
                    </div>

                    @if(!empty($training) && $training->count())
                      <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                          <thead class="text-center text-xxs fw-bolder">
                            <tr>
                              <th>NO</th>
                              <th>TITLE</th>
                              <th>DATE</th>
                              <th>HOURS</th>
                              <th>TRAINER</th>
                              @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                              <th class="col-2">ACTION</th>
                              @endif
                            </tr>
                          </thead>

                          <tbody>
                            @php($i = 1)
                            @foreach ($training as $key => $trainings)
                              <tr>
                                <td class="text-sm text-center">{{ $key + 1 }}</td>
                                <td class="text-xs fw-bold text-center">{{ ucwords(strtolower($trainings->title)) }}</td>
                                <td class="text-xs text-center">{{ date('j F Y', strtotime($trainings->updated_at)) }}</td>
                                <td class="text-xs text-center">{{ $trainings->hours }}</td>
                                <td class="text-xs text-center">
                                  @if (is_numeric($trainings->trainer_id))
                                    {{ ucwords(strtolower($trainings->trainer->name)) }}
                                  @else
                                    {{ ucwords(strtolower($trainings->trainer_id))}}
                                  @endif
                                </td>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                                <td class="text-center mx-auto">
                                    <a href="{{ url('hr/edit/training/'.$trainings->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                    {{-- <button type="button" wire:click="selectItem1({{$trainings->id}})" data-id="{{$trainings->id}}" class="btn btn-danger btn-sm btn-icon data-delete2" data-form="{{$trainings->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button> --}}
                                    <button type="button" datax="{{$trainings->id}}" class="btn btn-danger btn-sm btn-icon data-delete2" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                </td>
                                @endif

                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      @else
                        <p class="text-center">There's No training Has Been Added.</p>
                      @endif
                  </div>
                </div>

              </div>
            </div>
          </div>

          @push('scripts')
            <script>
              document.addEventListener('livewire:load', function () {
                $(document).on("click", ".data-delete1", function (e) {
                  //IF NOT LOOPING CAN DO THIS BECAUSE IT WILL GET THE SAME ID
                  // var id = $('#id_deleted').attr('datax');

                  //IF LOOPING DO THIS INSTEAD BECAUSE IT WILL NOT GET THE SAME ID
                  var id = $(this).attr('datax');
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
                      location.href = "{{ url('/training-delete1') }}" + '/' + id;
                    } 
                  });
                });
              })

              document.addEventListener('livewire:load', function () {
                $(document).on("click", ".data-delete2", function (e) {
                  var id = $(this).attr('datax');
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
                        location.href = "{{ url('/training-delete2') }}" + '/' + id;
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