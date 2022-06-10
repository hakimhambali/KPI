<div>
    @include('layouts.navbars.guest.login')
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-7">
                        <div class="card-header pb-0 text-center bg-transparent">
                            <h4 class="mb-0">Forgot Your Password?</h4>
                            <p class="mb-0 text-sm">Enter your registered information and new password here<p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible p-2 mx-2">
                                <strong><small>{{ session('success') }}</small></strong>
                            </div>
                            <a href="{{ route('login') }}" class="btn bg-gradient-info text-white btn-sm">Log In Now!</a>
                        @elseif (session('error'))
                            <div class="alert alert-warning alert-dismissible p-2 mx-2">
                                <strong><small>{{ session('error') }}</small></strong>
                            </div>
                        @endif

                        <div class="card-body">
                            <form action="{{ route('reset-save') }}" method="POST" role="form text-left">
                                @csrf
                                <div>
                                    <label>IC Number<span class="text-danger">*</span></label>
                                    <div class="@error('ic')border border-danger rounded-3 @enderror mb-2">
                                        <input name="ic" id="ic" type="ic" class="form-control" placeholder="Enter Your IC Number" required>
                                    </div>
                                    @error('ic') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label>Email Address<span class="text-danger">*</span></label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror mb-2">
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Enter Your Email Address" required>
                                    </div>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label>New Password<span class="text-danger">*</span></label>
                                    <div class="@error('password')border border-danger rounded-3 @enderror mb-2">
                                        <input name="password" id="password" type="password" class="form-control" placeholder="Enter Your New Password" required>
                                    </div>
                                    @error('password') <div class="text-danger text-sm">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label>New Password Confirmation<span class="text-danger mt-0 mb-2">*</span></label>
                                    <div
                                        class="@error('passwordConfirmation')border border-danger rounded-3 @enderror mb-4">
                                        <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Enter Your Password Confirmation" required>
                                    </div>
                                    @error('password_confirmation') <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mb-5">Reset Password</button>
                                </div>
                            </form>
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
</div>
