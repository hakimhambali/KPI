{{-- {{dd($position)}} --}}
<section class="h-100-vh mb-8">
    <div class="page-header align-items-start section-height-50 pt-5 pb-11 m-3 border-radius-lg"
        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">{{ __('Welcome!') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>{{ __('Fill in your information to register your account') }}</h5>
                    </div>
                    <div class="card-body">

                        <form wire:submit.prevent="register" action="#" method="POST" role="form text-left">
                            <div class="mb-3">
                                <div class="@error('name') border border-danger rounded-3  @enderror">
                                    <input wire:model="name" type="text" class="form-control" placeholder="Full Name (same in* IC)"
                                        aria-label="Name" aria-describedby="email-addon">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <div class="@error('email') border border-danger rounded-3 @enderror">
                                    <input wire:model="email" type="email" class="form-control" placeholder="Email"
                                        aria-label="Email" aria-describedby="email-addon">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <div class="@error('ic')border border-danger rounded-3 @enderror">
                                    <input wire:model="ic" id="ic" type="ic" class="form-control"
                                        placeholder="IC Number" aria-label="Ic" aria-describedby="ic-addon">
                                </div>
                                @error('ic') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <div class="@error('nostaff') border border-danger rounded-3 @enderror">
                                    <input wire:model="nostaff" type="text" class="form-control" placeholder="ID No"
                                        aria-label="Nostaff" aria-describedby="email-addon">
                                </div>
                                @error('nostaff') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            {{-- @if(!empty($position) && $position->count()) --}}
                            <div class="mb-3">
                                <div class="@error('position') border border-danger rounded-3 @enderror">
                                        <select wire:model="position" name="position" id="position" class="form-control custom-select" data-placeholder="Choose Position" tabindex="1">
                                            @foreach ($position as $positions)
                                                <option value="{{$positions->name}}">{{$positions->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('position') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            {{-- @endif --}}
                            <div class="mb-3">
                                <div class="@error('department') border border-danger rounded-3 @enderror">
                                        <select wire:model="department" name="department" id="department" class="form-control custom-select" data-placeholder="Choose Department" tabindex="1">
                                            @foreach ($department as $departments)
                                                <option value="{{$departments->name}}">{{$departments->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('department') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="@error('unit') border border-danger rounded-3 @enderror">
                                    <select wire:model="unit" name="unit" id="unit" class="form-control custom-select" data-placeholder="Choose Unit" tabindex="1">

                                        @foreach ($unit as $units)
                                            <option value="{{$units->name}}">{{$units->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                @error('unit') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input wire:model="password" type="password" class="form-control"
                                        placeholder="Password" aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ __('I agree the') }} <a href="javascript:;"
                                        class="text-dark font-weight-bolder">{{ __('Terms
                                        and
                                        Conditions') }}</a>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">{{ __('Already have an account? ') }}<a
                                    href="{{ route('login') }}"
                                    class="text-dark font-weight-bolder">{{ __('Sign in') }}</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
