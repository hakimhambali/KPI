<div>
    @livewire('user-management.user-management-form-wire')
    <!--------------------------- Moderator ------------------------------------------------------------------------------------>
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Moderators</h5> 
                        @if(!empty($moderator) && $moderator->count())
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
                                @foreach ($moderator as $key => $moderators)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs">{{$moderators->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$moderators->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$moderators->created_at}}</td>
                                        <td>
                                            <button type="button" wire:click="selectItem({{$moderators->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$moderators->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$moderators->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Moderator"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-center">There's No Moderator Has Been Added.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------------------------- HR ------------------------------------------------------------------------------------>
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Human Resources (HRs)</h5> 
                        @if(!empty($hr) && $hr->count())
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
                                @foreach ($hr as $key => $hrs)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs">{{$hrs->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$hrs->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$hrs->created_at}}</td>
                                        <td>
                                            <button type="button" wire:click="selectItem({{$hrs->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$hrs->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$hrs->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete HR"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-center">There's No HR Has Been Added.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------------------------- Manager ------------------------------------------------------------------------------------>
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Managers</h5> 
                        @if(!empty($manager) && $manager->count())
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
                                @foreach ($manager as $key => $managers)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs">{{$managers->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$managers->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$managers->created_at}}</td>
                                        <td>
                                            <button type="button" wire:click="selectItem({{$managers->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$managers->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$managers->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Manager"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p class="text-center">There's No Manager Has Been Added.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------------------------- Employee ------------------------------------------------------------------------------------>
    <div class="container-fluid pb-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Employees</h5> 
                        
                        @if(!empty($employee) && $employee->count())
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
                                @foreach ($employee as $key => $employees)
                                <tbody>
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$key+1}}</td>
                                        <td class="text-xs font-weight-bold text-xs">{{$employees->name}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$employees->ic}}</td>
                                        <td class="text-xs text-center font-weight-bold text-xs">{{$employees->created_at}}</td>
                                        <td>
                                            <button type="button" wire:click="selectItem({{$employees->id}} , 'update' )" class="btn btn-sm waves-effect waves-light btn-dark" style="font-size: 10px" data-bs-toggle="tooltip" data-bs-original-title="Edit Profile"><i class="fa fa-edit"></i></button>
                                            <button type="button" wire:click="selectItem({{$employees->id}} , 'delete' )" class="btn btn-sm waves-effect waves-light btn-danger data-delete" data-form="{{$employees->id}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Employee"><i class="fas fa-trash-alt"></i></button>
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