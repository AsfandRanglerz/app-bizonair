@extends('front_site.master_layout')
@section('content')

<body class="forgot-password-page">
  <main id="maincontent" class="page-main" style="background: #d9eefe8c">
    <div class="container">
      <div class="forgot-password">
        <h4>Reset Your Password</h4>
          <div class="alert alert-success mb-2 text-center" id='alert-success-sendemail' style="display: none"
               role="alert">
          </div>
          <div class="alert alert-danger mb-2 text-center" id='alert-error-sendemail' style="display: none"
               role="alert">
          </div>
        <form id="sendEmail" action="{{route('password')}}" method="post">
            @csrf
    			<div class="form-group">
    				<label>Email Address</label>
    				<input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
    			</div>

          <p>Enter the email address associated with your account, and we'll email you a link to reset your password.</p>
            <button class="btn submit-btn" id="emailSend" type="submit" disabled>Send Password Reset Link</button>

        </form>

      </div>
    </div>
  </main>
</body>

@endsection

@push('js')

    <script>
        $(document).ready(function () {
            var options = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#emailSend').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error-sendemail').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success-sendemail').hide();
                    $('#alert-error-sendemail').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#emailSend').removeClass('d-none');
                    if (response.feedback === "false") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: ($('#' + Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name=" + key + "]").addClass('is-invalid');
                        });
                    } else if (response.feedback === "other_error") {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#' + response.id).html(response.custom_msg);
                    } else if (response.feedback === 'other') {
                        $form.find('button[type=submit]').prop('disabled', false);
                        $('html, body').animate({scrollTop: 0}, 'slow');
                        $('#alert-error-sendemail').html(response.custom_msg);
                        $('#alert-error-sendemail').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#emailSend').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show().fadeOut(2500);

                        toastr.success(response.msg);
                    }

                },

                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success-sendemail').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#emailSend').removeClass('d-none');
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
                    $('#alert-error-sendemail').html(msg);
                    $('#alert-error-sendemail').show();
                },

            };
            $('#sendEmail').ajaxForm(options);
        });
    </script>

@endpush

