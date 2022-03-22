{{--------------------------------------------------- EDIT NILAI (ALL USER) --------------------------------------------------}}
@section('content')
<div>
  @extends('layouts.app')
<body>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">

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
      <div class="card mt-">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-12 text-end">
              <form action="{{ url('employee/update/nilai/'.$nilai->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post">
            </div>
          </div>
        </div>
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6 mb-md-0 mb-4">
              @csrf 
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4" class="@error('fungsi') border border-danger rounded-3 @enderror">
                    <td class="font-weight-bold border-dark">
                      <label class="font-weight-bold" >Nilai Teras</label>
                      <input type="text" class="form-control " id="nilai_teras" name="nilai_teras" value="{{ $nilai->nilai_teras }}" readonly>
                    </td>
                    @error('fungsi') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row m-auto">
            <div>
              <table class="text-center" style="width: 100%;">
                <thead class="thead-dark">
                  <tr>
                    <th rowspan="2">Peratus (%)</th>
                    <th rowspan="2">Measurement</th>
                    {{-- @if ((Auth::user()->role == "employee") || (Auth::user()->role == "pro") || (Auth::user()->role == "dc") || (Auth::user()->role == "admin")) --}}
                    <th rowspan="2">Employee Score</th>
                    {{-- @else
                    @endif --}}

                    {{-- @if ((Auth::user()->role == "manager") || (Auth::user()->role == "admin"))
                    <th rowspan="2">Manager Score</th>
                    @else
                    @endif --}}
                    <th rowspan="2">Actual Score</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control" id="peratus" name="peratus" value="20" onkeyup="masterClac();" min="0" selected readonly>
                    </td>

                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control" id="ukuran" name="ukuran" value="Percentage" selected readonly>
                    </td>

                    {{-- @if ((Auth::user()->role == "employee") || (Auth::user()->role == "pro") || (Auth::user()->role == "dc") || (Auth::user()->role == "admin")) --}}
                    <td style="word-break: break-all;" class="border-dark" class="@error('skor_pekerja') border border-danger rounded-3 @enderror">
                      <input type="text" class="form-control " pattern="[1-4]+" maxlength="1" id="skor_pekerja" name="skor_pekerja" value="{{ $nilai->skor_pekerja }}">
                      @error('skor_pekerja') <div class="text-danger">{{ $message }}</div> @enderror
                    </td>
                    {{-- @else
                    @endif --}}

                    {{-- @if ((Auth::user()->role == "manager") || (Auth::user()->role == "admin"))
                    <td style="word-break: break-all;" class="border-dark" class="@error('skor_penyelia') border border-danger rounded-3 @enderror">
                      <input type="text" pattern="[1-4]+" maxlength="1"  class="form-control" id="skor_penyelia" name="skor_penyelia" value="{{ $nilai->skor_pekerja }}" onkeyup="masterClac();" min="0" >
                      @error('skor_penyelia') <div class="text-danger">{{ $message }}</div> @enderror
                    </td>
                    @else
                    @endif --}}

                    <td class="font-weight-bold border-dark">
                      <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="{{ $nilai->skor_sebenar }}" readonly>
                    </td>

                  </tr>
                </tbody>
              </table>
              <div class="col-12 text-end mt-4">
                <button type="submit" class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Save</button>
              </div>
            </div>
          </form>  
        </div>
      </div>
    </div>
  </div>
</div>  
</div>
   <!-- Calculation JS -->
    <script src="{{asset('assets/js/nilai.js')}}"></script>

  </body>

</div>
@endsection