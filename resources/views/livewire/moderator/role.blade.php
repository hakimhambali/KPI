{{----------------------------------- ADD ROLE (MODERATOR) ----------------------------------------------------------------------------------}}
@section('content')
@include('layouts.navbars.auth.nav')
  @extends('layouts.app')
  <div>
    <body>

      <div class="container-fluid pb-4">
        <div class="row">
          <div class="col-lg-12">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"><strong>{{ session('message') }}</strong></div>	
            @endif
            @if (session('fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>{{ session('fail') }}</strong></div>
            @endif

            <form action="{{ url('/moderator/create/role') }}" method="post">
              @csrf
              <div class="card" style="background-color: #dfebf9">
                <div class="card-body">
                  <h6>ADD ROLE FORM</h6><hr>

                  <div class="row">
                    <div class="col-md-7">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text fw-bold">Role Name<span class="text-danger">* </span></span>
                        </div>
                        <input class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Eg: Employee" required>
                      </div>
                    </div>
                  
                    
                    <div class="col-md-5 my-auto">
                      <button class="btn bg-gradient-dark btn-sm px-4" type="submit" href="javascript:;">SAVE</button>
                    </div>
                  </div>
                    
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>

      <div class="container-fluid pb-4">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card">
              <div class="card-body">
                <h6 class="mb-3">ALL ROLES</h6>

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
                      @foreach ($role as $key => $roles)
                        <tr>
                          <td class="text-sm text-center">{{$key + 1}}</td>
                          <td class="text-xs fw-bold text-uppercase">{{ $roles->name }}</td>
                          <td class="text-xs fw-bold text-center text-capitalize">{{ $roles->status }}</td>
                          <td class="text-center">
                            <button type="button" datax="{{$roles->id}}" class="btn btn-danger my-auto btn-sm btn-icon data-delete" data-bs-toggle="tooltip" data-bs-original-title="Delete"><i class="bi bi-trash3-fill"></i></button>
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

      {{-- Delete JS function --}}
      @push('scripts')
        <script>
          document.addEventListener('livewire:load', function () {
            $(document).on("click", ".data-delete", function (e) {
              var id = $(this).attr('datax');
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
                  location.href = "{{ url('/moderator/delete/role') }}" + '/' + id;
                } 
              });
            });
          })
        </script>
      @endpush
    </body>
  </div>
@endsection