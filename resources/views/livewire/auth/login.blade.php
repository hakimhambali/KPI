<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder text-info text-gradient">{{ __('Welcome back') }}</h3>
                            <p class="mb-0">{{__('Login with your credentials:') }}</p>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                  @if (session('message'))
                                    <div class="alert alert-success alert-dismissible fade show my-0" role="alert"><strong class="text-xxs">{{ session('message') }}</strong></div>	
                                  @endif
                                </div>
                            </div>

                            <form wire:submit.prevent="login" action="#" method="POST" role="form text-left">
                                <div class="mb-3">
                                    <label for="ic">IC Number</label>
                                    <div class="@error('ic')border border-danger rounded-3 @enderror">
                                        <input wire:model="ic" id="ic" type="ic" class="form-control" placeholder="IC Number" aria-label="Ic" aria-describedby="ic-addon">
                                    </div>
                                    @error('ic') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <div class="@error('password')border border-danger rounded-3 @enderror">
                                        <input wire:model="password" id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-check form-switch">
                                    <input wire:model="remember_me" class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign In</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <a href="{{ route('sign-up') }}" class="btn bg-gradient-dark w-100 mt-2 mb-0">Create New Account</a>
                            </div>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Forgot Password?
                                <a href="{{ route('reset-password') }}"
                                    class="text-danger text-gradient font-weight-bold">{{ __('Reset Password') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                            style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
