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

  {{--------------------------------------------------- KADSKOR FUNGSI NEW --------------------------------------------------}}
  @if ($kadskorcount == 0) 
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kadskor == 0 || $weightage_kadskor == NULL)
              <h6 class="mb-3">KAD SKOR KORPORAT1 <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KAD SKOR KORPORAT1 <span style="color:red;">(Current weightage = {{$weightage_kadskor}})</span></h6>
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
                  @foreach ($kadskor as $key => $kadskors)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kadskors -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kadskors->bukti_path == '')
                        @else
                        <a href="{{  $kadskors->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kadskors -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kadskors -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kadskors -> pencapaian }}">{{ number_format( (integer)($kadskors->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kadskors->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kadskors -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kadskors -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kadskors->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kadskors->kpimasters->kpiall->id}} , {{$kadskors->kpimasters->id}} , {{$kadskors->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kadskors->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kadskormaster as $kadskormasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster1/'.$kadskormasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kadskormasters -> percent_master }}</b></span><br>
                  
                  @if ($kadskormasters->link != '')
                    @php $links = json_decode($kadskormasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kadskormasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 1 FUNGSI --------------------------------------------------}}
  @if ($kewangan1count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan1 == 0 || $weightage_kewangan1 == NULL)
              <h6 class="mb-3">KEWANGAN (1) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (1) <span style="color:red;">(Current weightage = {{$weightage_kewangan1}})</span></h6>
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
                  @foreach ($kewangan1 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan1master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster2/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 2 FUNGSI --------------------------------------------------}}
  @if ($kewangan2count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan2 == 0 || $weightage_kewangan2 == NULL)
              <h6 class="mb-3">KEWANGAN (2) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (2) <span style="color:red;">(Current weightage = {{$weightage_kewangan2}})</span></h6>
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
                  @foreach ($kewangan2 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan2master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster13/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 3 FUNGSI --------------------------------------------------}}
  @if ($kewangan3count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan3 == 0 || $weightage_kewangan3 == NULL)
              <h6 class="mb-3">KEWANGAN (3) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (3) <span style="color:red;">(Current weightage = {{$weightage_kewangan3}})</span></h6>
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
                  @foreach ($kewangan3 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan3master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster14/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 4 FUNGSI --------------------------------------------------}}
  @if ($kewangan4count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan4 == 0 || $weightage_kewangan4 == NULL)
              <h6 class="mb-3">KEWANGAN (4) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (4) <span style="color:red;">(Current weightage = {{$weightage_kewangan4}})</span></h6>
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
                  @foreach ($kewangan4 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan4master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster15/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 5 FUNGSI --------------------------------------------------}}
  @if ($kewangan5count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan5 == 0 || $weightage_kewangan5 == NULL)
              <h6 class="mb-3">KEWANGAN (5) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (5) <span style="color:red;">(Current weightage = {{$weightage_kewangan5}})</span></h6>
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
                  @foreach ($kewangan5 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan5master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster16/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KEWANGAN 6 FUNGSI --------------------------------------------------}}
  @if ($kewangan6count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kewangan6 == 0 || $weightage_kewangan6 == NULL)
              <h6 class="mb-3">KEWANGAN (6) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">KEWANGAN (6) <span style="color:red;">(Current weightage = {{$weightage_kewangan6}})</span></h6>
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
                  @foreach ($kewangan6 as $key => $kewangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kewangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kewangans->bukti_path == '')
                        @else
                        <a href="{{ $kewangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kewangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kewangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kewangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kewangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kewangan6master as $kewanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster17/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kewanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kewanganmasters->link != '')
                    @php $links = json_decode($kewanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kewanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- PELANGGAN INTERNAL FUNGSI --------------------------------------------------}}
  @if ($pelangganIn1count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_pelangganIn1 == 0 || $weightage_pelangganIn1 == NULL)
              <h6 class="mb-3">PELANGGAN1 (INTERNAL) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">PELANGGAN1 (INTERNAL) <span style="color:red;">(Current weightage = {{$weightage_pelangganIn1}})</span></h6>
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
                  @foreach ($pelangganIn1 as $key => $pelangganIn1s)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($pelangganIn1s -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($pelangganIn1s->bukti_path == '')
                        @else
                        <a href="{{ $pelangganIn1s->bukti_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $pelangganIn1s -> peratus }}</td>
                      <td class="text-sm text-center">{{ $pelangganIn1s -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $pelangganIn1s -> pencapaian }}">{{ number_format( (integer)($pelangganIn1s->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pelangganIn1s->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $pelangganIn1s -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($pelangganIn1s -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$pelangganIn1s->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$pelangganIn1s->kpimasters->kpiall->id}} , {{$pelangganIn1s->kpimasters->id}} , {{$pelangganIn1s->id}})" class="dropdown-item text-danger data-delete" data-form="{{$pelangganIn1s->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($pelangganIn1master as $pelangganIn1masters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster3/'.$pelangganIn1masters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $pelangganIn1masters -> percent_master }}</b></span><br>
                  
                  @if ($pelangganIn1masters->link != '')
                    @php $links = json_decode($pelangganIn1masters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $pelangganIn1masters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- PELANGGAN EXTERNAL FUNGSI --------------------------------------------------}}
  @if ($pelangganEx1count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_pelangganEx1 == 0 || $weightage_pelangganEx1 == NULL)
              <h6 class="mb-3">PELANGGAN1 (EXTERNAL) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">PELANGGAN1 (EXTERNAL) <span style="color:red;">(Current weightage = {{$weightage_pelangganEx1}})</span></h6>
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
                  @foreach ($pelangganEx1 as $key => $pelangganEx1s)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($pelangganEx1s -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($pelangganEx1s->bukti_path == '')
                        @else
                        <a href="{{ $pelangganEx1s->bukti_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $pelangganEx1s -> peratus }}</td>
                      <td class="text-sm text-center">{{ $pelangganEx1s -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $pelangganEx1s -> pencapaian }}">{{ number_format( (integer)($pelangganEx1s->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pelangganEx1s->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $pelangganEx1s -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($pelangganEx1s -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$pelangganEx1s->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$pelangganEx1s->kpimasters->kpiall->id}} , {{$pelangganEx1s->kpimasters->id}} , {{$pelangganEx1s->id}})" class="dropdown-item text-danger data-delete" data-form="{{$pelangganEx1s->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($pelangganEx1master as $pelangganEx1masters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster4/'.$pelangganEx1masters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $pelangganEx1masters -> percent_master }}</b></span><br>
                  
                  @if ($pelangganEx1masters->link != '')
                    @php $links = json_decode($pelangganEx1masters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $pelangganEx1masters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  @if ($pelangganEx2count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_pelangganEx2 == 0 || $weightage_pelangganEx2 == NULL)
              <h6 class="mb-3">PELANGGAN2 (EXTERNAL) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6 class="mb-3">PELANGGAN2 (EXTERNAL) <span style="color:red;">(Current weightage = {{$weightage_pelangganEx2}})</span></h6>
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
                  @foreach ($pelangganEx2 as $key => $pelangganEx2s)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($pelangganEx2s -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($pelangganEx2s->bukti_path == '')
                        @else
                        <a href="{{ $pelangganEx2s->bukti_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $pelangganEx2s -> peratus }}</td>
                      <td class="text-sm text-center">{{ $pelangganEx2s -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $pelangganEx2s -> pencapaian }}">{{ number_format( (integer)($pelangganEx2s->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pelangganEx2s->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $pelangganEx2s -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($pelangganEx2s -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$pelangganEx2s->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$pelangganEx2s->kpimasters->kpiall->id}} , {{$pelangganEx2s->kpimasters->id}} , {{$pelangganEx2s->id}})" class="dropdown-item text-danger data-delete" data-form="{{$pelangganEx2s->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($pelangganEx2master as $pelangganEx2masters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster22/'.$pelangganEx2masters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $pelangganEx2masters -> percent_master }}</b></span><br>
                  
                  @if ($pelangganEx2masters->link != '')
                    @php $links = json_decode($pelangganEx2masters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $pelangganEx2masters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KECEMERLANGAN 1 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan1count == 0)
  @else
  <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kecemerlangan1 == 0 || $weightage_kecemerlangan1 == NULL)
              <h6>KECEMERLANGAN OPERASI (1) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KECEMERLANGAN OPERASI (1) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan1}})</span></h6>
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
                  @foreach ($kecemerlangan1 as $key => $kecemerlangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kecemerlangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kecemerlangans->bukti_path == '')
                        @else
                        <a href="{{ $kecemerlangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kecemerlangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kecemerlangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kecemerlangan1master as $kecemerlanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster5/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kecemerlanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kecemerlanganmasters->link != '')
                    @php $links = json_decode($kecemerlanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kecemerlanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KECEMERLANGAN 2 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan2count == 0)
  @else
  <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kecemerlangan2 == 0 || $weightage_kecemerlangan2 == NULL)
              <h6>KECEMERLANGAN OPERASI (2) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KECEMERLANGAN OPERASI (2) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan2}})</span></h6>
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
                  @foreach ($kecemerlangan2 as $key => $kecemerlangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kecemerlangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kecemerlangans->bukti_path == '')
                        @else
                        <a href="{{ $kecemerlangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kecemerlangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kecemerlangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kecemerlangan2master as $kecemerlanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster9/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kecemerlanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kecemerlanganmasters->link != '')
                    @php $links = json_decode($kecemerlanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kecemerlanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KECEMERLANGAN 3 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan3count == 0)
  @else
  <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kecemerlangan3 == 0 || $weightage_kecemerlangan3 == NULL)
              <h6>KECEMERLANGAN OPERASI (3) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KECEMERLANGAN OPERASI (3) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan3}})</span></h6>
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
                  @foreach ($kecemerlangan3 as $key => $kecemerlangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kecemerlangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kecemerlangans->bukti_path == '')
                        @else
                        <a href="{{ $kecemerlangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kecemerlangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kecemerlangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kecemerlangan3master as $kecemerlanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster10/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kecemerlanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kecemerlanganmasters->link != '')
                    @php $links = json_decode($kecemerlanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kecemerlanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KECEMERLANGAN 4 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan4count == 0)
  @else
  <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kecemerlangan4 == 0 || $weightage_kecemerlangan4 == NULL)
              <h6>KECEMERLANGAN OPERASI (4) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KECEMERLANGAN OPERASI (4) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan4}})</span></h6>
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
                  @foreach ($kecemerlangan4 as $key => $kecemerlangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kecemerlangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kecemerlangans->bukti_path == '')
                        @else
                        <a href="{{ $kecemerlangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kecemerlangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kecemerlangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kecemerlangan4master as $kecemerlanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster11/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kecemerlanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kecemerlanganmasters->link != '')
                    @php $links = json_decode($kecemerlanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kecemerlanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KECEMERLANGAN 5 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan5count == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kecemerlangan5 == 0 || $weightage_kecemerlangan5 == NULL)
              <h6>KECEMERLANGAN OPERASI (5) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KECEMERLANGAN OPERASI (5) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan5}})</span></h6>
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
                  @foreach ($kecemerlangan5 as $key => $kecemerlangans)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kecemerlangans -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kecemerlangans->bukti_path == '')
                        @else
                        <a href="{{ $kecemerlangans->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kecemerlangans -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kecemerlangans -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kecemerlangans->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kecemerlangan5master as $kecemerlanganmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster12/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kecemerlanganmasters -> percent_master }}</b></span><br>
                  
                  @if ($kecemerlanganmasters->link != '')
                    @php $links = json_decode($kecemerlanganmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kecemerlanganmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- TRAINING FUNGSI NEW --------------------------------------------------}}
  @if ($trainingcount == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_training == 0 || $weightage_training == NULL)
            <h6>MANUSIA & PROCESS (TRAINING) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
            <h6>MANUSIA & PROCESS (TRAINING) <span style="color:red;">(Current weightage = {{$weightage_training}})</span></h6>
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
                  @foreach ($training as $key => $trainings)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($trainings -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($trainings->bukti_path == '')
                        @else
                        <a href="{{ $trainings->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $trainings -> peratus }}</td>
                      <td class="text-sm text-center">{{ $trainings -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $trainings -> pencapaian }}">{{ number_format( (integer)($trainings->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trainings->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $trainings -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($trainings -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$trainings->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$trainings->kpimasters->kpiall->id}} , {{$trainings->kpimasters->id}} , {{$trainings->id}})" class="dropdown-item text-danger data-delete" data-form="{{$trainings->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($trainingmaster as $trainingmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster6/'.$trainingmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $trainingmasters -> percent_master }}</b></span><br>
                  
                  @if ($trainingmasters->link != '')
                    @php $links = json_decode($trainingmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $trainingmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- NCR FUNGSI NEW --------------------------------------------------}}
  @if ($ncrcount == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_ncr == 0 || $weightage_ncr == NULL)
              <h6>MANUSIA & PROCESS (NCROFI) <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>MANUSIA & PROCESS (NCROFI) <span style="color:red;">(Current weightage = {{$weightage_ncr}})</span></h6>
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
                  @foreach ($ncr as $key => $ncrs)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($ncrs -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($ncrs->bukti_path == '')
                        @else
                        <a href="{{ $ncrs->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $ncrs -> peratus }}</td>
                      <td class="text-sm text-center">{{ $ncrs -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $ncrs -> pencapaian }}">{{ number_format( (integer)($ncrs->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ncrs->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $ncrs -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($ncrs -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$ncrs->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$ncrs->kpimasters->kpiall->id}} , {{$ncrs->kpimasters->id}} , {{$ncrs->id}})" class="dropdown-item text-danger data-delete" data-form="{{$ncrs->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($ncrmaster as $ncrmasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster7/'.$ncrmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $ncrmasters -> percent_master }}</b></span><br>
                  
                  @if ($ncrmasters->link != '')
                    @php $links = json_decode($ncrmasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $ncrmasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

  {{--------------------------------------------------- KOLABORASI FUNGSI NEW --------------------------------------------------}}
  @if ($kolaborasicount == 0)
  @else
    <div class="row">
      <div class="col-md-12">
        
        <div class="card mb-4">
          <div class="card-body">
            @if ($weightage_kolaborasi == 0 || $weightage_kolaborasi == NULL)
              <h6>KOLABORASI1 <span style="color:red;">(Current weightage = 0)</span></h6>
            @else
              <h6>KOLABORASI1 <span style="color:red;">(Current weightage = {{$weightage_kolaborasi}})</span></h6>
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
                  @foreach ($kolaborasi as $key => $kolaborasis)
                    <tr>
                      <td class="text-sm text-center">{{$key + 1}}</td>
                      <td class="text-xs">{!! nl2br($kolaborasis -> bukti) !!}</td>
                      <td class="text-sm text-center">
                        @if ($kolaborasis->bukti_path == '')
                        @else
                        <a href="{{ $kolaborasis->bukti_path }}" class="btn btn-info btn-sm btn-icon my-auto" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i>
                        @endif
                      </td>
                      <td class="text-sm text-center">{{ $kolaborasis -> peratus }}</td>
                      <td class="text-sm text-center">{{ $kolaborasis -> ukuran }}</td>
                      <td class="mx-auto">
                        <span class="me-2 text-xs fw-bolder" value="{{ $kolaborasis -> pencapaian }}">{{ number_format( (integer)($kolaborasis->skor_KPI)) }}%</span>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kolaborasis->skor_KPI }}%;"></div>
                        </div>
                      </td>
                      <td class="text-sm text-center">{{ $kolaborasis -> skor_KPI }}</td>
                      <td class="text-sm text-center">{{ round($kolaborasis -> skor_sebenar,2) }} %</td>
                      <td class="text-center">
                        <a type="button" id="dropdownMenuButton" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu">
                          <a href="{{ url('employee/edit/kpi/'.$kolaborasis->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item">EDIT</a>
                          <button type="button" wire:click="selectItem({{$kolaborasis->kpimasters->kpiall->id}} , {{$kolaborasis->kpimasters->id}} , {{$kolaborasis->id}})" class="dropdown-item text-danger data-delete" data-form="{{$kolaborasis->id}}">DELETE</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>

            @foreach ($kolaborasimaster as $kolaborasimasters)
            <div class="card-body bg-gray-100 border-radius-lg py-4 my-4">
              <div class="row">
                <div class="col-9 lh-1">
                  <span class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Additional information is <span class="text-danger">required</span>, please insert your <span class="text-danger">KPI Master information</span>
                  <hr>
                </div>

                <div class="col-3 text-end">
                  <a href="{{ url('employee/edit/kpimaster8/'.$kolaborasimasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn bg-gradient-info btn-sm px-4" href="javascript:;"><i class="bi bi-pencil me-2" aria-hidden="true"></i>Edit</a>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <span class="mb-2 text-xs">KPI Master Percentage (%) : <b>{{ $kolaborasimasters -> percent_master }}</b></span><br>
                  
                  @if ($kolaborasimasters->link != '')
                    @php $links = json_decode($kolaborasimasters->link); @endphp
                    
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

                  <span class="mb-2 text-xs">KPI Objective : <b>{{ $kolaborasimasters -> objektif }}</b></span>
                </div>
              </div>
            </div>
            @endforeach
              
          </div>
        </div>

      </div>
    </div>
  @endif

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