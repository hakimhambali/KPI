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
      @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin'|| auth()->user()->department == 'Operation')
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
                                      <div class="col-6 d-flex align-items-center"><h6>MEMO</h6></div>
                                  </div>
                              </div>
                              <form action="{{ url('/hr/create/memo') }}" method="post" enctype="multipart/form-data">
                              @csrf  
                              <div class="card-body p-3">
                                <div class="row">
                                  <label class="font-weight-bold">Title<span class="text-danger">*</span></label>
                                  <div class="card card-plain border-radius-lg align-items-center">
                                      <input class="form-control form-control-lg" type="text" name="title" value="{{ old('title') }}" required>
                                  </div>
                                  <div class="col-md-4 mt-2" id="memoupload">
                                      <div class="form-group">
                                          <label class="font-weight-bold">Memo Upload<span class="text-danger">*</span></label>
                                          <div
                                              x-data="{ isUploading: false, progress: 0 }"
                                              x-on:livewire-upload-start="isUploading = true"
                                              x-on:livewire-upload-finish="isUploading = false"
                                              x-on:livewire-upload-error="isUploading = false"
                                              x-on:livewire-upload-progress="progress = $event.detail.progress">
                                          <div wire:loading wire:target="memo_path"><i class="mdi mdi-loading mdi-spin mdi-24px"></i></div>
                                              <input type="file" wire:model="memo_path" id="memo_path" name="memo_path" class="dropify" required />
                                              @error('memo_path') <span class="error" style="color:red"><b>{{ $message }}</b></span> @enderror
                                              <div x-show="isUploading">
                                                  <progress max="100" x-bind:value="progress"></progress>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <label class="font-weight-bold" >Description<span class="text-danger">*</span></label>
                                      <textarea class="form-control card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" name="description" id="description" cols="60" rows="10" placeholder="Type your description here..."  required></textarea>
                                      </div>
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
  
      <div class="container-fluid py-4">
          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <div class="card-header pb-0">
                  <h6>All Memo</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Posted</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Memo</th>
                          @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin'|| auth()->user()->department == 'Operation')
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @php($i = 1)
                        @foreach ($memo as $key => $memos)
                          <tr>
                            <td>    
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <p class="mb-0 text-sm" value="{{$key + 1}}">{{$key + 1}}</p>
                                </div>
                              </div>
                            </td>
                            <td>
                              <pre class="text-xs font-weight-bold mb-0" value="{{ $memos->title }}">{{ $memos->title }}</pre>
                            </td>
                            <td>
                              <pre class="text-xs mb-0" value="{{ $memos->description }}">{{  $memos->description }}</pre>
                            </td>
                            <td class="text-xs mb-0">
                              <b>{{date('j F Y', strtotime($memos->updated_at))}} </b> <br>
                              by {{  $memos->user->name }}
                            </td>
                            <td class="align-middle text-center">
                              <a href=" {{ $memos->memo_path }}" style="color:blue;text-decoration:underline;font-size:13.5px"; target="_blank">View</a>
                            </td>
                            @if (auth()->user()->role == 'hr' || auth()->user()->role == 'admin'|| auth()->user()->department == 'Operation')
                            <td class="align-middle">
                              <div class="col-lg-6 col-5 my-auto text-middle">
                                <div class="dropdown float-lg-start pe-4">
                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                  </a>
                                  <ul class="dropdown-menu px-2 py-3 ms-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a href="{{ url('hr/edit/memo/'.$memos->id) }}" class="dropdown-item border-radius-md" role="button">Edit</a></li>
                                    <li><button type="button" wire:click="selectItem({{$memos->id}})" class="dropdown-item border-radius-md data-delete" style="color: red;" data-form="{{$memos->id}}">Delete</button></li>
                                  </ul>
                                </div>
                              </div>
                            </td>
                            @endif
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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
  
  
  