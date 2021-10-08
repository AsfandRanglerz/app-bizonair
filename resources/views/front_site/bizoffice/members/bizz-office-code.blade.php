@extends('front_site.master_layout')
@section('content')
<body>
<main id="maincontent" class="page-main page-bg" style="padding: 35px 0">
    <div class="company-profile popup-center">
        <div class="container">
            <span class="d-block text-center heading main-heading font-24">Biz Office Invitation</span>
            <form id="joinBizzOffice" method="post" action="{{route('assignoffice')}}">
                @csrf
                <input name="user" type="hidden" value="{{$user->id}}">
                <input name="token" type="hidden" value="{{$token}}">
                <input name="code" id="bizofficecode" type="hidden" value="{{$company->office_code}}">
                <span class="d-block heading font-18 basic-info text-center">You are about to join {{$company->company_name}}</span>
                <div id='alert-success-update-account' class="alert alert-success py-2" style="display: none;">
                </div>
                <div id='alert-error-update-account' class="alert alert-danger py-2" style="display: none;">
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="red-btn">Join Biz Office</button>
                </div>
            </form>
        </div>
    </div>
</main>
</body>
    @push('js')
        <script>
            $("#joinBizzOffice").ajaxForm({
                dataType: 'JSON',
                success: function (response, statusText, xhr, $form) {
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    if (response.feedback == "success") {
                        // $('html, body').animate({scrollTop: 0}, 'slow');
                        $("#alert-success-update-account").show().html("Biz Office is joined successfully.");
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 2000);
                    } else if (response.feedback == "error") {
                        // $('html, body').animate({scrollTop:($('#'+Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $("#alert-error-update-account").show().html(response.msg);
                    }

                },
                error: function (jqXHR, exception) {
                    $('#alert-success-update-account').hide();
                    $('#alert-error-update-account').hide();
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
                    // $('html, body').animate({scrollTop: 0}, 'slow');
                    $('#alert-error-update-account').show().html(msg);
                },
            });
        </script>
    @endpush
@endsection
