@extends('front_site.master_layout')
@section('content')

<body class="reset-password-page">
  <main id="maincontent" class="page-main" style="background: #d9eefe8c">
    <div class="container">
      <div class="reset-password">
        <h4>Enter a new password for account:</h4>
          <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
               role="alert">
          </div>
          <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
               role="alert">
          </div>
          <form id="passwordReset" method="POST" action="{{url('/reset-password')}}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
			<div class="form-group">
				<label>Email</label>
				<input id="email" type="email" class="form-control" placeholder="email" name="email">
			</div>

              <div class="form-group">
                  <label>Password</label>
                  <input type="password" id="password" class="form-control" placeholder="New Password" name="password" required="required">
              </div>
			<div class="form-group">
				<label>Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="confirm password">
            </div>
              <button class="btn submit-btn" type="submit" id="resetPassword">Reset Password
              </button>
              <button  disabled class="btn-pro d-none red-btn"><span
                      class="spinner-border  spinner-border-sm mr-1" role="status"
                      aria-hidden="true"></span>Processing
              </button>
        </form>
      </div>
    </div>
  </main>
</body>

@endsection
@push('js')
    <script>
            var optionsreset = {
                dataType: 'Json',
                beforeSubmit: function (arr, $form) {
                    $("#loader").css('background-color', 'rgb(255, 255, 255, 0.5)').show();
                    $form.find('button[type=submit]').prop('disabled', true);
                    $('#resetPassword').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                    $('#alert-error').hide();
                },
                success: function (data, statusText, xhr, $form) {
                    $("#loader").hide();
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#resetPassword').removeClass('d-none');
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
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show().fadeOut(2500);
                    } else if (response.feedback === 'true') {
                        // $('html, body').animate({scrollTop:0}, 'slow');

                        $('#resetPassword').attr('disabled');
                        // $('#alert-success').html(response.msg);
                        // $('#alert-success').show().fadeOut(2500);

                        toastr.success(response.msg);

                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 1000);
                    }

                },

                error: function (jqXHR, exception) {
                    $("#loader").hide();
                    $('button[type=submit]').prop('disabled', false);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-success').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#resetPassword').removeClass('d-none');
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
                    $('#alert-error').html(msg);
                    $('#alert-error').show();
                },

            };
            $('#passwordReset').ajaxForm(optionsreset);
    </script>
@endpush
