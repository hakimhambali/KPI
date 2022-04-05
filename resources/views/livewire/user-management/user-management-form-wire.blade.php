<div>
    {{-- START SECTION - USER FORM  --}}
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
                             
                        <form wire:submit.prevent="store">
                            <div class="card" style="background-color: #dfebf9">
                                <div class="card-body">
                                    <h3>User Details</h3>
                                    <p class="text-sm"><em>Create a new user by fill up all required field.</em></p><hr>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Team Name</label>
                                            <input wire:model="name" type="text" id="name" name="name" class="form-control text-xs" placeholder="Tema Full Name">
                                            @error('name') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">IC Number</label>
                                            <input wire:model="ic" type="ic" id="ic" name="ic" class="form-control text-xs" placeholder="IC Number (without space)">
                                            @error('ic') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Password</label>
                                            <input wire:model="password" type="password" id="password" name="password" class="form-control text-xs" placeholder="Password Team">
                                            @error('password') <span class="error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Role</label>
                                            <select wire:model="role" name="role" id="role" class="form-control bg-white text-xs" data-placeholder="Choose a Role" tabindex="1">
                                            <option value="">-- Choose a Role --</option>
                                            <option value="moderator">Moderator</option>
                                            <option value="hr">HR</option>
                                            <option value="manager">Manager</option>
                                            <option value="employee">Employee</option>
                                        </select>
                                        @error('role') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button class="btn bg-gradient-success btn-sm px-4" type="submit">SAVE</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                       
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- END SECTION - USER FORM  --}}
</div>