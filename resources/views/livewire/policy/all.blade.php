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
        @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin')
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
                      <form action="{{ url('/hr/create/policy') }}" method="post" enctype="multipart/form-data">
                      @csrf  
                        <div class="card-body">
                          <h6>CREATE POLICY</h6><hr>

                          <div class="col-md-12 mb-3 mt-2">
                            <label class="form-label">Title<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="Please Insert Title of Policy" required>
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
                                  <input type="file" wire:model="policy_path" id="policy_path" name="policy_path" class="form-control bg-white border-white" required />
                                    @error('policy_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                  <div x-show="isUploading"><progress max="100" x-bind:value="progress"></progress></div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-8 mb-3">
                              <label class="form-label">Description<span class="text-danger">*</span></label>
                              <textarea class="form-control" name="description" id="description" rows="11" placeholder="Please insert the policy description here..."></textarea>
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
            </div>
          </div>
        @endif

        <div class="container-fluid py-4">
          <div class="row">
            <div class="col-md-12">
              
              <div class="card">
                <div class="card-body">
                  <h6 class="mb-3">ALL POLICY</h6>

                  @if(!empty($policy) && $policy->count())
                    <div class="table-responsive">
                      <table class="table table-hover table-sm align-middle">
                        <thead class="text-center text-xxs fw-bold">
                          <tr>
                            <th>NO</th>
                            <th>TITLE</th>
                            <th>DESRIPTION</th>
                            <th>TEAM</th>
                            <th>DATE</th>
                            @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin')
                              <th class="col-2">ACTION</th>
                            @else
                              <th>ACTION</th>
                            @endif
                          </tr>
                        </thead>

                        <tbody>
                          @php($i = 1)
                          @foreach ($policy as $key => $policys)
                            <tr>
                              <td class="text-xs text-center">{{ $key + 1 }}</td>
                              <td class="text-xs fw-bold">{{ $policys->title }}</td>
                              <td class="text-xs">{{ $policys->description }}</td>
                              <td class="text-xs">
                                <b>{{  $policys->user->name }}</b> <br>
                                {{ $policys->user->position }}
                              </td>
                              <td class="text-xs fw-bold text-center">{{date('j F Y', strtotime($policys->updated_at))}}</td>
                              <td class="text-center">
                                <a href="{{ $policys->policy_path }}" class="btn btn-info btn-sm btn-icon" target="_blank" data-bs-toggle="tooltip" data-bs-original-title="View File"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                                @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin')
                                  <a href="{{ url('hr/edit/policy/'.$policys->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Edit"><i class="bi bi-pencil-square"></i></a>
                                  <button type="button" wire:click="selectItem({{$policys->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$policys->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    @else
                      <p class="text-center">There's No Policy Has Been Added.</p>
                    @endif
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
    
    
    