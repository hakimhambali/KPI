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
                            <div class="mb-3">
                                <div class="@error('position') border border-danger rounded-3 @enderror">
                                        <select wire:model="position" name="position" id="position" class="form-control custom-select" data-placeholder="Choose Position" tabindex="1">
                                            <option class="text-center" value="">-- Choose Position --</option>
                                            <option value="CEO (TM2)">CEO (TM2)</option>
                                            <option value="Director (TM1)">Director (TM1)</option>
                                            {{-- <option value="COO (UM4)">COO (UM4)</option>
                                            <option value="Senior General Manager (UM3)">Senior General Manager (UM3)</option>
                                            <option value="General Manager (UM2)">General Manager (UM2)</option>
                                            <option value="Deputy General Manager (UM1)">Deputy General Manager (UM1)</option> --}}
                                            <option value="Senior Leadership Team (SLT) (UM1)">Senior Leadership Team (SLT) (UM1)</option>
                                            <option value="Senior Manager (M3)">Senior Manager (M3)</option>
                                            <option value="Manager (M2)">Manager (M2)</option>
                                            <option value="Assistant Manager (M1)">Assistant Manager (M1)</option>
                                            <option value="Senior Executive (E3)">Senior Executive (E3)</option>
                                            <option value="Executive (E2)">Executive (E2)</option>
                                            <option value="Junior Executive (E1)">Junior Executive (E1)</option>
                                            <option value="Senior Non-Executive (NE2)">Senior Non-Executive (NE2)</option>
                                            <option value="Junior Non-Executive (NE1)">Junior Non-Executive (NE1)</option>
                                        </select>
                                </div>
                                @error('position') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <div class="@error('department') border border-danger rounded-3 @enderror">
                                        <select wire:model="department" name="department" id="department" class="form-control custom-select" data-placeholder="Choose Department" tabindex="1">
                                            <option class="text-center" value="">-- Choose Department --</option>
                                            <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                                            <option value="CEO Office">CEO Office</option>
                                            <option value="Human Resource (HR) & Administration">Human Resource (HR) & Administration</option>
                                            <option value="Account & Finance (A&F)">Account & Finance (A&F)</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Operation">Operation</option>
                                            <option value="High Network Client (HNC)">High Network Client (HNC)</option>
                                            <option value="Research & Development (R&D)">Research & Development (R&D)</option>
                                        </select>
                                </div>
                                @error('department') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <div class="@error('unit') border border-danger rounded-3 @enderror">
                                    <select wire:model="unit" name="unit" id="unit" class="form-control custom-select" data-placeholder="Choose Unit" tabindex="1">
                                        
                                        {{-- Head Department --}}
                                        <option class="text-center" value="">-- Others --</option>
                                        <option value="Head Department">Head Department</option>
                                        <option value="Senior Leadership Team (SLT)">Senior Leadership Team (SLT)</option>
                                        {{-- CEO Office --}}
                                        <option class="text-center" value="">-- CEO Office --</option>
                                        <option value="Personal Assistant">Personal Assistant</option>
                                        <option value="Document Controller">Document Controller</option>
                                        <option value="Driver & Logistic">Driver & Logistic</option>
                                        {{-- HR & Admin --}}
                                        <option class="text-center" value="">-- Human Resource (HR) & Administration --</option>
                                        <option value="Payroll and C&B">Payroll and C&B</option>
                                        <option value="Training & Development">Training & Development</option>
                                        <option value="Admin Procurement">Admin Procurement</option>
                                        <option value="Recruitment">Recruitment</option>
                                        {{-- A&F --}}
                                        <option class="text-center" value="">-- Account & Finance (A&F) --</option>
                                        <option value="Account Receivable">Account Receivable</option>
                                        <option value="Account Payable">Account Payable</option>
                                        {{-- Sales --}}
                                        <option class="text-center" value="">-- Sales --</option>
                                        <option value="Customer Support & Closing">Customer Support & Closing</option>
                                        <option value="Program">Program</option>
                                        {{-- Marketing --}}
                                        <option class="text-center" value="">-- Marketing --</option>
                                        <option value="Creative & Branding">Creative & Branding</option>
                                        <option value="Content">Content</option>
                                        <option value="Media">Media</option>
                                        <option value="Social Media">Social Media</option>
                                        <option value="Digital Marketer">Digital Marketer</option>
                                        {{-- Operation --}}
                                        <option class="text-center" value="">-- Operation --</option>
                                        <option value="Admin & Procurement">Admin & Procurement</option>
                                        <option value="Backstage">Backstage</option>
                                        <option value="Inventory & Logistic">Inventory & Logistic</option>
                                        <option value="General Worker">General Worker</option>
                                        {{-- HNC --}}
                                        <option class="text-center" value="">-- High Network Client (HNC) --</option>
                                        <option value="Platinum">Platinum</option>
                                        <option value="Ultimate">Ultimate</option>
                                        <option value="Graphic">Graphic</option>
                                        {{-- R&D --}}
                                        <option class="text-center" value="">-- Research & Development (R&D) --</option>
                                        <option value="Web Designer">Web Designer</option>
                                        <option value="Web Developer">Web Developer</option>
                                        <option value="Data Analytic">Data Analytic</option>
                                        <option class="text-center" value="">-- Choose Unit --</option>
                                        
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
