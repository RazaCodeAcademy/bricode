
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('public/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('public/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('public/app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('public/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/scripts/components/components-modals.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('public/app-assets/js/scripts/pages/page-auth-login.js') }}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
     @if (Session::has('success'))
     <script>
         toastr.success('{{ Session::get('success') }}')
     </script>
 @endif

 @if (Session::has('error'))
     <script>
         toastr.error('{{ Session::get('error') }}')
     </script>
 @endif

@yield('scripts')
