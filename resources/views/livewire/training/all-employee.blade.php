{{-- View TRAINING & COACHING (EMPLOYEE) -----------------------------------------------------------------------}}
<?php $total_training = 0; ?>
@foreach ($training as $key => $trainings)
  <?php $total_training += $trainings->hours ?>
@endforeach

<?php $total_coaching = 0; ?>
@foreach ($coaching as $key => $coachings)
  <?php $total_coaching += $coachings->hours ?>
@endforeach

@foreach ( $user as $users )
  @if ( $users->starting_month != NULL )

    @if ($selectYear == '')
      @if ( $thisyear > date('Y', strtotime($users->starting_month)) )
        <?php $trainingprorate = 80; ?>
      @else
        <?php $month = date('n', strtotime($users->starting_month)); ?>
        <?php $trainingprorate = number_format( (80/12*(13-$month)), 2); ?>
      @endif
      
    @else
      @if ( $selectYear > date('Y', strtotime($users->starting_month)) )
        <?php $trainingprorate = 80; ?>
      @elseif ( $selectYear < date('Y', strtotime($users->starting_month)) )
        <?php $trainingprorate = NULL ?>
      @else
        <?php $month = date('n', strtotime($users->starting_month)); ?>
        <?php $trainingprorate = number_format( (80/12*(13-$month)), 2); ?>
      @endif
    @endif

  @else
    <?php $trainingprorate = NULL ?>
  @endif
@endforeach 

@foreach ($user as $users)
  @if ($users->starting_month != NULL)

    @if ($selectYear == '')
      @if ( $thisyear > date('Y', strtotime($users->starting_month)) )
        <?php $coachingprorate = 15; ?>
      @else 
        <?php $month = date('n', strtotime($users->starting_month)); ?>
        <?php $coachingprorate = number_format( (15/12*(13-$month)), 2); ?>
      @endif

    @else
      @if ( $selectYear > date('Y', strtotime($users->starting_month)) )
        <?php $coachingprorate = 15; ?>
      @elseif ( $selectYear < date('Y', strtotime($users->starting_month)) )
        <?php $coachingprorate = NULL ?>
      @else 
        <?php $month = date('n', strtotime($users->starting_month)); ?>
        <?php $coachingprorate = number_format( (15/12*(13-$month)), 2); ?>
      @endif
    @endif

  @else
    <?php $coachingprorate = NULL ?>
  @endif
@endforeach

@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')
  <div>  
    <body>

      <div class="container-fluid pb-4">
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-secondary mb-2">
              
              <form action="{{ route('view-hours') }}" method="GET">
                <div class="row">
                  <div class="col-3">
                    @if ($selectYear == '')
                      <h4 class="fw-bolder text-end">{{ $thisyear }}</h4>
                    @else
                      <h4 class="fw-bolder text-end">{{ $selectYear }}</h4>
                    @endif
                    
                  </div>

                  <div class="col-7">
                    <select name="year" class="form-select form-select-sm  my-auto">
                      @if ($selectYear == '')
                        <option value="">-- Select Year --</option>
                      @else
                        <option selected value="{{$selectYear}}" class="bg-gray">{{ $selectYear }}</option>
                      @endif
                      <?php $yearArray = range(2014, 2050); ?>
                      <?php
                          foreach ($yearArray as $year) {
                            echo '<option value="'.$year.'">'.$year.'</option>';
                          }
                      ?>
                    </select>
                  </div>

                  <div class="col-1">
                    <button class="btn btn-icon btn-sm btn-success  my-auto">
                      <span class="fas fa-search"></span>
                    </button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>

        {{-- All COACHING Hours -----------------------------------------------------------------------}}
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
                            <th class="col-1">ACTION</th>
                          @endif
                        </tr>
                      </thead>
    
                      <tbody>
                        @php($i = 1)
                        @foreach ($coaching as $key => $coachings)
                          <tr>
                            <td class="text-sm text-center">{{ $key + 1 }}</td>
                            <td class="text-xs fw-bold text-center">{{ $coachings->title }}</td>
                            <td class="text-xs text-center">{{ date('j F Y', strtotime($coachings->date)) }}</td>
                            <td class="text-xs text-center">{{ $coachings->hours }}</td>
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                              <td class="text-center mx-auto">
                                <a href="{{ url('hr/edit/coaching/'.$coachings->id) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" datax="{{$coachings->id}}" class="btn btn-danger btn-sm btn-icon data-delete1 my-auto" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
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

        {{-- All TRAINING Hours -----------------------------------------------------------------------}}
        <div class="row">
          <div class="col-md-12">
            
            <div class="card mb-4">
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
                    <table class="table table-hover table-sm ">
                      <thead class="text-center text-xxs fw-bolder">
                        <tr>
                          <th>NO</th>
                          <th>TITLE</th>
                          <th>DATE</th>
                          <th>HOURS</th>
                          <th>TRAINER</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                            <th class="col-1">ACTION</th>
                          @endif
                        </tr>
                      </thead>

                      <tbody>
                        @php($i = 1)
                        @foreach ($training as $key => $trainings)
                          <tr>
                            <td class="text-sm text-center">{{ $key + 1 }}</td>
                            <td class="text-xs fw-bold text-center">{{ ucwords(strtolower($trainings->title)) }}</td>
                            <td class="text-xs text-center">{{ date('j F Y', strtotime($trainings->date)) }}</td>
                            <td class="text-xs text-center">{{ $trainings->hours }}</td>
                            <td class="text-xs text-center">
                              @if (is_numeric($trainings->trainer_id))
                                {{ ucwords(strtolower($trainings->trainer->name)) }}
                              @else
                                {{ ucwords(strtolower($trainings->trainer_id))}}
                              @endif
                            </td>
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                              <td class="text-center mx-auto my-auto">
                                <a href="{{ url('hr/edit/training/'.$trainings->id) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" datax="{{$trainings->id}}" class="btn btn-danger btn-sm btn-icon data-delete2 my-auto" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
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
@endsection