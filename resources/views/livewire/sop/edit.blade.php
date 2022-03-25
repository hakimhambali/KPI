@section('content')
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
                                <form action="{{ url('/dc/update/sop/'.$id) }}" method="post" enctype="multipart/form-data">
                                @csrf  
                                @foreach ($sop as $sops)
                                <div class="card-body p-3">
                                  <div class="row">
                                    <label class="font-weight-bold">Title</label>
                                    <div class="card card-plain border-radius-lg align-items-center">
                                        <input class="form-control form-control-lg" type="text" name="title" value="{{ $sops->title }}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="row">
                                            <label class="font-weight-bold">For Department</label>
                                            <div class="card card-plain border-radius-lg align-items-center">
                                              <select class="form-select form-select-lg" id="department" name="department">
                                                  <option selected class="bg-secondary text-white" value="{{ $sops->department }}" >{{ $sops->department }}</option>
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
                                                  <option selected class="bg-secondary text-white" value="{{ $sops->part }}" >{{ $sops->part }}</option>
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

                                    <div class="card-body p-3">
                                      <div class="row">
                                        <div class="col-md-6 mb-md-0">
                                          <div class="row">
                                            <label class="font-weight-bold">Link SOP (Optional)</label>
                                            <div class="card card-plain border-radius-lg align-items-center">
                                              <input type="text" class="form-control" id="link" name="link" value="{{ $sops->link }}" >
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
                                              <input type="file" wire:model="sop_path" id="sop_path" name="sop_path" class="dropify" value="{{ $sops->sop_path }}"/>
                                              @error('sop_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                              <div x-show="isUploading">
                                                  <progress max="100" x-bind:value="progress"></progress>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="mt-2" style="text-align: right">
                                        <div class="col-12 text-end">
                                          <button class="btn bg-gradient-dark mb-0" type="submit" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;SAVE</button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
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

    
    
    