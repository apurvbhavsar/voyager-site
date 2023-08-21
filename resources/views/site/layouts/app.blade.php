@include(config('voyager-site.views') . '.layouts.head')

<body @if (Request::is('/')) class="home" @endif>

    @include(config('voyager-site.views') . '.layouts.header')

    {{-- main content --}}
    @if (!Request::is('/'))
        @include(config('voyager-site.views') . '.partials.page-header')
        <div class="page-main-wrapper">
            @yield('content')
        </div>
    @else
        @yield('content')
    @endif
    {{-- end main contents --}}

    @include(config('voyager-site.views') . '.layouts.footer')


    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- End Global Script --}}
    @stack('scripts')

    {{ setting('site.footer_script') }}
</body>

</html>
