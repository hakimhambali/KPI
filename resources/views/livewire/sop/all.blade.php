@include('layouts.navbars.auth.nav')
{{--------------------------------------------------- SOP (ALL USER) --------------------------------------------------}}
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
      {{-- CREATE SOP (DC & ADMIN) ----------------------------------------------------------------------------------------------}}
      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
        <div class="container-fluid pb-4">
          <div class="row">
            <div class="col-lg-12">
              
              @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>{{ session('message') }}</strong></div>	
              @endif
              @if (session('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>{{ session('fail') }}</strong></div>
              @endif
                        
              <div class="card">
                <form action="{{ url('/dc/create/sop') }}" method="post" enctype="multipart/form-data">
                @csrf  
                  <div class="card-body">
                    <h6>CREATE STANDARD OPERATING PROCEDURES (SOP)</h6><hr>
                    
                    <div class="col-md-12 mb-3 mt-2">
                      <label class="form-label">Title<span class="text-danger">*</span></label>
                      <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Please Insert Title of SOP" required>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">For Department<span class="text-danger">*</span></label>
                        <select class="form-select" id="department" name="department" required>
                          @foreach ($department as $departments)
                            <option value="{{$departments->name}}">{{$departments->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">Document Type<span class="text-danger">*</span></label>
                        <select class="form-select" id="part" name="part" required>
                          <option value="">Select Document Type...</option>
                          <option value="01 FORM">01 FORM</option>
                          <option value="02 PROCEDURE">02 PROCEDURE</option>
                          <option value="03 WORK INSTRUCTION">03 WORK INSTRUCTION</option>
                          <option value="04 GUIDELINE">04 GUIDELINE</option>
                          <option value="05 QUALITY MANUAL">05 QUALITY MANUAL</option>
                        </select>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea class="form-control" name="description" id="description" rows="11" placeholder="Please insert the SOP description here..."></textarea>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label class="form-label">View by Department<span class="text-danger">*</span></label><br>
                        @foreach ($department as $departments)
                          <input type="checkbox" id="departmentview" name="departmentview[]" value="{{$departments->name}}"><label for="departmentview">{{$departments->name}}</label><br>
                        @endforeach
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Link SOP<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="link" value="{{ old('link') }}" placeholder="Please Insert link">
                      </div>

                      <div class="col-md-6 mb-3" id="memoupload">
                        <div class="form-group">
                          <label class="form-label">Upload SOP File (<span class="text-danger">*</span>Only Form Type)</label>
                          <div
                              x-data="{ isUploading: false, progress: 0 }"
                              x-on:livewire-upload-start="isUploading = true"
                              x-on:livewire-upload-finish="isUploading = false"
                              x-on:livewire-upload-error="isUploading = false"
                              x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div wire:loading wire:target="sop_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                            <input type="file" wire:model="sop_path" id="sop_path" name="sop_path" class="form-control bg-white border-white">
                              @error('sop_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                            <div x-show="isUploading"><progress max="100" x-bind:value="progress"></progress></div>
                          </div>
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
      @endif

      <!----------------------------------------------LIST ALL SOP-------------------------------------------------------------------------------->
      @foreach ($department as $departments)
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc' || (auth()->user()->role == 'employee' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'manager' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'hr' && auth()->user()->department == $departments->name) || (auth()->user()->role == 'pro' && auth()->user()->department == $departments->name))
          <div class="container-fluid pb-4">
            <div class="row">
              <div class="col-md-12">
                
                <div class="card">
                  <div class="card-body">
                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'dc')
                      <h5>{{ $departments->name }}</h5><hr>
                    @else
                      <h6>{{ $departments->name }}</h6><hr>
                    @endif

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                      <!---- 1 FORM ----------------------------------------------------------------------------------------------->
                      <div class="col-12">
                        <div class="accordion-item border">
                          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">01 FORM</button>
                          </h2>
                          
                          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                            
                              <div class="table-responsive">
                                <table class="table table-hover table-sm align-middle">
                                  <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                      <th>NO</th>
                                      <th>TITLE</th>
                                      <th>DESCRIPTION</th>
                                      <th>DATE</th>
                                      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                        <th class="col-2">ACTION</th>
                                      @else
                                        <th>ACTION</th>
                                      @endif
                                    </tr>
                                  </thead>

                                  <tbody>
                                    @php($i = 1)
                                    @foreach ($sop1 as  $key => $sops)
                                      <?php $departmentviews = json_decode($sops->departmentview); ?>
                                      @foreach ($departmentviews as $departmentviewss) 
                                        @if($departmentviewss == $departments->name) 
                                          <tr>
                                            <td class="text-sm text-center">{{ $i++ }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->title }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->description }}</td>
                                            <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                                            <td class="text-center">
                                              @if($sops->sop_path != '')
                                                <a href="{{ $sops->sop_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View Form"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                              @endif
                                              @if($sops->link != '')
                                                <a href="{{ $sops->link }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="Go To Link"><i class="bi bi-box-arrow-right"></i></a>
                                              @endif
                                              @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                                <a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" wire:click="selectItem({{$sops->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$sops->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!------------------------------------ 2 PROCEDURE ----------------------------------------------------------------------------------------------->
                      <div class="col-12">
                        <div class="accordion-item border">
                          <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">02 PROCEDURE</button>
                          </h2>
                          
                          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body">

                              <div class="table-responsive">
                                <table class="table table-hover table-sm align-middle">
                                  <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                      <th>NO</th>
                                      <th>TITLE</th>
                                      <th>DATE</th>
                                      <th>DESCRIPTION</th>
                                      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                        <th class="col-2">ACTION</th>
                                      @else
                                        <th>ACTION</th>
                                      @endif
                                    </tr>
                                  </thead>

                                  <tbody>
                                    @php($i = 1)
                                    @foreach ($sop2 as $key => $sops)
                                      <?php $departmentviews = json_decode($sops->departmentview); ?>
                                      @foreach ($departmentviews as $departmentviewss) 
                                        @if($departmentviewss == $departments->name)  
                                          <tr>
                                            <td class="text-sm text-center">{{ $i++ }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->title }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->description }}</td>
                                            <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                                            <td class="text-center">
                                              @if($sops->sop_path != '')
                                                <a href="{{ $sops->sop_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                              @endif
                                              @if($sops->link != '')
                                                <a href="{{ $sops->link }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="Go To Link"><i class="bi bi-box-arrow-right"></i></a>
                                              @endif
                                              @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                                <a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" wire:click="selectItem({{$sops->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$sops->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!------------------------------------ 3 WORK INSTRUCTION ----------------------------------------------------------------------------------------------->
                      <div class="col-12">
                        <div class="accordion-item border">
                          <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">03 WORK INSTRUCTION</button>
                          </h2>
                          
                          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body">

                              <div class="table-responsive">
                                <table class="table table-hover table-sm align-middle">
                                  <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                      <th>NO</th>
                                      <th>TITLE</th>
                                      <th>DESCRIPTION</th>
                                      <th>DATE</th>
                                      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                        <th class="col-2">ACTION</th>
                                      @else
                                        <th>ACTION</th>
                                      @endif
                                    </tr>
                                  </thead>

                                  <tbody>
                                    @php($i = 1)
                                    @foreach ($sop3 as $key => $sops)
                                      <?php $departmentviews = json_decode($sops->departmentview); ?>
                                      @foreach ($departmentviews as $departmentviewss)
                                        @if($departmentviewss == $departments->name)  
                                          <tr>
                                            <td class="text-sm text-center">{{ $i++ }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->title }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->description }}</td>
                                            <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                                            <td class="text-center">
                                              @if($sops->sop_path != '')
                                                <a href="{{ $sops->sop_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                              @endif
                                              @if($sops->link != '')
                                                <a href="{{ $sops->link }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="Go To Link"><i class="bi bi-box-arrow-right"></i></a>
                                              @endif
                                              @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                                <a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" wire:click="selectItem({{$sops->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$sops->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!------------------------------------ 4 GUIDELINE ----------------------------------------------------------------------------------------------->
                      <div class="col-12">
                        <div class="accordion-item border">
                          <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">04 GUIDELINE</button>
                          </h2>
                          
                          <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingFour">
                            <div class="accordion-body">

                              <div class="table-responsive">
                                <table class="table table-hover table-sm align-middle">
                                  <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                      <th>NO</th>
                                      <th>TITLE</th>
                                      <th>DESCRIPTION</th>
                                      <th>DATE</th>
                                      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                        <th class="col-2">ACTION</th>
                                      @else
                                        <th>ACTION</th>
                                      @endif
                                    </tr>
                                  </thead>

                                  <tbody>
                                    @php($i = 1)
                                    @foreach ($sop4 as $key => $sops)
                                      <?php $departmentviews = json_decode($sops->departmentview); ?>
                                      @foreach ($departmentviews as $departmentviewss)
                                        @if($departmentviewss == $departments->name)  
                                          <tr>
                                            <td class="text-sm text-center">{{ $i++ }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->title }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->description }}</td>
                                            <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                                            <td class="text-center">
                                              @if($sops->sop_path != '')
                                                <a href="{{ $sops->sop_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                              @endif
                                              @if($sops->link != '')
                                                <a href="{{ $sops->link }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="Go To Link"><i class="bi bi-box-arrow-right"></i></a>
                                              @endif
                                              @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                                <a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" wire:click="selectItem({{$sops->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$sops->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!------------------------------------ 5 QUALITY MANUAL ----------------------------------------------------------------------------------------------->
                      <div class="col-12">
                        <div class="accordion-item border">
                          <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">05 QUALITY MANUAL</button>
                          </h2>
                          
                          <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse " aria-labelledby="panelsStayOpen-headingFive">
                            <div class="accordion-body">

                              <div class="table-responsive">
                                <table class="table table-hover table-sm align-middle">
                                  <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                      <th>NO</th>
                                      <th>TITLE</th>
                                      <th>DESCRIPTION</th>
                                      <th>DATE</th>
                                      @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                        <th class="col-2">ACTION</th>
                                      @else
                                        <th>ACTION</th>
                                      @endif
                                    </tr>
                                  </thead>

                                  <tbody>
                                    @foreach ($sop5 as $key => $sops)
                                      <?php $departmentviews = json_decode($sops->departmentview); ?>
                                      @foreach ($departmentviews as $departmentviewss)
                                        @if($departmentviewss == $departments->name)  
                                          <tr>
                                            <td class="text-sm text-center">{{ $i++ }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->title }}</td>
                                            <td class="text-xs fw-bold">{{ $sops->description }}</td>
                                            <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($sops->updated_at))}} </td>
                                            <td class="text-center">
                                              @if($sops->sop_path != '')
                                                <a href="{{ $sops->sop_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                              @endif
                                              @if($sops->link != '')
                                                <a href="{{ $sops->link }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="Go To Link"><i class="bi bi-box-arrow-right"></i></a>
                                              @endif
                                              @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'dc')
                                                <a href="{{ url('dc/edit/sop/'.$sops->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" wire:click="selectItem({{$sops->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$sops->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                      @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!------------------------------------ END ----------------------------------------------------------------------------------------------->
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        @endif
      @endforeach 

      {{-- delete JS function -------------------------------------------------------------------------------------------------------------------------}}
      @push('scripts')
        <script>
          document.addEventListener('livewire:load', function () {
            $(document).on("click", ".data-delete", function (e) {
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