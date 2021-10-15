@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="pt-sm-5 pt-3 pb-sm-5 pb-3 page-main">
    <div class="p-3 col-sm-6 col-11 login-form popup-center">
        <span class="d-block text-center heading font-500">Login</span>

    </div>
</main>
</body>
@endsection
@push('js')
    <script>


        $(document).ready(function () {

            var options_login = {
                dataType: 'Json',
                success: function (data) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-log').hide();
                    $('#alert-error-log').hide();
                    $('.empty-div').show();
                    response = data;
                    if (response.feedback == 'false') {
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback == 'invalid') {
                        $('#alert-error-log').html(response.msg);
                        $('#alert-error-log').show();
                        $('.empty-div').hide();

                    } else {

                        $('#alert-error-login').hide();
                        $('#alert-success-log').html(response.msg);
                        $('#alert-success-log').show();
                        $('.empty-div').hide();
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);

                    }
                },
                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-log').hide();
                    $('#alert-error-log').hide();
                    $('.empty-div').show();
                    // form.find('button[type=submit]').html('<i aria-hidden="true" class="fa fa-check"></i> {{ __('Save') }}');
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not Connected.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error, Please try again later';
                    }
                    $('#alert-error-log').html(msg);
                    $('#alert-error-log').show();
                    $('.empty-div').hide();
                },

            };

            $('#logForm').ajaxForm(options_login);

        });
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

@endpush
