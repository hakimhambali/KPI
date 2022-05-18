{{--------------------------------------------------- EDIT KPI --------------------------------------------------}}
<style>
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

@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">
        @if (session('message'))
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Well done!</h4>
          {{ session('message') }}
        </div>	
        @endif

        @error('weightage')
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Alert!</h4>
          <span class="text-danger">Please check back your entered information</span>
        </div>
        @enderror

        <div class="row">
          <div class="col-md-12 mb-lg-0">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Well done!</h4>
              {{ session('message') }}
            </div>	
            @endif

            @error('weightage')
            <div class="alert alert-danger" role="alert">
              <h4 class="alert-heading">Alert!</h4>
              <span class="text-danger">Please check back your entered information</span>
            </div>
            @enderror

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
            <!---------------------- Create Function ---------------------------------------------------------->          
            <div class="card mb-4">
              <form action="{{ url('employee/update/kpi/'.$kpi->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month.'/'.$fungsikpi) }}" method="post" enctype="multipart/form-data">
              @csrf  
                <div class="card-body">
                  <h6>UPDATE FUNCTION</h6><hr>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Function<span class="text-danger">*</span></label>
                      <div class="mb-0" class="@error('fungsi') @enderror">
                        <select class="form-select" id="fungsi" name="fungsi" required>
                          <option selected class="bg-secondary text-white" value="{{ $kpi->fungsi }}" >{{ $kpi->fungsi }}</option>

                          @foreach ($function as $functions)
                            <option value="{{ $functions->name }}">{{ $functions->name }}</option>
                          @endforeach 

                        </select>
                        @error('fungsi') <div class="text-danger text-sm pt-2">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-md-6" id="buktiupload">
                      <div class="form-group">
                        <label class="form-label">Upload Evidence (Optional)</label>
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                          <div wire:loading wire:target="bukti_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                          <input type="file" wire:model="bukti_path" id="bukti_path" name="bukti_path" class="form-control bg-white border-white" />
                            @error('bukti_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                          <div x-show="isUploading"><progress max="100" x-bind:value="progress"></progress></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12 mb-3">
                    <label class="form-label">Evidence<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="bukti" id="bukti" rows="7" placeholder="Enter your evidence description here...">{!! $kpi->bukti !!}</textarea>
                    @error('bukti') <div class="text-danger text-sm pt-2">{{ $message }}</div> @enderror
                  </div>
                  
                  <div class="row mb-3">
                    <label class="form-label">Calculation<span class="text-danger">*</span></label>
                    <div class="table-responsive">
                      <table class="text-center text-sm">
                        <thead>
                          <tr>
                            <th rowspan="2">(%)</th>
                            <th rowspan="2">Measurement</th>
                            <th colspan="3">KPI Targets</th>
                            <th rowspan="2">Achievement</th>
                            <th rowspan="2">KPI Score</th>
                            <th rowspan="2">Actual Score</th>
                          </tr>
                          <tr>
                            <th>Threshold</th>
                            <th>Base</th>
                            <th>Stretch</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>
                              <input type="text" class="form-control input_ukuran" pattern="[0-9]+" maxlength="3" id="peratus" name="peratus" onkeyup="masterClac();" value="{{ $kpi->peratus }}" min="0"  >
                              @error('peratus') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td style="word-break: break-all;" class="border-dark">
                              <select class="form-select " id="ukuran" name="ukuran">
                                <option selected readonly value="{{ $kpi->ukuran }}">{{ $kpi->ukuran }}</option>
                                <option value="Unit">Unit</option>
                                <option value="Quantity" >Quantity</option>
                                <option value="Ratio" >Ratio</option>
                                <option value="Rating" >Rating</option>
                                <option value="Percentage (%)" >Percentage(%)</option>  
                                <option value="Date (number of days)"  >Date (number of days)</option> 
                                <option value="Hours" >Hours</option> 
                                <option value="RM (billion)" >RM (billion)</option>
                                <option value="RM (million)" >RM (million)</option> 
                                <option value="RM (*000)" >RM (*000)</option>
                              </select>
                              @error('ukuran') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_threshold" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="threshold" name="threshold" onkeyup="masterClac();" value="{{ $kpi->threshold }}" min="0" >
                              @error('threshold') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_base" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="base" name="base" onkeyup="masterClac();" value="{{ $kpi->base }}" min="0" >
                              @error('base') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_stretch" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="stretch" name="stretch" onkeyup="masterClac();" value="{{ $kpi->stretch }}" min="0" >
                              @error('stretch') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_pencapaian" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="pencapaian" name="pencapaian" onkeyup="masterClac();" value="{{ $kpi->pencapaian }}" min="0" >
                              @error('pencapaian') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control" id="skor_KPI" name="skor_KPI" value="{{ $kpi->skor_KPI }}" readonly>
                              @error('skor_KPI') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="{{ $kpi->skor_sebenar }}" readonly>
                              @error('skor_sebenar') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="col-12 text-end">
                    <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">UPDATE</button>
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
  <script src="{{asset('assets/js/master.js')}}"></script>
  <script src="{{url('assets/js/core/bootstrap.min.js')}}"></script>
@endsection