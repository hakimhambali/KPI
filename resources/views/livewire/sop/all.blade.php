<div>
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
      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
      <div class="container-fluid py-4">
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
                          <div class="card mt-4">
                              <div class="card-header pb-0 p-3">
                                  <div class="row">
                                      <div class="col-6 d-flex align-items-center"><h6>SOP</h6></div>
                                  </div>
                              </div>
                              <form action="{{ url('/dc/create/sop') }}" method="post" enctype="multipart/form-data">
                              @csrf  
                              <div class="card-body p-3">
                                <div class="row">
                                  <label class="font-weight-bold">Title</label>
                                  <div class="card card-plain border-radius-lg align-items-center">
                                      <input class="form-control form-control-lg" type="text" name="title" value="" required>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="row">
                                        <label class="font-weight-bold">For Department</label>
                                        <div class="card card-plain border-radius-lg align-items-center">
                                          <select class="form-select form-select-lg" id="department" name="department">
                                              <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                                              <option value="CEO Office">CEO Office</option>
                                              <option value="Human Resource (HR) & Administration">Human Resource (HR) & Administration</option>
                                              <option value="Account & Finance (A&F)">Account & Finance (A&F)</option>
                                              <option value="Sales">Sales</option>
                                              <option value="Marketing">Marketing</option>
                                              <option value="Operation">Operation</option>
                                              <option value="High Network Client (HNC)">High Network Client (HNC)</option>
                                              <option value="Research & Development (R&D)">Research & Development (R&D)</option>
                                          </select>
                                        </div>
                                      </div>  
                                    </div>
                                    <div class="col-md-6">
                                      <div class="row">
                                        <label class="font-weight-bold">Choose Part</label>
                                        <div class="card card-plain border-radius-lg align-items-center">
                                          <select class="form-select form-select-lg" id="part" name="part">
                                              <option value="01 FORM">01 FORM</option>
                                              <option value="02 PROCEDURE">02 PROCEDURE</option>
                                              <option value="03 WORK INSTRUCTION">03 WORK INSTRUCTION</option>
                                              <option value="04 GUIDELINE">04 GUIDELINE</option>
                                              <option value="05 QUALITY MANUAL">05 QUALITY MANUAL</option>
                                          </select>
                                        </div>
                                      </div>  
                                    </div>
                                    <div class="col-md-6">
                                      <label class="font-weight-bold" >Description (Optional)</label>
                                      <textarea class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="description" id="description" cols="60" rows="10" placeholder="Type your description here..."></textarea>
                                    </div>
                                    <div class="col-md-6 mb-md-0">
                                      <label class="font-weight-bold">View by Department</label>
                                      <br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Senior Leadership Team (SLT)"><label for="departmentview">Senior Leadership Team (SLT)</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="CEO Office"><label for="departmentview">CEO Office</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Human Resource (HR) & Administration"><label for="departmentview">Human Resource (HR) & Administration</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Account & Finance (A&F)"><label for="departmentview">Account & Finance (A&F)</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Sales"><label for="departmentview">Sales</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Marketing"><label for="departmentview">Marketing</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Operation"><label for="departmentview">Operation</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="High Network Client (HNC)"><label for="departmentview">High Network Client (HNC)</label><br>
                                        <input type="checkbox" id="departmentview" name="departmentview[]" value="Research & Development (R&D)"><label for="departmentview">Research & Development (R&D)</label><br>
                                    </div>
                                  </div>

                                  <div class="card-body p-3">
                                    <div class="row">
                                      <div class="col-md-6 mb-md-0">
                                        <div class="row">
                                          <label class="font-weight-bold">Link SOP (Optional)</label>
                                          <div class="card card-plain border-radius-lg align-items-center">
                                            <input type="text" class="form-control" id="link" name="link" >
                                            @error('link') <div class="text-danger">{{ $message }}</div> @enderror                        
                                          </div>
                                        </div>  
                                      </div>
                                      <div class="col-md-6 mb-md-0">
                                        <label class="font-weight-bold">Upload SOP (Optional)</label>
                                        <div
                                            x-data="{ isUploading: false, progress: 0 }"
                                            x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <div wire:loading wire:target="sop_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                                            <input type="file" wire:model="sop_path" id="sop_path" name="sop_path" class="dropify" />
                                            @error('sop_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                            <div x-show="isUploading">
                                                <progress max="100" x-bind:value="progress"></progress>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  {{-- <div class="col-md-4 mt-2" id="sopupload">
                                      <div class="form-group">
                                          <label class="font-weight-bold">Sop Upload</label>
                                          <div
                                              x-data="{ isUploading: false, progress: 0 }"
                                              x-on:livewire-upload-start="isUploading = true"
                                              x-on:livewire-upload-finish="isUploading = false"
                                              x-on:livewire-upload-error="isUploading = false"
                                              x-on:livewire-upload-progress="progress = $event.detail.progress">
                                          <div wire:loading wire:target="sop_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                                              <input type="file" wire:model="sop_path" id="sop_path" name="sop_path" class="dropify" required />
                                              @error('sop_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                              <div x-show="isUploading">
                                                  <progress max="100" x-bind:value="progress"></progress>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4 mt-2" id="sopupload">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sop Upload</label>
                                        <div class="col-md-6 mb-md-0">
                                          <div class="row">
                                            <p>Evidence Link (Leave blank if does not have any evidence)</p> 
                                            <div class="card card-plain border-radius-lg align-items-center">
                                              <input type="text" class="form-control" id="link" name="link" value="" >
                                              @error('link') <div class="text-danger">{{ $message }}</div> @enderror                        
                                            </div>
                                          </div>  
                                        </div>
                                    </div>
                                </div> --}}
                                  </div>
                                  <div class="mt-2" style="text-align: right">
                                      <div class="col-12 text-end">
                                        <button class="btn bg-gradient-dark mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;SAVE</button>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </form>     
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @endif
      </div>

      @foreach ($department as $departments)
      @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc' || (auth()->user()->role == 'employee' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'manager' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'hr' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'pro' && auth()->user()->department == $departments->name))
      <div class="container-fluid py-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header pb-0">
                  @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                    <h5><span style="color:red;">{{ $departments->name }}</span></h5>
                  @else
                    <h6>{{ $departments->name }}</h6>
                  @endif
                </div>
                <div class="card-header pb-0">
                  <h6>01 FORM</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sop</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($sop1 as $key => $sops)
                        <?php $departmentviews = json_decode($sops->departmentview); ?>
                        @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == $departments->name) 
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $sops->title }}">{{ $sops->title }}</p>
                            </td>
                            <td class="text-xs font-weight-bold mb-0">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $sops->sop_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$sops->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$sops->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                          @endif @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-header pb-0">
                  <h6>02 PROCEDURE</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($sop2 as $key => $sops)
                        <?php $departmentviews = json_decode($sops->departmentview); ?>
                        @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == $departments->name) 
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $sops->title }}">{{ $sops->title }}</p>
                            </td>
                            <td class="text-xs font-weight-bold mb-0">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $sops->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$sops->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$sops->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                          @endif @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-header pb-0">
                  <h6>03 WORK INSTRUCTION</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($sop3 as $key => $sops)
                        <?php $departmentviews = json_decode($sops->departmentview); ?>
                        @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == $departments->name) 
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $sops->title }}">{{ $sops->title }}</p>
                            </td>
                            <td class="text-xs font-weight-bold mb-0">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $sops->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$sops->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$sops->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                          @endif @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-header pb-0">
                  <h6>04 GUIDELINE</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($sop4 as $key => $sops)
                        <?php $departmentviews = json_decode($sops->departmentview); ?>
                        @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == $departments->name) 
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $sops->title }}">{{ $sops->title }}</p>
                            </td>
                            <td class="text-xs font-weight-bold mb-0">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $sops->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$sops->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$sops->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                          @endif @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-header pb-0">
                  <h6>05 QUALITY MANUAL</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link</th>
                          @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($sop5 as $key => $sops)
                        <?php $departmentviews = json_decode($sops->departmentview); ?>
                        @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == $departments->name) 
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0" value="{{ $sops->title }}">{{ $sops->title }}</p>
                            </td>
                            <td>{{date('j F Y', strtotime($sops->updated_at))}} </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $sops->link }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$sops->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$sops->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                          @endif @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach 
  
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
  
  
  