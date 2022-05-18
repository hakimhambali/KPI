{{--------------------------------------------------- EDIT KPI MASTER(EMPLOYEE) --------------------------------------------------}}
@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">

        <div class="row">
          <div class="col-md-12 mb-lg-0">
            @if (session('message'))
              <div class="alert alert-success alert-dismissible">
                  <strong>{{ session('message') }}</strong>
              </div>	
            @endif 
            @if ($status == 'Submitted' || $status == 'Signed By Manager' || $status == 'Completed') 
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning ! If you want to add, edit or delete any KPI, status of this KPI will set to default (Not Submitted)</strong>
              </div>
            @else
            @endif

            <div class="card mb-4">
              <form action="{{ url('employee/update/kpimaster/'.$kpimasters->id.'/'.$fungsi.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post"> 
              @csrf  
                <div class="card-body">
                  <h6 class="text-uppercase">UPDATE KPI MASTER - {{ $fungsi }}</h6><hr>

                  <div class="row">
                    <div class="col-md-6">
                      <label class="form-label">Objective KPI<span class="text-danger">*</span></label>
                      <textarea class="form-control mb-3" name="objektif" id="objektif" rows="10" placeholder="Enter your objective KPI...">{!! $kpimasters->objektif !!}</textarea>
                      @error('objektif') <div class="text-danger">{{ $message }}</div> @enderror

                      <label class="form-label">KPI Master Percentage (%)<span class="text-danger">*</span></label>
                      <input type="number" min="1" max="100" class="form-control mb-3" id="percent_master" name="percent_master" value="{{ $kpimasters->percent_master }}" placeholder="Enter any number from 1 to 100 only" required>
                      @error('percent_master') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                
                    @if ($kpimasters->link != '')
                      <div class="col-md-6">
                        @php $links = json_decode($kpimasters->link); @endphp
                        <label class="form-label">Evidence Link (Leave blank if does not have any evidence)</label>
                        <label class="form-label"><span class="text-danger">*</span>Please insert in order, do not skip numbering</label><br>
                      
                        <label class="form-label">Evidence Link 1</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]" value="@if($links != NULL) {{($links[0])}} @endif">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror

                        <label class="form-label">Evidence Link 2</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]" value="@if($links != NULL) {{($links[1])}} @endif">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 3</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]" value="@if($links != NULL) {{($links[2])}} @endif">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 4</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]" value="@if($links != NULL) {{($links[3])}} @endif">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 5</label>
                        <input type="text" class="form-control mb-3" id="link" name="link[]" value="@if($links != NULL) {{($links[4])}} @endif">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror 
                      </div>
                    @else
                      <div class="col-md-6">
                        <label class="form-label">Evidence Link (Leave blank if does not have any evidence)</label><br>

                        <label class="form-label">Evidence Link 1</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 2</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 3</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 4</label>
                        <input type="text" class="form-control mb-1" id="link" name="link[]">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <label class="form-label">Evidence Link 5</label>
                        <input type="text" class="form-control mb-3" id="link" name="link[]">
                        @error('link') <div class="text-danger">{{ $message }}</div> @enderror 
                      </div>
                    @endif
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

@endsection