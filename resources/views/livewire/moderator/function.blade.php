@section('content')
  @extends('layouts.app')
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

                    <div class="card">
                      <form action="{{ url('/moderator/create/function') }}" method="post" enctype="multipart/form-data">
                      @csrf  
                        <div class="card-body">
                          <h6>FUNCTION FORM</h6><hr>

                          <div class="row">
                            <div class="col-md-6 mb-3 mt-2">
                              <label class="form-label">Function Name<span class="text-danger">*</span></label>
                              <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Eg: Kad Skor Korporat1" required>
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
    
            <div class="container-fluid py-4">
              <div class="row">
                <div class="col-md-12">
                  
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-3">ALL FUNCTIONS</h6>

                      <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle">
                          <thead class="text-center text-xxs fw-bold opacity-7">
                            <tr>
                              <th>NO</th>
                              <th>NAME</th>
                              <th>STATUS</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>

                          <tbody>
                            @php($i = 1)
                            @foreach ($function as $key => $functions)
                              <tr>
                                <td class="text-sm text-center">{{$key + 1}}</td>
                                <td class="text-xs fw-bold">{{ $functions->name }}</td>
                                <td class="text-xs fw-bold text-center">{{ $functions->status }}</td>
                                <td class="text-center mx-auto">
                                  @if ($functions->status == 'inactive')
                                    <a href="{{ url('moderator/up/function/'.$functions->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Change Status"><i class="bi bi-pencil-square"></i></a>
                                  @else
                                    <a href="{{ url('moderator/down/function/'.$functions->id) }}" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Change Status"><i class="bi bi-pencil-square"></i></a>
                                  @endif
                                </td>
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
@endsection
    
    