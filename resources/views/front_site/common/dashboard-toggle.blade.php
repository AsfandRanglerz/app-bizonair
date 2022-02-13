<?php $usercomp = \App\UserCompany::where('user_id',auth()->id())->first();?>
@if(!$usercomp)
    <nav class="position-fixed w-100 px-2 bg-white navbar navbar-expand-lg navbar-light border-bottom justify-content-between dashboard-toggle-top-bar">
        <span class="company-name-nav"></span>
        <div class="d-flex align-items-center">
            <span class="mr-2 text-white">Select Your Company :</span>
            <select class="w-auto form-control comp-name" id="compani_id" name="compani_id" data-toggle="tooltip" title="Biz office not created!">
                <option disabled selected value="">-- Biz office not created --</option>
            </select>
        </div>
</nav>
@else
    <nav class="position-fixed w-100 px-2 bg-white navbar navbar-expand-lg navbar-light border-bottom justify-content-between dashboard-toggle-top-bar">
    @if(session()->has('company_id'))
        <span class="company-name-nav">{{ company_name(session()->get('company_id'))??'' }}</span>
        <div class="d-flex align-items-center">
            <span class="mr-2 text-white">Select Your Company :</span>
            <select class="w-auto form-control comp-name" id="compani_id" name="compani_id" data-toggle="tooltip" title="Select your company!">
                <option disabled selected value="">Select Your Company</option>
                @foreach(\App\UserCompany::where('user_id',\Auth::user()->id)->get() as $company)
                    <option value="{{ $company->company_id }}" {{(session()->has('company_id') && session()->get('company_id') == $company->company_id)?'selected':''}}>{{ $company->company->company_name }}</option>
                @endforeach
            </select>
        </div>
    @endif
 </nav>
@endif

@push('js')
    <script>
        $(document).ready(function () {

            $('.scrolling-btns').remove();
            $(document).on('change', '#avatar', function () {
                var name = document.getElementById("avatar").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg','jfif']) == -1) {
                    alert("Invalid Image File");
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("avatar").files[0]);
                var f = document.getElementById("avatar").files[0];
                var fsize = f.size || f.fileSize;
                if (fsize > 2000000) {
                    alert("Image File Size is very big");
                } else {
                    form_data.append("avatar", document.getElementById('avatar').files[0]);
                    $.ajax({
                        url: "{{route('upload-user-avatar')}}",
                        method: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                        },
                        success: function (data) {
                            $('#uploaded_image').html(data);
                        }
                    });
                }
            });
        });

        $(document).on('click', '.leave-btn', function () {
            btn = $(this);
            var user_id = $(this).attr("user_id");
            var company_id = $(this).attr("company_id");
            swal({
                title: "Are you sure that you want to leave?",
                // text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#ajax-preloader").show();
                        $.post("{{ route('company-leave-office') }}", {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id,
                            company_id: company_id,
                            json: 'yes'
                        }, function (data) {
                            // document.getElementById("wait").style.display = "none";
                            $("#ajax-preloader").hide();
                            response = $.parseJSON(data);
                            if (response.feedback == 'encrypt_issue') {
                                toastr.error(response.msg, 'Error');
                                $('#alert-error').html('response.msg')
                                $('#alert-error').show().fadeOut(2500);
                            } else if (response.feedback == 'true') {
                                toastr.success(response.msg, 'Success');
                                // $('#alert-success').html(response.msg)
                                // $('#alert-success').show().fadeOut(2500);
                                setTimeout(() => {
                                    window.location.href = response.url
                                }, 3000);
                            } else {
                                // toastr.error('Something went Wrong', 'Error');
                                $('#alert-error').html('Something went Wrong')
                                $('#alert-error').show().fadeOut(2500);
                            }
                        });
                    }
                });
        });

        @if(!Request::is('my-company-profile/'.Session::get('company_id')))
        $(document).delegate('#compani_id', 'change', function(e) {
            e.preventDefault();
            var company_id=$(this).val();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/ajax-company-id-get') }}',
                data:{company_id:company_id,_token:token},
                cache: false,
                success: function(data) {

                    window.location = window.location.href;
                }
            });
        });
        @else
        $(document).delegate('#compani_id', 'change', function(e) {
            e.preventDefault();
            var company_id=$(this).val();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/ajax-company-id-get') }}',
                data:{company_id:company_id,_token:token},
                cache: false,
                dataType: 'json',
                success: function(data) {
                    window.location.href = data.url;
                }
            });
        });
        @endif

        $(document).delegate('.meeti', 'click', function() {


        });
    </script>
@endpush


