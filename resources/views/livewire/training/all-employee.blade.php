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
        <div class="col-12">
          <div class="card bg-gradient-dark text-white shadow-blur mb-4">
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
          
          <div class="card">
            <div class="card-body">
            @if ($coachingprorate != NULL)
            <h6 class="mb-3">COACHING PRO RATE <span style="color:black;">(Total hours = {{$coachingprorate}})</span></h6>
            @endif
            @if ($total_coaching >= $coachingprorate)
            <h6 class="mb-3">ALL COACHING HOURS <span style="color:green;">(Total hours = {{$total_coaching}}) </span><i class="bi bi-check2-circle"></i></h6>
            @else
            <h6 class="mb-3">ALL COACHING HOURS <span style="color:red;">(Total hours = {{$total_coaching}}) </span><i class="bi bi-x-circle"></i></h6>
            @endif
  
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
    </div>

    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card">
                <div class="card-body">
                  @if ($trainingprorate != NULL)
                  <h6 class="mb-3">TRAINING PRO RATE <span style="color:black;">(Total hours = {{$trainingprorate}})</span></h6>
                  @endif
                  @if ($total_training >= $trainingprorate)
                  <h6 class="mb-3">ALL TRAINING HOURS <span style="color:green;">(Total hours = {{$total_training}}) </span><i class="bi bi-check2-circle"></i></h6>
                  @else
                  <h6 class="mb-3">ALL TRAINING HOURS <span style="color:red;">(Total hours = {{$total_training}}) </span><i class="bi bi-x-circle"></i></h6>
                  @endif

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
            $(document).on("click", ".data-delete1", function (e) 
                {
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
            $(document).on("click", ".data-delete2", function (e) 
                {
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