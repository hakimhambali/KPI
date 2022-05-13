{{--------------------------------------------------- EDIT NILAI (MANAGER) --------------------------------------------------}}
@section('content')
<div>
  @extends('layouts.app')

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-12">

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

        {{---------------------------------------------------- manager update nilai -------------------------------------------}}
        <div class="card">
          <form action="{{ url('/manager/update/nilai/'.$user->id.'/'.$nilai->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
            @csrf  
            <div class="card-body">
              <h6>INSERT NILAI TERAS</h6><hr>

              <div class="col-md-12 mb-3">
                <input type="text" class="form-control " id="nilai_teras" name="nilai_teras" value="{{ $nilai->nilai_teras }}" readonly>
              </div>

              <div class="row mb-3">
                <div class="col-md-12 mx-auto">

                  <div class="table-responsive">
                    <table class="text-center text-sm" style="width: 100%">
                      <thead>
                        <tr>
                          <th>(%)</th>
                          <th>Measurement</th>
                          <th>Manager Score <span class="text-danger">*</span></th>
                          <th>Actual Score</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td><input type="text" class="form-control" id="peratus" name="peratus" value="20" onkeyup="masterClac();" min="0" readonly></td>
                          <td><input type="text" class="form-control" id="ukuran" name="ukuran" value="Percentage" readonly></td>
                          <td>
                            <input type="number" min="1" max="4" class="form-control" id="skor_penyelia" name="skor_penyelia" onkeyup="masterClac();" value="{{ $nilai->skor_penyelia }}" placeholder="Enter score from 1 to 4 only" required>
                            @error('skor_penyelia') <div class="text-danger">{{ $message }}</div> @enderror
                          </td>
                          <td><input type="text" class="form-control" id="skor_sebenar" name="skor_sebenar" value="{{ $nilai->skor_sebenar }}" readonly></td>
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
{{------------------------------------------------- End Testing -------------------------------------------------}}
   <!-- Calculation JS -->
  <script src="{{asset('assets/js/nilai.js')}}"></script>

</div>
@endsection
