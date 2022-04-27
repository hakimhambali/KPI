<div>
  <!-------------------------------- ADD DATE --------------------------------------------->
  <div class="container-fluid pb-4">
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
              <form action="{{ route('date_save') }}" method="post">
              @csrf  
                <div class="card-body">
                  <h6>CREATE NEW KPI</h6><hr>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Year<span class="text-danger">*</span></label>
                      <div class="mb-0" class="@error('year') @enderror">
                        <select class="form-select" wire:model="year" name="year" id="year" tabindex="1" required>
                          <option value="">-- Choose Years --</option>
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
  <!-------------------------- KPI History ----------------------------------------------------------------------------->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
        
        <div class="card">
          <div class="card-body">
            <h6 class="mb-3">KPI HISTORY</h6>
              @if(!empty($date) && $date->count())
              <div class="table-responsive">
                <table class="table table-hover table-sm align-middle">
                  <thead class="text-center text-xxs fw-bold">
                    <tr>
                      <th>YEAR</th>
                      <th>MONTH</th>
                      <th>ADD</th>
                      <th>VIEW</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>

                  <tbody>
                    @foreach ($date as $key => $dates)
                      <tr>
                        <td class="text-sm fw-bold text-center"><i class="bi bi-calendar-week-fill"></i> {{ $dates -> year }}</td>
                        <td class="text-sm fw-bold text-center">{{ $dates -> month }}</td>
                        <td class="text-center ">
                          <button class="btn bg-gradient-primary dropdown-toggle btn-sm px-3 my-auto" type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                              <span><i class="fa fa-edit"></i> Add</span>
                            </button>
                            <div class="dropdown-menu">
                              <a href="{{ url('employee/kpi/'.$dates->id.'/'.$dates->user_id.'/'.$dates->year.'/'.$dates->month) }}" class="dropdown-item text-dark fw-bold">EDIT KPI</a>
                              <a href="{{ url('employee/kecekapan/'.$dates->id.'/'.$dates->user_id.'/'.$dates->year.'/'.$dates->month) }}" class="dropdown-item text-dark fw-bold">EDIT KECEKAPAN</a>
                              <a href="{{ url('employee/nilai/'.$dates->id.'/'.$dates->user_id.'/'.$dates->year.'/'.$dates->month) }}" class="dropdown-item text-dark fw-bold">EDIT NILAI</a>
                            </div>
                        </td>
                        <td class="text-xs fw-bold text-center">
                          <a href="{{ url('employee/displaykpi/'.$dates->id.'/'.$dates->user_id.'/'.$dates->year.'/'.$dates->month) }}" type="button" class="btn bg-gradient-success btn-sm my-auto">KPI Master</a>
                        </td>
                        <td class="text-xs fw-bold text-center">
                          @if ($dates->status == "Not Submitted")
                            <span class="badge bg-gradient-secondary badge-sm">{{ $dates->status }}</span>
                          @elseif ($dates->status == "Submitted")
                            <span class="badge bg-gradient-info badge-sm">{{ $dates->status }}</span>
                          @elseif ($dates->status == "Signed By Manager")
                            <span class="badge bg-gradient-dark badge-sm">{{ $dates->status }}</span>
                          @elseif ($dates->status == "Completed")
                            <span class="badge bg-gradient-success badge-sm">{{ $dates->status }}</span>
                          @endif
                        </td>
                        <td class="text-center">
                          <a href="{{ url('employee/edit/date/'.$dates->id.'/'.$dates->user_id.'/'.$dates->year.'/'.$dates->month) }}" class="btn btn-dark btn-sm btn-icon my-auto" data-bs-toggle="tooltip" data-bs-original-title="Edit Date"><i class="bi bi-pencil-square"></i></a>
                          <button type="button" wire:click="selectItem({{$dates->id}}, 'delete' )" class="btn btn-danger btn-sm btn-icon my-auto data-delete" data-form="{{$dates->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete KPI"><i class="bi bi-trash3-fill"></i></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @else
                <p class="text-center">There's No KPI Has Been Added.</p>
              @endif
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