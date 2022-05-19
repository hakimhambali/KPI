@include('layouts.navbars.auth.nav')
<div>
    @livewire('user-management.user-management-admin-form-wire')
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
              
                <div class="card">
                    <div class="card-body">
                    <h5 class="mb-3">Moderator, HR & Manager</h5> 
                        @if(!empty($users) && $users->count())  
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-items-center">
                                <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                        <th>NO</th>
                                        <th>NAME</th>
                                        <th>IC NUMBER</th>
                                        <th>ROLE</th>
                                        <th>DATE CREATED</th>
                                        <th class="col-1">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($users as $key => $user)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs text-uppercase">{{$user->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$user->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs text-uppercase">{{$user->role}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$user->created_at}}</td>
                                        <td class="text-center">
                                            <button type="button" wire:click="selectItem({{$user->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit User Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$user->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$user->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete User"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-center">There's No Employee Has Been Added.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
              
                <div class="card">
                    <div class="card-body">
                    <h5 class="mb-3">All Employee</h5> 
                        @if(!empty($employees) && $employees->count())
                        <div class="table-responsive">
                            <table class="table table-hover table-sm align-items-center">
                                <thead class="text-center text-xxs fw-bold">
                                    <tr>
                                        <th>NO</th>
                                        <th>NAME</th>
                                        <th>IC NUMBER</th>
                                        <th>ROLE</th>
                                        <th>DATE CREATED</th>
                                        <th class="col-1">ACTION</th>
                                    </tr>
                                </thead>
                                @foreach ($employees as $key => $employee)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs text-uppercase">{{$employee->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$employee->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs text-uppercase">{{$employee->role}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$employee->created_at}}</td>
                                        <td>
                                            <button type="button" wire:click="selectItem({{$employee->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Employee Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$employee->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$employee->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Employee"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-center">There's No Employee Has Been Added.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
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