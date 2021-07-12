@extends('front_site.master_layout')
@section('content')
    <body>
        <main class="py-2 page-main">
                <div class="popup-center verification-code">
                    <h3 class="mb-0 text-center">Please enter the 6-digit verification code we sent via SMS:</h3>
                    <p class="text-center">(we want to make sure it's you before we contact our movers)</p>
                    <div class="row mx-0">
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                        <div class="col-2 px-1">
                            <input type="text" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" class="form-control verify-field" />
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <button class="btn red-btn">Verify</button>
                        <p class="mt-3 mb-0">Didn't receive the code?</p>
                        <p class="mb-0"><a href="#" class="red-link">Send code again</a></p>
                        <p class="mb-0"><a href="#" class="red-link">Change phone number</a></p>
                    </div>
                </div>
        </main>
    </body>
@endsection
