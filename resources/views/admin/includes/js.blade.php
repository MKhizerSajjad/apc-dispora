
    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('admin/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ asset('admin/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ asset('admin/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{ asset('admin/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('admin/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{ asset('admin/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{ asset('admin/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('admin/libs/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('admin/js/pages/dashboard-ecommerce.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/js/app.js')}}"></script>

    <!-- App js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--select2 cdn-->
    {{-- <script src="../../../../cdn.jsdelivr.net/npm/select2%404.1.0-rc.0/dist/js/select2.min.js"></script> --}}

    <script src="{{ asset('admin/js/pages/datatables.init.js') }}"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{ asset('admin/js/select2.init.js') }}"></script>

    {{-- auto close alerts after 3sec --}}
    <script>
        setTimeout(function() {
            $(".auto-colse-3").slideUp(500);
        }, 3000);
        setTimeout(function() {
            $(".auto-colse-10").slideUp(500);
        }, 10000);
    </script>
