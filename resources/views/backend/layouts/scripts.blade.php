 <!-- BEGIN: Vendor JS-->
 <script src="{{ asset('public/app-assets/vendors/js/vendors.min.js') }}"></script>
 <!-- BEGIN Vendor JS-->

 <!-- BEGIN: Page Vendor JS-->
 @if (current_route() == 'admin.dashboard')
     <script src="{{ asset('public/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
 @endif

 <script src="{{ asset('public/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/extensions/polyfill.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
 <script src="{{ asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Theme JS-->
 <script src="{{ asset('public/app-assets/js/core/app-menu.js') }}"></script>
 <script src="{{ asset('public/app-assets/js/core/app.js') }}"></script>
 <!-- END: Theme JS-->

 @if (current_route() == 'admin.dashboard')
     <script src="{{ asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
     <script src="{{ asset('public/app-assets/js/scripts/cards/card-statistics.js') }}"></script>
 @endif
 <!-- BEGIN: Page JS-->
 <script src="{{ asset('public/app-assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>
 <script src="{{ asset('public/app-assets/js/scripts/forms/form-select2.js') }}"></script>
 <script src="{{ asset('public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>
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

     $(function() {
         $('.dt-responsive1').DataTable({
             "paging": true,
             "lengthChange": true,
             "searching": true,
             "ordering": false,
             "info": false,
             "autoWidth": true,
             "responsive": true,
         });
     });
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
