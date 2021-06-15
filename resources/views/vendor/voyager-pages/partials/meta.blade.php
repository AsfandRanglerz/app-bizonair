<!DOCTYPE html>
<html lang="en">
<head>
<!-- <title>{{isset($title)? ($title? $title.' - Bizonair' : 'Bizonair') : 'Bizonair'}}</title> -->
    <title>@yield('meta_title', setting('site.title'))</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="{{$ASSET}}/front_site/images/favicon.png">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/slick.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css">
    <link type="text/css" rel="stylesheet" href="{{$ASSET}}/front_site/plugins/light-slider/css/lightslider.css"/>
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/build/css/intlTelInput.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multiple-select/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multi-selectable-tree/jquery.tree-multiselect.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/select2/css/select-picker.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/multi-image-selector/styles.imageuploader.css">
    <link rel="stylesheet" href="{{$ASSET}}/front_site/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{$ASSET}}/front_site/css/style.css">
    @yield('metadata')
    @stack('css')

</head>
<header class="header">
    <nav class="navbar navbar-expand-lg">

        <div class="container-fluid">

            <a class="navbar-brand" href="{{route('home')}}"><img
                    src="{{$STORAGEASSET}}/{{(setting('site.logo'))}}"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizonairNav"
                    aria-controls="bizonairNav" aria-expanded="false" aria-label="Toggle navigation">

                <span class="fa fa-bars"></span>

            </button>


            <div class="collapse navbar-collapse" id="bizonairNav">

                <ul class="navbar-nav">

                    <div class="deals-btn">

                        <button id="bizDeals" class="red-btn"><img src="{{$ASSET}}/front_site/images/bizDeals.png">MYBIZ
                            DEALS
                        </button>

                        <button id="bizOffice" @if(Auth::check()) onclick="location.href='{{ route('my-biz-office') }}'"
                                @else data-toggle="modal" data-target="#login-form" @endif ><img
                                src="{{$ASSET}}/front_site/images/bizOffice.png">MYBIZ OFFICE
                        </button>

                    </div>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">

                            Textile Business<span class="fa fa-angle-down" aria-hidden="true"></span>

                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <div class="row w-100 m-0 dropdown-container">

                                <div class="col-sm-9">

                                    <div class="row">


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Textile Material</li>

                                                @foreach (textilematerials() as $textilematerial)

                                                    <li><a href="#" target="_blank">{{$textilematerial->name}}</a></li>

                                                @endforeach

                                            </ul>

                                        </div>


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Fashion Accessories</li>

                                                @foreach (fachionaccessories() as $fachionaccessory)

                                                    <li><a href="#" target="_blank">{{$fachionaccessory->name}}</a></li>

                                                @endforeach

                                            </ul>

                                        </div>


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Chemicals</li>

                                                @foreach (chemicals() as $chemical)

                                                    <li><a href="#" target="_blank">{{$chemical->name}}</a></li>

                                                @endforeach

                                            </ul>

                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Machinery</li>

                                                @foreach (machinaries() as $machinery)

                                                    <li><a href="#" target="_blank">{{$machinery->name}}</a></li>

                                                @endforeach

                                            </ul>

                                        </div>


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Machinery Parts</li>

                                                @foreach (machinaryparts() as $machinarypart)

                                                    <li><a href="#" target="_blank">{{$machinarypart->name}}</a></li>



                                                @endforeach

                                            </ul>

                                        </div>


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Stock Lots & Wastes</li>

                                                @foreach (stocks() as $stock)

                                                    <li><a href="#" target="_blank">{{$stock->name}}</a></li>

                                                @endforeach

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                                {{-- <div class="col-sm-9">

                                    <div class="row">

                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Textile Material</li>

                                                <li><a href="#" target="_blank">Fibre</a></li>

                                                <li><a href="#" target="_blank">Cotton</a></li>

                                                <li><a href="#" target="_blank">Yarn</a></li>

                                                <li><a href="#" target="_blank">Fabric</a></li>

                                                <li><a href="#" target="_blank">Garments</a></li>

                                                <li><a href="#" target="_blank">Home Textile</a></li>

                                                <li><a href="#" target="_blank">Accessories</a></li>

                                            </ul>

                                        </div>



                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Fashion Accessories</li>

                                                <li><a href="#" target="_blank">Men's Accessories</a></li>

                                                <li><a href="#" target="_blank">Women's Accessories</a></li>

                                                <li><a href="#" target="_blank">Kid's Accessories</a></li>

                                                <li><a href="#" target="_blank">General Accessories</a></li>

                                            </ul>

                                        </div>



                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Chemicals</li>

                                                <li><a href="#" target="_blank">Textile Chemicals</a></li>

                                                <li><a href="#" target="_blank">General Chemicals</a></li>

                                                <li><a href="#" target="_blank">Lubricants</a></li>

                                            </ul>

                                        </div>



                                    </div>

                                    <div class="row">

                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Machinery</li>

                                                <li><a href="#" target="_blank">Textile Machinery</a></li>

                                                <li><a href="#" target="_blank">General Machinery</a></li>

                                            </ul>

                                        </div>



                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Machinery Parts</li>

                                                <li><a href="#" target="_blank">Electrical</a></li>

                                                <li><a href="#" target="_blank">Mechanical</a></li>

                                            </ul>

                                        </div>



                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Stock Lots & Wastes</li>

                                                <li><a href="#" target="_blank">Textile</a></li>

                                                <li><a href="#" target="_blank">General</a></li>

                                            </ul>

                                        </div>

                                    </div>

                                </div> --}}

                                <div class="col-sm-3">

                                    <img src="{{$ASSET}}/front_site/images/dropdown-img2.png" class="w-100">

                                </div>

                            </div>

                        </div>

                    </li>

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">

                            Textile Services<span class="fa fa-angle-down" aria-hidden="true"></span>

                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <div class="row w-100 m-0 dropdown-container">

                                <div class="col-sm-8">

                                    <div class="row">

                                        <div class="col-sm-8">

                                            <ul>

                                                <li class="heading text-center">General Services</li>

                                                <div class="row">

                                                    @foreach (generalServices() as $generalservice)

                                                        <div class="col-sm-6">

                                                            <li><a href="#"
                                                                   target="_blank">{{$generalservice->name}}</a></li>


                                                        </div>

                                                    @endforeach


                                                </div>

                                            </ul>

                                        </div>


                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Textile Services</li>

                                                @foreach (texttileServices() as $textileservice)

                                                    <li><a href="#" target="_blank">{{$textileservice->name}}</a></li>



                                                @endforeach

                                            </ul>

                                        </div>


                                    </div>

                                    {{-- <div class="row">

                                        <div class="col-sm-8">

                                            <ul>

                                                <li class="heading text-center">General Services</li>

                                                <div class="row">

                                                    <div class="col-sm-6">

                                                        <li><a href="#" target="_blank">Human Resource (HR)</a></li>

                                                        <li><a href="#" target="_blank">Information Technology (IT)</a></li>

                                                        <li><a href="#" target="_blank">Accounts & Finance</a></li>

                                                        <li><a href="#" target="_blank">Texation</a></li>

                                                        <li><a href="#" target="_blank">Certification</a></li>

                                                        <li><a href="#" target="_blank">Audit</a></li>

                                                        <li><a href="#" target="_blank">Consultation</a></li>

                                                        <li><a href="#" target="_blank">Calibration</a></li>

                                                        <li><a href="#" target="_blank">Trainings</a></li>

                                                    </div>



                                                    <div class="col-sm-6">

                                                        <li><a href="#" target="_blank">Contractual Jobs</a></li>

                                                        <li><a href="#" target="_blank">Erection and Commisioning</a></li>

                                                        <li><a href="#" target="_blank">Mechanical</a></li>

                                                        <li><a href="#" target="_blank">Fabrication</a></li>

                                                        <li><a href="#" target="_blank">Electrical and Electronics</a></li>

                                                        <li><a href="#" target="_blank">Repairing Work</a></li>

                                                        <li><a href="#" target="_blank">Security</a></li>

                                                        <li><a href="#" target="_blank">General</a></li>

                                                    </div>

                                                </div>

                                            </ul>

                                        </div>



                                        <div class="col-sm-4">

                                            <ul>

                                                <li class="heading">Textile Services</li>

                                                <li><a href="#" target="_blank">Vendor Selection</a></li>

                                                <li><a href="#" target="_blank">Product Development</a></li>

                                                <li><a href="#" target="_blank">Price Negociation</a></li>

                                                <li><a href="#" target="_blank">Order Placement</a></li>

                                                <li><a href="#" target="_blank">Production Control</a></li>

                                                <li><a href="#" target="_blank">Quality Assurance</a></li>

                                                <li><a href="#" target="_blank">Shipping</a></li>

                                                <li><a href="#" target="_blank">Online Reporting system</a></li>

                                            </ul>

                                        </div>

                                    </div>										 --}}

                                </div>

                                <div class="col-sm-4">

                                    <img src="{{$ASSET}}/front_site/images/dropdown-img2.png" class="w-100">

                                </div>

                            </div>

                        </div>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link social" href="#">Careers</a>

                    </li>

                    <li class="nav-item dropdown lenthh">

                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">

                            JOURNAL<span class="fa fa-angle-down" aria-hidden="true"></span>

                        </a>

                        <div class="dropdown-menu lenth" aria-labelledby="navbarDropdownMenuLink">

                            <div class="row w-100 m-0 dropdown-container">


                                <ul class="socialLinks">

                                    <li><a href="#" target="_blank">Social Networking</a></li>

                                    <li><a href="#" target="_blank">Trade Events</a></li>

                                </ul>


                            </div>

                        </div>

                    </li>


                    <li class="nav-item dropdown lenthh">

                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">

                            Research<span class="fa fa-angle-down" aria-hidden="true"></span>

                        </a>

                        <div class="dropdown-menu lenth" aria-labelledby="navbarDropdownMenuLink">

                            <div class="row w-100 m-0 dropdown-container">


                                <ul class="socialLinks">

                                    <li><a href="#" target="_blank">Consultancy</a></li>

                                    <li><a href="#" target="_blank">R & D Corner</a></li>

                                </ul>


                            </div>

                        </div>

                    </li>

                @if(Auth::check() && Auth::user()->role_id == 2  )



                    <!-- <li class="nav-item" >

								<a class="nav-link" href="{{route('logout')}}">Logout</a>

							</li> -->
                        <li class="nav-item dropdown lenthh profile-icon-main">
                            <a class="pr-0 pl-0 nav-link" href="#" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true">
                                <img
                                    src="@if(Auth::user()->avatar == 'users/default.png'){{asset($ASSET.'/front_site/images/'.Auth::user()->avatar)}} @else {{url(Auth::user()->avatar)}} @endif"
                                    width="45" height="45" alt="logo" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu lenth profile-icon-dropdown"
                                 aria-labelledby="navbarDropdownMenuLink">
                                <div class="row w-100 m-0 dropdown-container">
                                    <ul class="socialLinks">
                                        <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                        <li><a href="{{ url('my-account-detail') }}">Edit Profile</a></li>
                                        <li><a href="{{url('logout')}}">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>



                    @else

                        <li class="nav-item">

                            <a href="#login-form" class="nav-link login trigger-btn" data-toggle="modal">Login</a>

                        </li>

                    @endif

                </ul>

            </div>

        </div>

    </nav>

