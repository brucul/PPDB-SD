<!-- General JS Scripts -->
<script src="{{ asset('assets/library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/library/popper.js/dist/umd/popper.js') }}"></script>
<script src="{{ asset('assets/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
<script src="{{ asset('assets/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/library/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/library/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('assets/library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<script src="{{ asset('assets/library/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/library/sweetalert/dist/sweetalert.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/library/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Template JS File -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/library/selectric/public/jquery.selectric.min.js') }}"></script>

<script src="{{ asset('assets/library/paper-bootstrap-wizard/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/library/cleave.js/dist/cleave.min.js') }}"></script>
<script src="{{ asset('assets/library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

@stack('scripts')

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Page Specific JS File -->
{{-- <script src="{{ asset('assets/assets/js/page/index.js') }}"></script> --}}
<script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>

<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('.dataTable').dataTable()

        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });

        $("#show_hide_password_confirm a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password_confirm input').attr("type") == "text") {
                $('#show_hide_password_confirm input').attr('type', 'password');
                $('#show_hide_password_confirm i').addClass("fa-eye-slash");
                $('#show_hide_password_confirm i').removeClass("fa-eye");
            } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
                $('#show_hide_password_confirm input').attr('type', 'text');
                $('#show_hide_password_confirm i').removeClass("fa-eye-slash");
                $('#show_hide_password_confirm i').addClass("fa-eye");
            }
        });
    })
</script>
