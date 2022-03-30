
<div>
    {{-- START SECTION - USER FORM  --}}
    <div class="row">
        <div class="col-lg-4">
            <h3 style="color:black">User Details</h3>
       
            <p class="text-muted">Create a new user by fill up all required field.</p>
        </div>
        <div class="col-lg-12">
            <form wire:submit.prevent="store">
            <div class="card" style="box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;border-radius: 5px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-weight:500">Name</label>
                                <input wire:model="name" type="text" id="name" name="name" class="form-control" >
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-labell" style="font-weight:500">IC Number</label>
                                <input wire:model="ic" type="ic" id="ic" name="ic" class="form-control" >
                                @error('ic') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-weight:500">Password</label>
                                <input wire:model="password" type="password" id="password" name="password" class="form-control" placeholder="">
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label" style="font-weight:500">Role</label>
                                <select wire:model="role" name="role" id="role" class="form-control custom-select" data-placeholder="Choose a Role" tabindex="1">
                                    <option value="">-- Choose a Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="hr">HR</option>
                                    <option value="manager">Manager</option>
                                    <option value="employee">Employee</option>
                                </select>
                                @error('role') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="card-footer" style="background-color: #f9fafb !important;border-top: none;">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            @if (session()->has('message'))
                                {{ session('message') }}
                            @endif
                            <button type="submit" class="btn btn-success btn-sm" style="font-size: 10px"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    {{-- END SECTION - USER FORM  --}}
</div>