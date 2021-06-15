@extends('front_site.master_layout')

@section('content')

    <body class="dashboard">

    <main id="maincontent" class="page-main">



        <div class="d-flex" id="dashboardWrapper">



            <!-- Sidebar -->


        <!-- /#sidebar-wrapper -->



            <!-- Page Content -->

            <div id="page-content-wrapper">

                @include('front_site.common.dashboard-toggle')

                <div class="d-container">
                    <span class="main-heading mt-3 mb-3">{{$title}}</span>
                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success' style="display:none;"
                         role="alert">
                    </div>
                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error' style="display:none;"
                         role="alert">
                    </div>
                    <div class="create-account">
                        <form id="oficeCodeForm" method="POST" action="{{route('company-change-office-code')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{encrypt($user->my_office->id)}}">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Office Code</label>
                                    <div class="form-row">
                                        <div class="form-group col-xl-12 col-lg-12">
                                            <input type="number" value="{{ $user->my_office->office_code }}"
                                                   name="office_code" id="office_code" class="form-control"
                                                   placeholder="Enter your office code">
                                            <small class="text-danger" id="office_code_error"></small>
                                        </div>
                                        <div class="form-group col-xl-12 col-lg-12" align="center">
                                            <button class="verify-btn red-btn" id="accoutn_btn" disabled>Save</button>
                                            <button type="button"  disabled class="btn-pro d-none red-btn" ><span class="spinner-border  spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Processing</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- /#page-content-wrapper -->



        </div>

    </main>

    </body>

@endsection

@push('js')

    <script>
        $(document).ready(function(){
            var options={
                dataType: 'Json',
                beforeSubmit: function(){
                    $('#accoutn_btn').addClass('d-none');
                    $('.btn-pro').removeClass('d-none');
                },
                success: function(data){

                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('small.text-danger').html('');
                    $(':input').removeClass('is-invalid');
                    response = data;
                    $('.btn-pro').addClass('d-none')
                    $('#accoutn_btn').removeClass('d-none');
                    if(response.feedback === "false"){
                        $('html, body').animate({scrollTop:($('#'+Object.keys(response.errors)[0]).offset().top)}, 'slow');
                        $.each(response.errors , function(key ,value){
                            $('#' + key + '_error').html(value[0]);
                            $(":input[name="+key+"]").addClass('is-invalid');
                        });
                    }
                    else if(response.feedback === "other_error"){
                        $('html, body').animate({scrollTop:0}, 'slow');
                        $('#' + response.id).html(response.custom_msg);
                    }
                    else if(response.feedback === 'other'){
                        $('html, body').animate({scrollTop:0}, 'slow');
                        $('#alert-error').html(response.custom_msg);
                        $('#alert-error').show().fadeOut(2500);
                    }else if(response.feedback === 'true'){
                        $('html, body').animate({scrollTop:0}, 'slow');
                        $('#alert-success').html(response.custom_msg);
                        $('#alert-success').show().fadeOut(2500);
                    }
                    else{
                        $('html, body').animate({scrollTop:0}, 'slow');
                        $('#alert-error').hide();
                        $('#accoutn_btn').attr('disabled');
                        $('#alert-success').html(response.msg);
                        $('#alert-success').show().fadeOut(2500);

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                },

                error: function (jqXHR, exception) {
                    $('html, body').animate({scrollTop:0}, 'slow');
                    $('#alert-success').hide();
                    $('#alert-error').hide();
                    $('.btn-pro').addClass('d-none').removeClass('d-flex');
                    $('#accoutn_btn').removeClass('d-none');
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
            $('#oficeCodeForm').ajaxForm(options);
        });
    </script>
    @endpush
