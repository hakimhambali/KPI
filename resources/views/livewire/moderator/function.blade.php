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
                      <form action="{{ url('/pro/create/function') }}" method="post" enctype="multipart/form-data">
                      @csrf  
                        <div class="card-body">
                          <h6>FUNCTION FORM</h6><hr>

                          <div class="row">
                            <div class="col-md-6 mb-3 mt-2">
                              <label class="form-label">Function Name<span class="text-danger">*</span></label>
                              <input class="form-control" type="text" name="level" value="{{ old('level') }}" placeholder="Eg: Tingkat 1" required>
                            </div>
                          </div>
                        </div>
                      </form>     
                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
    
          @if (auth()->user()->role == 'admin'|| auth()->user()->role == 'pro')
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
                              <th>DEPARTMENT</th>
                              <th>DATE</th>
                              <th>LOCATION</th>
                              <th>CATEGORY</th>
                              <th>DESCRIPTION</th>
                              <th>STATUS</th>
                              @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pro')
                                <th>ACTION</th>
                              @endif
                            </tr>
                          </thead>

                          <tbody>
                            @php($i = 1)
                            @foreach ($function as $key => $functions)
                              <tr>
                                <td class="text-sm text-center">{{$key + 1}}</td>
                                <td class="text-xs">
                                  <b>{{ $functions->user->name }}</b><br>
                                  {{ $functions->user->position }}
                                </td>
                                <td class="text-xs fw-bold">{{ $functions->user->department }}</td>
                                <td class="text-xs fw-bold">{{ date('d/m/Y', strtotime($functions->updated_at)) }}</td>
                                <td class="text-xs fw-bold">
                                  {{ $functions->location }}<br>
                                  @if($functions->office != NULL)
                                    <?php $offices = json_decode($functions->office); ?>
                                    ( @foreach ($offices as $officess)
                                      {{ $officess }}
                                    @endforeach
                                    ) <br>
                                  @endif
                                  - {{ $functions->level }}
                                </td>
                                <td class="text-xs fw-bold">
                                  <?php $categorys = json_decode($functions->category); ?>
                                  @foreach ($categorys as $categoryss)
                                  <i class="bi bi-diamond-fill "></i> {{ $categoryss }} <br>
                                  @endforeach
                                  </ul>
                                </td>
                                <td class="text-xs fw-bold">{{ $functions->description }}</td>
                                <td class="text-center text-xs">
                                  @if($functions->status == "Complete")
                                    <span class="badge bg-success badge-sm">{{ $functions->status }}</span>
                                  @else
                                    <span class="badge bg-danger">{{ $functions->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                  <form action="{{ route('function/update', $functions->id)}}" method="post">
                                    @csrf
                                    @if($functions->status == "Incomplete")
                                      <button type="submit" class="btn btn-dark btn-sm btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Update Status"><i class="bi bi-pencil-square"></i></button>
                                    @endif
                                    <button type="button" wire:click="selectItem({{$functions->id}})" class="btn btn-danger btn-sm btn-icon data-delete" data-form="{{$functions->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
                                  </form>
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
            @endif
    
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
    
    