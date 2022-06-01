@include('layouts.navbars.auth.nav')
<div>
    @livewire('user-management.user-management-form-wire')
    <!--------------------------- DISPLAY USER ACCORDING TO THEIR ROLE ------------------------------------------------------------------------------------>
    @foreach ($role as $key1 => $roles)
        <div class="container-fluid pb-4">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3 text-uppercase">{{$roles->name}}</h5> 
                            <div class="table-responsive">
                                <table class="table table-hover table-sm align-items-center">
                                    <thead class="text-center text-xxs fw-bold">
                                        <tr>
                                            <th>NO</th>
                                            <th>NAME</th>
                                            <th>IC NUMBER</th>
                                            <th>DATE CREATED</th>
                                            <th class="col-1">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roleArr as $key => $roleArrs)
                                            @foreach ($roleArrs as $key => $roleArrss)
                                            @if($roles->name == $roleArrss->role)
                                        <tr>
                                            <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                            <td class="text-xs font-weight-bold text-xs text-uppercase">{{$roleArrss->name}}</td>
                                            <td class="text-xs text-center font-weight-bold text-xs">{{$roleArrss->ic}}</td>
                                            <td class="text-xs text-center font-weight-bold text-xs">{{$roleArrss->created_at}}</td>
                                            <td>
                                                <button type="button" wire:click="selectItem({{$roleArrss->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile"><i class="fa fa-edit"></i></button>
                                                <button type="button" wire:click="selectItem({{$roleArrss->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$roleArrss->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete User"><i class="fas fa-trash-alt"></i></button>
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
        </div>
    @endforeach

    @push('scripts')
    {{-- START SECTION - SCRIPT FOR DELETE BUTTON  --}}
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
    {{-- END SECTION - SCRIPT FOR DELETE BUTTON  --}}
    @endpush

</div>