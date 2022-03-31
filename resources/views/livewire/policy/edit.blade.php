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
                      <form action="{{ url('/hr/update/policy/'.$id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      @foreach ($policy as $policys)  
                        <div class="card-body">
                          <h6>EDIT POLICY</h6><hr>

                          <div class="col-md-12 mb-3 mt-2">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" value="{{ $policys->title }}" placeholder="Please Insert Title of Policy" required>
                          </div>

                          <div class="row">
                            <div class="col-md-4 mb-3" id="policyupload">
                              <div class="form-group">
                                <label class="form-label">Policy Upload<span class="text-danger">*</span></label>
                                <div
                                    x-data="{ isUploading: false, progress: 0 }"
                                    x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                  <div wire:loading wire:target="policy_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                                  <input type="file" wire:model="policy_path" id="policy_path" name="policy_path" class="form-control bg-white border-white" value="{{ $policys->policy_path }}" />
                                    @error('policy_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                  <div x-show="isUploading"><progress max="100" x-bind:value="progress"></progress></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-8 mb-3">
                              <label class="form-label">Description<span class="text-danger">*</span></label>
                              <textarea class="form-control" name="description" id="description" rows="11" placeholder="Please insert the policy description here...">{{ $policys->description }}</textarea>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                                <a class="btn bg-gradient-danger btn-sm" href="{{ route('policy') }}" title="Previous Page"><i class="bi bi-caret-left-fill"></i></a>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn bg-gradient-dark btn-sm px-4 text-end" type="submit" href="javascript:;">Save</button>
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
    
        </body>
    </div>
    </div>
    @endsection

    
    
    