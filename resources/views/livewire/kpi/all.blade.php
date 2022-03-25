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
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-12 mb-lg-0 mb-4">
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

          <div class="card mt-4">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  @if ($weightage_master == 0 || $weightage_master == NULL) 
                  <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = 0)</span></h6>
                  @else
                  <h6>SCORE CARD - KPI <span style="color:red;">(Current total weightage = {{$weightage_master}})</span></h6>
                  @endif
                </div>
              </div>
            </div>
            <form action="{{ url('/employee/save/kpi/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" method="post" enctype="multipart/form-data">
            @csrf  
            <div class="card-body p-3">
              <div class="row">
                
                <div class="col-md-6">
                  <div class="mb-4" class="@error('fungsi') border border-danger rounded-3 @enderror">
                    <label class="font-weight-bold" >Function</label>
                        <td style="word-break: break-all;" class="border-dark">
                          <select class="form-select card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" id="fungsi" name="fungsi">
                            <option selected value="">-- Please Choose --</option>
                            @if (Auth::user()->position == 'Junior Non-Executive (NE1)' || Auth::user()->position == 'Senior Non-Executive (NE2)')
                            @else
                            <option value="Kad Skor Korporat" >Kad Skor Korporat</option>
                            @endif
                            <option value="Kewangan1" >Kewangan (1)</option>
                            <option value="Kewangan2" >Kewangan (2)</option>
                            <option value="Kewangan3" >Kewangan (3)</option>
                            <option value="Kewangan4" >Kewangan (4)</option>
                            <option value="Kewangan5" >Kewangan (5)</option>
                            @if (Auth::user()->department == 'Human Resource (HR) & Administration' || Auth::user()->department == 'Operation')
                            <option value="Pelanggan (Internal)" >Pelanggan (Internal)</option>
                            @else
                            @endif
                            <option value="Pelanggan (External)" >Pelanggan (External)</option>
                            <option value="Kecemerlangan Operasi1" >Kecemerlangan Operasi (1)</option> 
                            <option value="Kecemerlangan Operasi2" >Kecemerlangan Operasi (2)</option> 
                            <option value="Kecemerlangan Operasi3" >Kecemerlangan Operasi (3)</option> 
                            <option value="Kecemerlangan Operasi4" >Kecemerlangan Operasi (4)</option> 
                            <option value="Kecemerlangan Operasi5" >Kecemerlangan Operasi (5)</option>
                            <option value="Manusia & Proses (Training)" >Manusia & Proses (Training)</option> 
                            <option value="Manusia & Proses (NCROFI)" >Manusia & Proses (NCROFI)</option> 
                            <option value="Kolaborasi" >Kolaborasi</option>
                          </select>
                        </td>
                    </select>
                    @error('fungsi') <div class="text-danger">{{ $message }}</div> @enderror
                    <div class="col-md-4 mt-2" id="buktiupload">
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
                </div>
                <div class="col-md-6">
                  <div class="mb-4" class="@error('bukti') border border-danger rounded-3 @enderror">
                    <label class="font-weight-bold" >Evidence</label>
                      <textarea class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="bukti" id="bukti" cols="60" rows="10" placeholder="Enter your evidence description here..."></textarea>
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
                        <td class="border-dark" class="@error('peratus') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" pattern="[0-9]+" maxlength="3" class="input_ukuran w-75" id="peratus" name="peratus" onkeyup="masterClac();" min="0"  >
                          @error('peratus') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>

                        <td style="word-break: break-all;" class="border-dark" class="@error('peratus') border border-danger rounded-3 @enderror">
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
                          @error('ukuran') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>

                        <td class="border-dark" class="@error('threshold') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="input_threshold w-75" id="threshold" name="threshold" onkeyup="masterClac();" min="0" >
                          @error('threshold') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                  
                        <td class="border-dark" class="@error('base') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="input_base w-75" id="base" name="base" onkeyup="masterClac();" min="0" >
                          @error('base') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                  
                        <td class="border-dark" class="@error('stretch') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="input_stretch w-75" id="stretch" name="stretch" onkeyup="masterClac();" min="0" >
                          @error('stretch') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                  
                        <td class="border-dark" class="@error('pencapaian') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" pattern="^\d*(\.\d{0,2})?$\-^\d*(\.\d{0,2})?$" maxlength="7" class="input_pencapaian w-75" id="pencapaian" name="pencapaian" onkeyup="masterClac();" min="0" >
                          @error('pencapaian') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                  
                        <td class="border-dark" class="@error('skor_KPI') border border-danger rounded-3 @enderror">
                          <input type="text" class="form-control" id="skor_KPI" name="skor_KPI" value="0" readonly>
                          @error('skor_KPI') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                  
                        <td class="border-dark" class="@error('skor_sebenar') border border-danger rounded-3 @enderror">
                          <input type="text"  class="form-control"  id="skor_sebenar" name="skor_sebenar" value="0" readonly>
                          @error('skor_sebenar') <div class="text-danger">{{ $message }}</div> @enderror
                        </td>
                      </tr>
                  </tbody>
                </table>
              <div class="mt-2" style="text-align: right">
                <div class="col-12 text-end">
                  <button class="btn bg-gradient-dark mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;SAVE</button>
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
{{--------------------------------------------------- KADSKOR FUNGSI --------------------------------------------------}}
  @if ($kadskorcount == 0) 
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kadskor == 0 || $weightage_kadskor == NULL)
          <h6>KAD SKOR KORPORAT <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KAD SKOR KORPORAT <span style="color:red;">(Current weightage = {{$weightage_kadskor}})</span></h6>
          @endif
          @foreach ($kadskor as $key => $kadskors)
          @endforeach
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kadskor as $key => $kadskors)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kadskors -> bukti }}">{{ $kadskors -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kadskors->bukti_path == '')
                    <a href=" {{  $kadskors->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kadskors->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kadskors -> peratus }}">{{ $kadskors -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kadskors -> ukuran }}">{{ $kadskors -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kadskors -> pencapaian }}">{{ number_format( (integer)($kadskors->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kadskors->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kadskors -> skor_KPI }}">{{ $kadskors -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kadskors -> skor_sebenar,2) }} ">{{ round($kadskors -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kadskors->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kadskors->kpimasters->kpiall->id}} , {{$kadskors->kpimasters->id}} , {{$kadskors->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kadskors->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kadskormaster as $kadskormasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kadskormasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kadskormasters->link == '')
                      <a href=" {{ $kadskormasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kadskormasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kadskormasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kadskormasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster1/'.$kadskormasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN1 FUNGSI --------------------------------------------------}}
  @if ($kewangan1count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan1 == 0 || $weightage_kewangan1 == NULL)
          <h6>KEWANGAN (1) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (1) <span style="color:red;">(Current weightage = {{$weightage_kewangan1}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan1 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan1master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster2/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN2 FUNGSI --------------------------------------------------}}
  @if ($kewangan2count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan2 == 0 || $weightage_kewangan2 == NULL)
          <h6>KEWANGAN (2) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (2) <span style="color:red;">(Current weightage = {{$weightage_kewangan2}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan2 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan2master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster13/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN3 FUNGSI --------------------------------------------------}}
  @if ($kewangan3count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan3 == 0 || $weightage_kewangan3 == NULL)
          <h6>KEWANGAN (3) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (3) <span style="color:red;">(Current weightage = {{$weightage_kewangan3}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan3 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan3master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster14/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN4 FUNGSI --------------------------------------------------}}
  @if ($kewangan4count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan4 == 0 || $weightage_kewangan4 == NULL)
          <h6>KEWANGAN (4) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (4) <span style="color:red;">(Current weightage = {{$weightage_kewangan4}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan4 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan4master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster15/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN5 FUNGSI --------------------------------------------------}}
  @if ($kewangan5count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan5 == 0 || $weightage_kewangan5 == NULL)
          <h6>KEWANGAN (5) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (5) <span style="color:red;">(Current weightage = {{$weightage_kewangan5}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan5 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan5master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster16/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN6 FUNGSI --------------------------------------------------}}
  @if ($kewangan6count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan6 == 0 || $weightage_kewangan6 == NULL)
          <h6>KEWANGAN (6) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (6) <span style="color:red;">(Current weightage = {{$weightage_kewangan6}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan6 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan6master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster17/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  
{{--------------------------------------------------- KEWANGAN7 FUNGSI --------------------------------------------------}}
  @if ($kewangan7count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan7 == 0 || $weightage_kewangan7 == NULL)
          <h6>KEWANGAN (7) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (7) <span style="color:red;">(Current weightage = {{$weightage_kewangan7}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan7 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan7master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster18/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN8 FUNGSI --------------------------------------------------}}
  @if ($kewangan8count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan8 == 0 || $weightage_kewangan8 == NULL)
          <h6>KEWANGAN (8) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (8) <span style="color:red;">(Current weightage = {{$weightage_kewangan8}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan8 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan8master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster19/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN9 FUNGSI --------------------------------------------------}}
  @if ($kewangan9count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan9 == 0 || $weightage_kewangan9 == NULL)
          <h6>KEWANGAN (9) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (9) <span style="color:red;">(Current weightage = {{$weightage_kewangan9}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan9 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan9master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster20/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KEWANGAN10 FUNGSI --------------------------------------------------}}
  @if ($kewangan10count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kewangan10 == 0 || $weightage_kewangan10 == NULL)
          <h6>KEWANGAN (10) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KEWANGAN (10) <span style="color:red;">(Current weightage = {{$weightage_kewangan10}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kewangan10 as $key => $kewangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kewangans -> bukti }}">{{ $kewangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kewangans->bukti_path == '')
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kewangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> peratus }}">{{ $kewangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> ukuran }}">{{ $kewangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kewangans -> pencapaian }}">{{ number_format( (integer)($kewangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kewangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kewangans -> skor_KPI }}">{{ $kewangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kewangans -> skor_sebenar,2) }} ">{{ round($kewangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kewangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kewangans->kpimasters->kpiall->id}} , {{$kewangans->kpimasters->id}} , {{$kewangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kewangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kewangan10master as $kewanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kewanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kewanganmasters->link == '')
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kewanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kewanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kewanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster21/'.$kewanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- PELANGGANI FUNGSI --------------------------------------------------}}
  @if ($pelangganIcount == 0) {{--ADA--}}
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_pelangganI == 0 || $weightage_pelangganI == NULL)
          <h6>PELANGGAN (INTERNAL) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>PELANGGAN (INTERNAL) <span style="color:red;">(Current weightage = {{$weightage_pelangganI}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pelangganI as $key => $pelangganIs)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $pelangganIs -> bukti }}">{{ $pelangganIs -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($pelangganIs->bukti_path == '')
                    <a href=" {{  $pelangganIs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $pelangganIs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIs -> peratus }}">{{ $pelangganIs -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIs -> ukuran }}">{{ $pelangganIs -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $pelangganIs -> pencapaian }}">{{ number_format( (integer)($pelangganIs->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pelangganIs->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIs -> skor_KPI }}">{{ $pelangganIs -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($pelangganIs -> skor_sebenar,2) }} ">{{ round($pelangganIs -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$pelangganIs->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$pelangganIs->kpimasters->kpiall->id}} , {{$pelangganIs->kpimasters->id}} , {{$pelangganIs->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$pelangganIs->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($pelangganImaster as $pelangganImasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $pelangganImasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($pelangganImasters->link == '')
                      <a href=" {{ $pelangganImasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $pelangganImasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $pelangganImasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $pelangganImasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster3/'.$pelangganImasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- PELANGGANII FUNGSI --------------------------------------------------}}
  @if ($pelangganIIcount == 0) {{--ADA--}}
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_pelangganII == 0 || $weightage_pelangganII == NULL)
          <h6>PELANGGAN (EXTERNAL) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>PELANGGAN (EXTERNAL) <span style="color:red;">(Current weightage = {{$weightage_pelangganII}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pelangganII as $key => $pelangganIIs)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $pelangganIIs -> bukti }}">{{ $pelangganIIs -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($pelangganIIs->bukti_path == '')
                    <a href=" {{  $pelangganIIs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $pelangganIIs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIIs -> peratus }}">{{ $pelangganIIs -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIIs -> ukuran }}">{{ $pelangganIIs -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $pelangganIIs -> pencapaian }}">{{ number_format( (integer)($pelangganIIs->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $pelangganIIs->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $pelangganIIs -> skor_KPI }}">{{ $pelangganIIs -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($pelangganIIs -> skor_sebenar,2) }} ">{{ round($pelangganIIs -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$pelangganIIs->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$pelangganIIs->kpimasters->kpiall->id}} , {{$pelangganIIs->kpimasters->id}} , {{$pelangganIIs->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$pelangganIIs->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($pelangganIImaster as $pelangganIImasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $pelangganIImasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($pelangganIImasters->link == '')
                      <a href=" {{ $pelangganIImasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $pelangganIImasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $pelangganIImasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $pelangganIImasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster4/'.$pelangganIImasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KECEMERLANGAN1 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan1count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kecemerlangan1 == 0 || $weightage_kecemerlangan1 == NULL)
          <h6>KECEMERLANGAN OPERASI (1) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KECEMERLANGAN OPERASI (1) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan1}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kecemerlangan1 as $key => $kecemerlangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> bukti }}">{{ $kecemerlangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kecemerlangans->bukti_path == '')
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> peratus }}">{{ $kecemerlangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> ukuran }}">{{ $kecemerlangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> skor_KPI }}">{{ $kecemerlangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kecemerlangans -> skor_sebenar,2) }} ">{{ round($kecemerlangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecemerlangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kecemerlangan1master as $kecemerlanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kecemerlanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kecemerlanganmasters->link == '')
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kecemerlanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kecemerlanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster5/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KECEMERLANGAN2 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan2count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kecemerlangan2 == 0 || $weightage_kecemerlangan2 == NULL)
          <h6>KECEMERLANGAN OPERASI (2) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KECEMERLANGAN OPERASI (2) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan2}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kecemerlangan2 as $key => $kecemerlangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> bukti }}">{{ $kecemerlangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kecemerlangans->bukti_path == '')
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> peratus }}">{{ $kecemerlangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> ukuran }}">{{ $kecemerlangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> skor_KPI }}">{{ $kecemerlangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kecemerlangans -> skor_sebenar,2) }} ">{{ round($kecemerlangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecemerlangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kecemerlangan2master as $kecemerlanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kecemerlanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kecemerlanganmasters->link == '')
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kecemerlanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kecemerlanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster9/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KECEMERLANGAN3 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan3count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kecemerlangan3 == 0 || $weightage_kecemerlangan3 == NULL)
          <h6>KECEMERLANGAN OPERASI (3) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KECEMERLANGAN OPERASI (3) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan3}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kecemerlangan3 as $key => $kecemerlangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> bukti }}">{{ $kecemerlangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kecemerlangans->bukti_path == '')
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> peratus }}">{{ $kecemerlangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> ukuran }}">{{ $kecemerlangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> skor_KPI }}">{{ $kecemerlangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kecemerlangans -> skor_sebenar,2) }} ">{{ round($kecemerlangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecemerlangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kecemerlangan3master as $kecemerlanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kecemerlanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kecemerlanganmasters->link == '')
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kecemerlanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kecemerlanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster10/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KECEMERLANGAN4 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan4count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kecemerlangan4 == 0 || $weightage_kecemerlangan4 == NULL)
          <h6>KECEMERLANGAN OPERASI (4) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KECEMERLANGAN OPERASI (4) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan4}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kecemerlangan4 as $key => $kecemerlangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> bukti }}">{{ $kecemerlangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kecemerlangans->bukti_path == '')
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> peratus }}">{{ $kecemerlangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> ukuran }}">{{ $kecemerlangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> skor_KPI }}">{{ $kecemerlangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kecemerlangans -> skor_sebenar,2) }} ">{{ round($kecemerlangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecemerlangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kecemerlangan4master as $kecemerlanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kecemerlanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kecemerlanganmasters->link == '')
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kecemerlanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kecemerlanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster11/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- KECEMERLANGAN5 FUNGSI --------------------------------------------------}}
  @if ($kecemerlangan5count == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kecemerlangan5 == 0 || $weightage_kecemerlangan5 == NULL)
          <h6>KECEMERLANGAN OPERASI (5) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KECEMERLANGAN OPERASI (5) <span style="color:red;">(Current weightage = {{$weightage_kecemerlangan5}})</span></h6>
          @endif

        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kecemerlangan5 as $key => $kecemerlangans)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> bukti }}">{{ $kecemerlangans -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kecemerlangans->bukti_path == '')
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kecemerlangans->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> peratus }}">{{ $kecemerlangans -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> ukuran }}">{{ $kecemerlangans -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kecemerlangans -> pencapaian }}">{{ number_format( (integer)($kecemerlangans->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kecemerlangans->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kecemerlangans -> skor_KPI }}">{{ $kecemerlangans -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kecemerlangans -> skor_sebenar,2) }} ">{{ round($kecemerlangans -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kecemerlangans->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kecemerlangans->kpimasters->kpiall->id}} , {{$kecemerlangans->kpimasters->id}} , {{$kecemerlangans->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kecemerlangans->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kecemerlangan5master as $kecemerlanganmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kecemerlanganmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kecemerlanganmasters->link == '')
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kecemerlanganmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kecemerlanganmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kecemerlanganmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster12/'.$kecemerlanganmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- TRAINING FUNGSI --------------------------------------------------}}
  @if ($trainingcount == 0)
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_training == 0 || $weightage_training == NULL)
          <h6>MANUSIA & PROCESS (TRAINING) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>MANUSIA & PROCESS (TRAINING) <span style="color:red;">(Current weightage = {{$weightage_training}})</span></h6>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($training as $key => $trainings)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $trainings -> bukti }}">{{$trainings -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($trainings->bukti_path == '')
                    <a href=" {{  $trainings->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $trainings->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $trainings -> peratus }}">{{ $trainings -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $trainings -> ukuran }}">{{ $trainings -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $trainings -> pencapaian }}">{{ number_format( (integer)($trainings->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trainings->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $trainings -> skor_KPI }}">{{ $trainings -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($trainings -> skor_sebenar,2) }} ">{{ round($trainings -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$trainings->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$trainings->kpimasters->kpiall->id}} , {{$trainings->kpimasters->id}} , {{$trainings->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$trainings->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($trainingmaster as $trainingmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $trainingmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($trainingmasters->link == '')
                      <a href=" {{ $trainingmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $trainingmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $trainingmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $trainingmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster6/'.$trainingmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

{{--------------------------------------------------- NCR FUNGSI --------------------------------------------------}}
  @if ($ncrcount == 0) {{-- ADA --}}
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_ncr == 0 || $weightage_ncr == NULL)
          <h6>MANUSIA & PROCESS (NCROFI) <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>MANUSIA & PROCESS (NCROFI) <span style="color:red;">(Current weightage = {{$weightage_ncr}})</span></h6>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($ncr as $key => $ncrs)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $ncrs -> bukti }}">{{ $ncrs -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($ncrs->bukti_path == '')
                    <a href=" {{  $ncrs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $ncrs->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $ncrs -> peratus }}">{{ $ncrs -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $ncrs -> ukuran }}">{{ $ncrs -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $ncrs -> pencapaian }}">{{ number_format( (integer)($ncrs->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $ncrs->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $ncrs -> skor_KPI }}">{{ $ncrs -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($ncrs -> skor_sebenar,2) }} ">{{ round($ncrs -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$ncrs->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$ncrs->kpimasters->kpiall->id}} , {{$ncrs->kpimasters->id}} , {{$ncrs->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$ncrs->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($ncrmaster as $ncrmasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $ncrmasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($ncrmasters->link == '')
                      <a href=" {{ $ncrmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $ncrmasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $ncrmasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $ncrmasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster7/'.$ncrmasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  
{{--------------------------------------------------- KOLABORASI FUNGSI --------------------------------------------------}}
  @if ($kolaborasicount == 0) {{--ADA--}}
  @else
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header pb-0">
          @if ($weightage_kolaborasi == 0 || $weightage_kolaborasi == NULL)
          <h6>KOLABORASI <span style="color:red;">(Current weightage = 0)</span></h6>
          @else
          <h6>KOLABORASI <span style="color:red;">(Current weightage = {{$weightage_kolaborasi}})</span></h6>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="p-0 table-responsive">
            <table class="table align-items-center justify-content-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Evidence File</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">%</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Measurement</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">KPI Target</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">KPI Score</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actual Score</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kolaborasi as $key => $kolaborasis)
                <tr>
                  <td>    
                    <div class="d-flex px-3">
                      <div class="my-auto">
                        <h6 class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <pre class="text-sm font-weight-bold mb-0" value="{{ $kolaborasis -> bukti }}">{{ $kolaborasis -> bukti }}</pre>
                  </td>
                  <td>
                    @if ($kolaborasis->bukti_path == '')
                    <a href=" {{  $kolaborasis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                    @else
                    <a href=" {{  $kolaborasis->bukti_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                    @endif
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kolaborasis -> peratus }}">{{ $kolaborasis -> peratus }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kolaborasis -> ukuran }}">{{ $kolaborasis -> ukuran }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="me-2 text-xs font-weight-bold" value="{{ $kolaborasis -> pencapaian }}">{{ number_format( (integer)($kolaborasis->skor_KPI)) }}%</span>
                      <div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $kolaborasis->skor_KPI }}%;"></div>
                          </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ $kolaborasis -> skor_KPI }}">{{ $kolaborasis -> skor_KPI }}</span>
                  </td>
                  <td>
                    <span class="text-center text-sm font-weight-bold mb-0" value="{{ round($kolaborasis -> skor_sebenar,2) }} ">{{ round($kolaborasis -> skor_sebenar,2) }} %</span>
                  </td>
                  <td class="align-middle">
                    <div class="col-lg-6 col-5 my-auto text-middle">
                      <div class="dropdown float-lg-start pe-4">
                        <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                          <li><a href="{{ url('employee/edit/kpi/'.$kolaborasis->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                          <li><button type="button" wire:click="selectItem({{$kolaborasis->kpimasters->kpiall->id}} , {{$kolaborasis->kpimasters->id}} , {{$kolaborasis->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;"  data-form="{{$kolaborasis->id}}">Delete</button></li>
                        </ul>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                </tr>
                @endforeach
              </tbody>
            </table>
            @foreach ($kolaborasimaster as $kolaborasimasters)
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <span class="mb-2 text-xs">KPI Master Percentage :<span class="text-dark font-weight-bold ms-sm-1">{{ $kolaborasimasters -> percent_master }}</span></span>
                    <span class="mb-2 text-xs">Evidence Link :<span class="text-dark ms-sm-1 font-weight-bold">
                      @if ($kolaborasimasters->link == '')
                      <a href=" {{ $kolaborasimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank"></a>
                      @else
                      <a href=" {{ $kolaborasimasters -> link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">{{ $kolaborasimasters -> link }}</a>
                      @endif
                      </span></span>
                    <span class="text-xs">KPI Objective :<span class="text-dark ms-sm-1 font-weight-bold">{{ $kolaborasimasters -> objektif }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    <a href="{{ url('employee/edit/kpimaster8/'.$kolaborasimasters->id.'/'.$date_id.'/'.$user_id.'/'.$year.'/'.$month) }}" class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @endforeach  
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

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