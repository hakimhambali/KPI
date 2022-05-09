<?php $total_training = 0; ?>
@foreach ($training as $key => $trainings)
<?php $total_training += $trainings->hours ?>
@endforeach
<?php $total_coaching = 0; ?>
@foreach ($coaching as $key => $coachings)
<?php $total_coaching += $coachings->hours ?>
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


        <div class="col-md-6 mb-3">
          <label class="form-label">Month<span class="text-danger">*</span></label>
          <div class="mb-0" class="@error('month') @enderror">
            <select class="form-select" wire:model="month" name="month" id="month" tabindex="1" required>
              <option value="">-- Choose Months --</option>
              <option value="January" >January</option>
              <option value="February" >February</option> 
              <option value="March" >March</option> 
              <option value="April" >April</option>
              <option value="May" >May</option>
              <option value="June" >June</option>
              <option value="July" >July</option>
              <option value="August" >August</option>
              <option value="September" >September</option>
              <option value="October" >October</option>
              <option value="November" >November</option>
              <option value="December" >December</option>
            </select>
            @error('month') <div class="text-danger">{{ $message }}</div> @enderror
          </div>
        </div>


      <div class="row">
        <div class="col-md-12">
          
          <div class="card">
            <div class="card-body">
              <h6 class="mb-3">ALL COACHING 2022 <span style="color:red;">(Total hours = {{$total_coaching}})</span></h6>
  
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
                            @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin'|| auth()->user()->department == 'Operation')
                              <a href="{{ url('hr/edit/coaching/'.$coachings->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                              {{-- <button type="button" wire:click="selectItem2({{$coachings->id}})" class="btn btn-danger btn-sm btn-icon data-delete1" data-form="{{$coachings->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button> --}}
                            @endif
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
                <h6 class="mb-3">ALL TRAINING 2022 <span style="color:red;">(Total hours = {{$total_training}})</span></h6>

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
                              @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin'|| auth()->user()->department == 'Operation')
                                <a href="{{ url('hr/edit/training/'.$trainings->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                {{-- <button type="button" wire:click="selectItem1({{$trainings->id}})" class="btn btn-danger btn-sm btn-icon data-delete2" data-form="{{$trainings->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button> --}}
                              @endif
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
                        Livewire.emit('delete1')
                    } 
                    });
                });
          })

          document.addEventListener('livewire:load', function () {
            $(document).on("click", ".data-delete2", function (e) 
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
                        Livewire.emit('delete2')
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