</header>
<div id="loader">
    <span id="loaderGif"></span>
</div>
<style type="text/css" media="screen">
    .privacy-policy .main-heading {
        text-decoration: underline;
    }

    .privacy-policy .main-heading,
    .privacy-policy-content .heading {
        letter-spacing: -0.62px;
        color: #344356;
    }

    .privacy-policy-content .paragraph {
        letter-spacing: -0.62px;
        color: #344356;
        text-align: justify;
    }

    @media only screen and (max-width: 575px) {
        .privacy-policy-content .paragraph {
            font-size: 14px;
        }
    }
</style>
<!-- login-form -->
<div id="login-form" class="modal fade">

    <div class="modal-dialog modal-login">

        <div class="modal-content">

            <form action="{{route('user-do-login')}}" method="post" id="loginForm">

                @csrf

                <div class="modal-header">

                    <span class="modal-title">Login</span>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

                <div class="modal-body">

                    <div class="alert alert-success m-0 mb-2 text-center" id='alert-success-login' style="display:none;"

                         role="alert">

                    </div>

                    <div class="alert alert-danger g m-0 mb-2 text-center" id='alert-error-login' style="display:none;"

                         role="alert">

                    </div>

                    <img src="{{$ASSET}}/front_site/images/favicon.png" class="mb-5">

                    <div class="form-group">

                        <input type="email" class="form-control" name="email_login" id="emailId" placeholder="E-mail">

                        <small class="text-white" id="email_login_error"></small>

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="login_password" placeholder="Password">

                        <small class="text-white" id="login_password_error"></small>

                    </div>

                    <div class="form-group mb-5 ticks-checkbox">


                        <!-- <ul data-toggle="buttons" class="mb-0 text-center">

                            <li class="btn d-inline">

                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Remember me

                            </li>

                        </ul> -->

                        <div
                            class="form-check form-check-inline custom-control custom-checkbox d-flex justify-content-center">
                            <input type="checkbox" class="custom-control-input" id="userCheckbox">
                            <label class="custom-control-label remember-check" for="userCheckbox">Remember me</label>
                        </div>


                        <input type="submit" class="btn login-btn" value="Login"><br>

                        <a href="forgot-password.php" style="font-size: 13px;color: #FFF;font-weight: 100">Forgot your
                            password?</a>

                    </div>

                    <p style="color: #FFF;font-size: 16px;font-weight: 100">Don't have an account? <a
                            href="{{route('email-confirmation')}}" class="sign-up">Sign up</a></p>

                </div>

            </form>

        </div>

    </div>

</div>
<body>
