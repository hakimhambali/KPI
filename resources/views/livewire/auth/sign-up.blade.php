{{-- {{dd($position)}} --}}
<section class="h-100-vh pb-10">
    <div class="page-header align-items-start py-5" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-3"></span>
        
        <div class="container-fluid pt-6">
            <div class="col-md-6 mx-auto">
                <div class="card z-index-0 px-2 m-2">
                    <div class="card-body">
                        <h2 class="text-center pb-4">Welcome!</h2>

                        <form wire:submit.prevent="register" action="#" method="POST" role="form text-left">
                            <div class="mb-2">
                                <div class="@error('name') border border-danger rounded-3  @enderror">
                                    <input wire:model="name" type="text" class="form-control" placeholder="Full Name (same in IC)" required>
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="@error('email') border border-danger rounded-3 @enderror">
                                        <input wire:model="email" type="email" class="form-control" placeholder="Email Address" required>
                                    </div>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="@error('ic')border border-danger rounded-3 @enderror">
                                        <input wire:model="ic" id="ic" type="ic" class="form-control" placeholder="IC Number" required>
                                    </div>
                                    @error('ic') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="@error('nostaff') border border-danger rounded-3 @enderror">
                                        <input wire:model="nostaff" type="text" class="form-control" placeholder="ID Staff Number" required>
                                    </div>
                                    @error('nostaff') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="@error('starting_month') border border-danger rounded-3 @enderror">
                                        <input wire:model="starting_month" type="text" class="form-control" onfocus="(this.type='date')" placeholder="Date Start Working" required>
                                    </div>
                                    @error('starting_month') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                           
                            <div class="mb-2">
                                <div class="@error('position') border border-danger rounded-3 @enderror">
                                    <select wire:model="position" name="position" id="position" class="form form-select" required>
                                        <option value="">-- Select Position --</option>
                                        @foreach ($position as $positions)
                                            <option value="{{$positions->name}}">{{$positions->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('position') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="@error('department') border border-danger rounded-3 @enderror">
                                        <select wire:model="department" name="department" id="department" class="form form-select" required>
                                            <option value="">-- Select Department --</option>
                                            @foreach ($department as $departments)
                                                <option value="{{$departments->name}}">{{$departments->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
    
                                <div class="col-md-6 mb-2">
                                    <div class="@error('unit') border border-danger rounded-3 @enderror">
                                        <select wire:model="unit" name="unit" id="unit" class="form form-select" required>
                                            <option value="">-- Select Unit --</option>
                                            @foreach ($unit as $units)
                                                <option value="{{$units->name}}">{{$units->name}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    @error('unit') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            
                            <div class="mb-2">
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label" for="flexCheckDefault"> I hereby declare that the information provided is true and correct.</label>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 mt-3 mb-1">Sign up</button>
                            </div>
                            <p class="text-sm text-center mb-2">Already have an account? <a href="{{ route('login') }}" class="fw-bolder">Sign in</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>