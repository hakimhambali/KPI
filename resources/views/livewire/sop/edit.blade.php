@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')
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

                <div class="row">
                  <div class="col-md-12 mb-lg-0 mb-4">
                    @if (session('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>{{ session('message') }}</strong></div>	
                    @endif
                    @if (session('fail'))
                      <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>{{ session('fail') }}</strong></div>
                    @endif
                              
                    <div class="card">
                      <form action="{{ url('/dc/update/sop/'.$id) }}" method="post" enctype="multipart/form-data">
                      @csrf  
                        <div class="card-body">
                          <h6>EDIT STANDARD OPERATING PROCEDURES (SOP)</h6><hr>
                          @foreach ($sop as $sops)
                          <div class="col-md-12 mb-3 mt-2">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" value="{{ $sops->title }}" placeholder="Please Insert Title of SOP" required>
                          </div>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label class="form-label">For Department<span class="text-danger">*</span></label>
                              <select class="form-select" id="department" name="department" required>
                                <option selected class="bg-secondary text-white" value="{{ $sops->department }}" >{{ $sops->department }}</option>
                                @foreach ($department as $departments)
                                <option value="{{$departments->name}}">{{$departments->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label class="form-label">Document Type<span class="text-danger">*</span></label>
                              <select class="form-select" id="part" name="part" required>
                                <option selected class="bg-secondary text-white" value="{{ $sops->part }}" >{{ $sops->part }}</option>
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
                              <textarea class="form-control" name="description" id="description" rows="11" placeholder="Please insert the SOP description here...">{{ $sops->description }}</textarea>
                            </div>

                            {{-- <div class="col-md-6 mb-3">
                              <label class="form-label">View by Department<span class="text-danger">*</span></label><br>
                              @php $departmentviews = json_decode($sops->departmentview); @endphp
                              @foreach ($department as $departments)
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="{{$departments->name}}" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == '{{$departments->name}}') checked @endif @endforeach><label for="departmentview">{{$departments->name}}</label><br>
                              @endforeach
                            </div> --}}

                            <div class="col-md-6 mb-3">
                              <label class="form-label">View by Department<span class="text-danger">*</span></label><br>
                              @php $departmentviews = json_decode($sops->departmentview); @endphp
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Senior Leadership Team (SLT)" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Senior Leadership Team (SLT)') checked @endif @endforeach><label for="departmentview">Senior Leadership Team (SLT)</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="CEO Office" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'CEO Office') checked @endif @endforeach><label for="departmentview">CEO Office</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Human Resource (HR) & Administration" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Human Resource (HR) & Administration') checked @endif @endforeach><label for="departmentview">Human Resource (HR) & Administration</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Account & Finance (A&F)" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Account & Finance (A&F)') checked @endif @endforeach><label for="departmentview">Account & Finance (A&F)</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Sales" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Sales') checked @endif @endforeach><label for="departmentview">Sales</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Marketing" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Marketing') checked @endif @endforeach><label for="departmentview">Marketing</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Operation" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Operation') checked @endif @endforeach><label for="departmentview">Operation</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="High Network Client (HNC)" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'High Network Client (HNC)') checked @endif @endforeach><label for="departmentview">High Network Client (HNC)</label><br>
                                <input type="checkbox" id="departmentview" name="departmentview[]" value="Research & Development (R&D)" @foreach ($departmentviews as $departmentviewss) @if($departmentviewss == 'Research & Development (R&D)') checked @endif @endforeach><label for="departmentview">Research & Development (R&D)</label><br>
                            </div>
                            
                          </div>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label class="form-label">Link SOP<span class="text-danger">*</span></label>
                              <input class="form-control" type="text" name="link" value="{{ $sops->link }}" placeholder="Please Insert link">
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

                          <div class="row">
                            <div class="col-6">
                                <a class="btn bg-gradient-danger btn-sm" href="{{ route('sop') }}" title="Previous Page"><i class="bi bi-caret-left-fill"></i></a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn bg-gradient-dark btn-sm px-4 text-end" type="submit" href="javascript:;">Save</button>
                            </div>
                          </div>

                          @endforeach
                        </div>
                      </form>     
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
    
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
    @endsection

    
    
    