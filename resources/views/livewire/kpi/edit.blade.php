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
  @extends('layouts.app')
<div class="wrapper">
  <div id="content">
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

<div class="wrapper">
  <div id="content">
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

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-12 mb-lg-0 mb-4">

          @if ($status == 'Submitted' || $status == 'Signed By Manager' || $status == 'Completed') 
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning ! If you want to add, edit or delete any KPI, status of this KPI will set to default (Not Submitted)</strong>
          </div>
          @else
          @endif
          <div class="card mt-4">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                </div>
              </div>
            </div>
            <form action="{{ url('employee/update/kpi/'.$kpi->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post" enctype="multipart/form-data">
            @csrf  
            <div class="card-body p-3">
              <div class="row">
                  </form>  
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-4" class="@error('fungsi') border border-danger rounded-3 @enderror">
                    <label class="font-weight-bold" >Function</label>
                      <input type="text" class="form-control card card-body border border-radius-lg d-flex align-items-center flex-row" id="fungsi" name="fungsi" value="{{ $kpi->fungsi }}" readonly>
                    </select>
                    @error('fungsi') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4" id="buktiupload">
                    <div class="form-group">
                        <label class="control-label" style="font-weight:500">Upload Evidence (Optional)</label>
                        <div
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div wire:loading wire:target="bukti_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                            <input type="file" wire:model="bukti_path" id="bukti_path" name="bukti_path" class="dropify" />
                            @error('bukti_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="mb-4" class="@error('bukti') border border-danger rounded-3 @enderror">
                    <label class="font-weight-bold" >Evidence</label>
                      <textarea class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="bukti" id="bukti" cols="60" rows="10">{{ $kpi->bukti }}</textarea>
                      @error('bukti') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>

              </div>
              <div class="table-responsive">
                <table class="text-center">
                  <thead class="thead-dark">
                    <tr>
                      <th rowspan="2">(%)</th>
                      <th rowspan="2">Measurement</th>
                      <th colspan="3">KPI Targets</th>
                      <th rowspan="2">Achievement</th>
                      <th rowspan="2">KPI Score</th>
                      <th rowspan="2">Actual Score</th>
                    </tr>
                    <tr class="table table-bordered">
                      <th scope="col" >Threshold</th>
                      <th scope="col" >Base</th>
                      <th scope="col" >Stretch</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="font-weight-bold border-dark"  class="@error('peratus') border border-danger rounded-3 @enderror">
                        <input type="text" pattern="[0-9]+" maxlength="3" class="form-control" id="peratus" name="peratus" onkeyup="masterClac();" value="{{ $kpi->peratus }}" min="0"  >
                        @error('peratus') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>

                      <td style="word-break: break-all;" class="border-dark" class="@error('peratus') border border-danger rounded-3 @enderror">
                        <select class="form-select" id="ukuran" name="ukuran">
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
                        @error('ukuran') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>

                      <td class="border-dark" class="@error('threshold') border border-danger rounded-3 @enderror">
                        <input type="text" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="form-control" id="threshold" name="threshold" onkeyup="masterClac();" value="{{ $kpi->threshold }}" min="0" >
                        @error('threshold') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>
                
                      <td class="border-dark" class="@error('base') border border-danger rounded-3 @enderror">
                        <input type="text" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="form-control" id="base" name="base" onkeyup="masterClac();" value="{{ $kpi->base }}" min="0" >
                        @error('base') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>
                
                      <td class="border-dark" class="@error('stretch') border border-danger rounded-3 @enderror">
                        <input type="text" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="form-control" id="stretch" name="stretch" onkeyup="masterClac();" value="{{ $kpi->stretch }}" min="0" >
                        @error('stretch') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>
                
                      <td class="border-dark" class="@error('stretch') border border-danger rounded-3 @enderror">
                        <input type="text" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="form-control" id="pencapaian" name="pencapaian" onkeyup="masterClac();" value="{{ $kpi->pencapaian }}" min="0" >
                        @error('pencapaian') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>
                
                      <td class="border-dark" class="@error('skor_KPI') border border-danger rounded-3 @enderror">
                        <input type="text" class="form-control " id="skor_KPI" name="skor_KPI" value="{{ $kpi->skor_KPI }}" readonly>
                        @error('skor_KPI') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>
                
                      <td class="border-dark" class="@error('skor_sebenar') border border-danger rounded-3 @enderror">
                        <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="{{ $kpi->skor_sebenar }}" readonly>
                        @error('skor_sebenar') <div class="text-danger">{{ $message }}</div> @enderror
                      </td>

                    </tr>
                </tbody>
                </table>
              <div class="mt-2" style="text-align: right">
                <div class="col-12 text-end">
                  <button class="btn bg-gradient-dark mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;UPDATE</button>
                </div>
              </div>
            </form>  
            </div>  
            </div>
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
