{{--------------------------------------------------- EDIT DATE --------------------------------------------------}}
<div>
@section('content')
  @extends('layouts.app')
    <div class="wrapper">
      <div id="content">    
          
        <div class="container-fluid py-4">
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

              <div class="alert alert-warning alert-dismissible fade show alert-sm" role="alert">
                <strong>Warning ! If you want to edit date, status of this KPI will set to default (Not Submitted)</strong>
              </div>	

              <form action="{{ url('employee/update/date/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post"> 
              @csrf
                <div class="card">
                  <div class="card-body">
                    <h6>UPDATE KPI DATE</h6><hr>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Year<span class="text-danger">*</span></label>
                        <div class="mb-0" class="@error('year') @enderror">
                          <select class="form-select" wire:model="year" name="year" id="year" tabindex="1">
                            <option selected value="{{$year}}">{{ $year }}</option>
                            <?php $yearArray = range(2021, 2050); ?>
                            <?php
                                foreach ($yearArray as $year) {
                                  echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            ?>
                          </select>
                          @error('year') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Month<span class="text-danger">*</span></label>
                        <div class="mb-0" class="@error('month') @enderror">
                          <select class="form-select" wire:model="month" name="month" id="month" tabindex="1">
                            <option selected value="{{$month}}">{{ $month }}</option>
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
                    </div>

                    <div class="row">
                      <div class="col-6">
                          <a class="btn bg-gradient-danger btn-sm" href="{{ route('add-date') }}" title="Previous Page"><i class="bi bi-caret-left-fill"></i></a>
                      </div>
                      <div class="col-6 text-end">
                          <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">UPDATE</button>
                      </div>
                    </div>

                  </div>
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
    @endsection
  </div>