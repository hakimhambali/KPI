<x-layouts.base>
     <!--JQuery -->
    {{-- <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    {{-- If the user is authenticated --}}
    @auth()
        {{-- If the user is authenticated on the static sign up or the sign up page --}}
        @if (auth()->user()->role == 'admin')
            @include('layouts.navbars.auth.sidebar')
            {{-- @include('livewire.kpi.edit') --}}
            @include('layouts.navbars.auth.nav')
            @include('components.plugins.fixed-plugin')
            @if (isset($slot))
                {{ $slot }} 
            @endif
            @yield('content')
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.auth.footer')
                    </div>
                </div>
            </main>
        @else
            @include('layouts.navbars.auth.sidebar')
            @include('layouts.navbars.auth.nav')
            @include('components.plugins.fixed-plugin')
            @if (isset($slot))
                {{ $slot }} 
            @endif
            @yield('content')
            <main>
                <div class="container-fluid">
                    <div class="row">
                        @include('layouts.footers.auth.footer')
                    </div>
                </div>
            </main>
        @endif
    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the login page --}}
        @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
            @include('layouts.navbars.guest.login')
            @if (isset($slot))
                {{ $slot }} 
            @endif
            @yield('content')
            <div class="mt-5">
                @include('layouts.footers.guest.with-socials')
            </div>
            {{-- If the user is on the sign up page --}}
        @elseif (!auth()->check() && in_array(request()->route()->getName(),['sign-up'],))
            <div>
                @include('layouts.navbars.guest.sign-up')
                @if (isset($slot))
                {{ $slot }} 
            @endif
                @yield('content')
                @include('layouts.footers.guest.with-socials')
            </div>
        @endif
    @endguest

    {{-- @livewireScripts --}}
   
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ url('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ url('assets/plugins/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ url('assets/plugins/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('assets/plugins/custom.min.js') }}"></script>
    <!-- Sweet alert -->
    <script src="{{asset('assets/plugins/sweetalert/sweetalert2.min.js')}}"></script>
    <!-- Icon font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <!-- Magnific popup JavaScript -->
    <script src="{{url('assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{url('assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    @stack('scripts')

</x-layouts.base>