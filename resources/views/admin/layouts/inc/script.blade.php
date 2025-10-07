<!-- Jquery Core Js -->
<script src="{{ asset('backend') }}/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script src="{{ asset('backend') }}/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="{{ asset('backend') }}/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob Plugin Js -->

<script src="{{ asset('backend') }}/assets/bundles/mainscripts.bundle.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/index.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/charts/jquery-knob.min.js"></script>

<script src="{{ asset('backend') }}/assets/js/toastr.min.js"></script>
<script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>

    

@stack('scripts')
