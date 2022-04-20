{{-- {{dd($weightage)}} --}}
{{-- {{dd($function)}} --}}
{{-- {{dd($kpiMasterArr)}} --}}
{{-- @foreach ($kpiArr as $key => $kpiArrs)
  @foreach ($kpiArrs as $key => $kpiArrss)
  {{($kpiArrss->fungsi)}}
  @endforeach
@endforeach

@foreach ($kpiMasterArr as $key => $kpiMasterArrs)
  @foreach ($kpiMasterArrs as $key => $item)
  {{($key)}}
  @endforeach
@endforeach --}}
{{--------------------------------------------------- CREATE KPI --------------------------------------------------}}
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

  <div class="container-fluid pb-4">
    <div class="row">
      <div class="col-lg-12">

        <!----------------------------------------------------------------------------------------------------->
        <div class="row">
          <div class="col-md-12 mb-lg-0">
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

            @if ($weightage_master > 100) 
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Your Percentage for KPI Master exceed 100%. Please check back.</strong>
              </div>
            @else
            @endif

            @if ($status == 'Submitted' || $status == 'Signed By Manager' || $status == 'Completed') 
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning ! If you want to add, edit or delete any KPI, status of this KPI will set to default (Not Submitted)</strong>
            </div>
            @else
            @endif
            <!---------------------- Create Function ---------------------------------------------------------->          
            <div class="card mb-4">
              <form action="{{ url('/employee/save/kpi/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post" enctype="multipart/form-data">
              @csrf  
                <div class="card-body">
                  @if ($weightage_master == 0 || $weightage_master == NULL) 
                    <h6>SCORE CARD - CREATE FUNCTION <span style="color:red;">(Current total weightage = 0)</span></h6><hr>
                  @else
                    <h6>SCORE CARD - CREATE FUNCTION <span style="color:red;">(Current total weightage = {{$weightage_master}})</span></h6><hr>
                  @endif

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Function<span class="text-danger">*</span></label>
                      <div class="mb-0" class="@error('fungsi') @enderror">
                        <select class="form-select" id="fungsi" name="fungsi" required>
                          <option value="">-- Choose Function --</option>

                          @foreach ($function as $functions)
                            <option value="{{$functions->name}}">{{$functions->name}}</option>
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
                    <textarea class="form-control" name="bukti" id="bukti" rows="7" placeholder="Enter your evidence description here..."></textarea>
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
                              <input type="text" class="form-control input_ukuran" pattern="[0-9]+" maxlength="3" id="peratus" name="peratus" onkeyup="masterClac();" min="0"  >
                              @error('peratus') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td style="word-break: break-all;" class="border-dark">
                              <select class="form-select " id="ukuran" name="ukuran">
                                <option selected disabled value=""></option>
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
                              <input type="text" class="form-control input_threshold" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="threshold" name="threshold" onkeyup="masterClac();" min="0" >
                              @error('threshold') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_base" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="base" name="base" onkeyup="masterClac();" min="0" >
                              @error('base') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_stretch" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="stretch" name="stretch" onkeyup="masterClac();" min="0" >
                              @error('stretch') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control input_pencapaian" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" id="pencapaian" name="pencapaian" onkeyup="masterClac();" min="0" >
                              @error('pencapaian') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text" class="form-control" id="skor_KPI" name="skor_KPI" value="0" readonly>
                              @error('skor_KPI') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                            <td>
                              <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="0" readonly>
                              @error('skor_sebenar') <div class="text-danger text-xs pt-2">{{ $message }}</div> @enderror
                            </td>
                          </tr>
                        </tbody>
                      </table>
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

  {{--------------------------------------------------- TEST JANGAN KACAU --------------------------------------------------}}
  @foreach ($kpiMasterArr as $key1 => $kpiMasterArrs)
  @foreach ($kpiMasterArrs as $key2 => $kpiMasterArrss)
  <div class="row">
    <div class="col-md-12">
      
      <div class="card mb-4">
        <div class="card-body">
          <?php $total_weightage = 0; ?>
          @foreach ($kpiArr as $key3 => $kpiArrs)
            @foreach ($kpiArrs as $key4 => $kpiArrss)
              @foreach ($function as $key5 => $functions)
              @if($kpiMasterArrss->fungsi == $functions->name)
              @if($kpiArrss->fungsi == $functions->name)
              <?php $total_weightage += $kpiArrss->peratus; ?>
              @endif
              @endif
              @endforeach
            @endforeach
          @endforeach
           @if ($total_weightage == 0 || $total_weightage == NULL)
             <h6 class="mb-3">{{$kpiMasterArrss->fungsi}} <span style="color:red;">(Current weightage = 0)</span></h6>
           @else
             <h6 class="mb-3">{{$kpiMasterArrss->fungsi}} <span style="color:red;">(Current weightage = {{$total_weightage}})</span></h6>
           @endif
          
          <div class="table-responsive">
            <table class="table table-hover table-sm align-middle">
              <thead class="text-center text-xxs fw-bold">
                <tr>
                  <th>NO</th>
                  <th>EVIDENCE</th>
                  <th>EVIDENCE FILE</th>
                  <th>%</th>
                  <th>MEASUREMENT</th>
                  <th>KPI TARGET</th>
                  <th>KPI SCORE</th>
                  <th>ACTUAL SCORE</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($kpiArr as $key3 => $kpiArrs)
                  @foreach ($kpiArrs as $key4 => $kpiArrss)
                    @foreach ($function as $key5 => $functions)
                  @if($kpiMasterArrss->fungsi == $functions->name)
                  @if($kpiArrss->fungsi == $functions->name)
                  <tr>
                    <td class="text-sm text-center">{{$key4 + 1}}</td>
                    <td class="text-xs">{!! nl2br($kpiArrss -> bukti) !!}</td>
                    <td class="text-sm text-center">
                      @if ($kpiArrss->bukti_path == '')
                      @else
                      <a href="{{  $kpiArrss->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                      @endif
                    </td>
                    <td class="text-sm text-center">{{ $kpiArrss -> peratus }}</td>
                    <td class="text-sm text-center">{{ $kpiArrss -> ukuran }}</td>
                    <td class="mx-auto">
                      <span class="me-2 text-xs fw-bolder" value="{{ $kpiArrss -> pencapaian }}">{{ number_format( (integer)($kpiArrss->skor_KPI)) }}%</span>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kpiArrss->skor_KPI }}%;"></div>
                      </div>
                    </td>
                    <td class="text-sm text-center">{{ $kpiArrss -> skor_KPI }}</td>
                    <td class="text-sm text-center">{{ round($kpiArrss -> skor_sebenar,2) }} %</td>
                    <td class="text-center">
                      <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu">
                        <a href="{{ url('employee/edit/kpi/'.$kpiArrss->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                        <button type="button" wire:click="selectItem({{$kpiArrss->kpimasters->kpiall->id}} , {{$kpiArrss->kpimasters->id}} , {{$kpiArrss->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kpiArrss->id}}">DELETE</a>
                      </div>
                    </td>
                  </tr>
                  @endif
                  @endif
                    @endforeach
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </div>


          <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
            <div class="row">
              <div class="col-9 lh-1">
                <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                <hr>
              </div>

              <div class="col-3 text-end">
                <a href="{{ url('employee/edit/kpimaster/'.$kpiMasterArrss->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kpiMasterArrss -> percent_master }}</b></span><br>
                
                @if ($kpiMasterArrss->link != '')
                  @php $links = json_decode($kpiMasterArrss->link); @endphp
                  
                  @if ($links != NULL)
                    @if ($links[0] != NULL)
                      @if ($links[0] == NULL)
                        <?php $num_of_link=0 ?>
                      @elseif ($links[1] == NULL)
                        <?php $num_of_link=1 ?>
                      @elseif ($links[2] == NULL)
                        <?php $num_of_link=2 ?>
                      @elseif ($links[3] == NULL)
                        <?php $num_of_link=3 ?>
                      @elseif ($links[4] == NULL)
                        <?php $num_of_link=4 ?>
                      @elseif ($links[4] != NULL)
                        <?php $num_of_link=5 ?>
                      @endif

                      @for($i=0 ; $i<$num_of_link; $i++)
                        <span class="mb-2 text-xs">Evidence Link {{$i+1}}:<span class="text-dark ms-sm-1 font-weight-bold">
                        <a href=" {{ $links[$i] }}" style="color:blue;text-decoration:underline;" target="_blank">{{ $links[$i] }}</a>
                        </span></span><br>
                      @endfor
                    @else
                      <span class="mb-2 text-xs">Evidence Link 1:<span class="text-dark ms-sm-1 font-weight-bold">
                      <a style="color:blue;text-decoration:underline;font-size:13.5px" target="_blank"></a>
                      </span></span><br>
                    @endif
                  @else
                    <span class="mb-2 text-xs">Evidence Link 1:<span class="text-dark ms-sm-1 font-weight-bold">
                    <a style="color:blue;text-decoration:underline;font-size:13.5px" target="_blank"></a>
                    </span></span><br>
                  @endif
                  
                @else
                  <span class="mb-2 text-xs">Evidence Link 1:<span class="text-dark ms-sm-1 font-weight-bold">
                  <a style="color:blue;text-decoration:underline;font-size:13.5px" target="_blank"></a>
                  </span></span><br>
                @endif

                <span class="mb-2 text-xs">KPI Objective : <b>{{ $kpiMasterArrss -> objektif }}</b></span>
              </div>
            </div>
          </div>

            
        </div>
      </div>

    </div>
  </div>
  @endforeach
  @endforeach

</div>
</div>
</div>

 @push('scripts')
    
    {{-- START SECTION - SCRIPT FOR DELETE BUTTON  --}}
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
    {{-- END SECTION - SCRIPT FOR DELETE BUTTON  --}}
    
    @endpush
 <!-- Master Pencapaian JS -->
<script src="{{asset('assets/js/master.js')}}"></script>

</body>
</div>			