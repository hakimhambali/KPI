<div>
    {{-- START SECTION - USER FORM  --}}
    <div class="row">
        <div class="col-12">

            <form wire:submit.prevent="store">
                <div class="card mb-4 mx-4">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('message') }}</strong>
                    </div>	
                @endif
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
                                <select wire:model="role" name="role" id="role" class="form-select custom-select" data-placeholder="Choose a Role" tabindex="1">
                                    <option value="">-- Choose a Role --</option>
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
                            <button type="submit" class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    {{-- END SECTION - USER FORM  --}}
</div>