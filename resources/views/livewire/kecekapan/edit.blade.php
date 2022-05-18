{{--------------------------------------------------- EDIT KECEKAPAN (ALL USER) --------------------------------------------------}}
@section('content')
@include('layouts.navbars.auth.nav')
<div>
  @extends('layouts.app')

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">
        
        @if ($status == 'Submitted' || $status == 'Signed By Manager' || $status == 'Completed') 
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning ! If you want to add, edit or delete any KPI, status of this KPI will set to default (Not Submitted)</strong>
          </div>
        @else
        @endif

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
          <form action="{{ url('employee/update/kecekapan/'.$kecekapan->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
          @csrf  
            <div class="card-body">
              <h6>UPDATE KECEKAPAN TERAS</h6><hr>

              <div class="col-md-12 mb-3">
                <input type="text" class="form-control" id="kecekapan_teras" name="kecekapan_teras" value="{{ $kecekapan->kecekapan_teras }}" readonly>
              </div>

              <div class="row mb-3">
                <div class="col-md-12 mx-auto">

                  <div class="table-responsive">
                    <table class="text-center text-sm" style="width: 100%">
                      <thead>
                        <tr>
                          <th class="col-2">(%)</th>
                          <th>Measurement</th>
                          <th class="col-md-3">Employee Score <span class="text-danger">*</span></th>
                          <th>Actual Score</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control" id="peratus" name="peratus" value="20" onkeyup="masterClac();" readonly></td>
                          <td><input type="text"  class="form-control" id="ukuran" name="ukuran" value="Percentage" readonly></td>
                          <td>
                            <input type="number" class="form-control " id="skor_pekerja" name="skor_pekerja" value="{{ $kecekapan->skor_pekerja }}" min="1" max="4" placeholder="Enter score from 1 to 4 only" required>
                            @error('skor_pekerja') <div class="text-danger">{{ $message }}</div> @enderror
                          </td>
                          <td class="font-weight-bold border-dark">
                            <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="{{ $kecekapan->skor_sebenar }}" readonly>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
  <!-- Calculation JS -->
  <script src="{{asset('assets/js/kecekapan.js')}}"></script>

  </div>
@endsection
