@extends('front_site.master_layout')

@section('content')



<body class="product-main product-details product-listing">

  <main id="maincontent" class="details-comparison">

    @include('front_site.common.product-banner')

    <div class="main-container">

      <div class="container-fluid px-2">

        @include('front_site.common.garments-nav')

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Garment</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{Request::url()}}">Product</a></li>
                    </ol>
                </nav>

                <div class="container-fluid">

                    <div class="table-responsive table-bordered table-mt mt-3 products-compare">
                        <table class="table table-borderless" border="0" align="center" cellpadding="5" cellspacing="15" id="ProductCompareList">
                            <tbody>
                                <tr>
                                    <td width="175" valign="top" class="name-product-heading">
                                        <table class="table table-borderless" width="100%" border="0" cellspacing="0" cellpadding="0" class="mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <td width="75" height="315" valign="top"><h4 class="product-info-headings text-left"><strong>Name
                                                                of Products</strong></h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4 class="product-info-headings text-left">Price</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4 class="product-info-headings text-left">Min Order</h4></td>
                                                </tr>
                                                <tr>
                                                    <td><h4 class="product-info-headings text-left">Select Supplier</h4></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    @if(count($viewproduct) > 0)
                                    @foreach($viewproduct as $key=> $product)
                                    <td width="170" class="product-info-container" valign="top" data-productleadvalue="20175873">
                                        <table class="table table-borderless" width="100%" cellspacing="2" cellpadding="0" class="mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <td width="100" height="315" bgcolor="#fff" align="center">
                                                        <div align="right">
                                                            <span class="fa fa-times cross-icon" aria-hidden="true" id="cross" reference_no="{{$product->reference_no}}"></span>
                                                        </div>
                                                        <div class="productsweek-img">

                                                            <div class="MainCompareProduct">

                                                                <a href="#">
                                                                    <img class="img-responsive" alt="product"
                                                                    src="{{$ASSETS}}/{{ $product->image }}"  width="170" title="product">
                                                                </a>

                                                            </div>

                                                            <br>
                                                            <div>
                                                                <a class="text-decoration-none font-500 red-link" href="#">{{ $product->product_service_name }}</a>
                                                            </div>
                                                            <br>


                                                            <a href="" class="d-inline-block red-btn"  class="btns" data-toggle="modal" data-target="#contactFormPDP">Contact Supplier</a>
                                                                                <!-- Modal -->
                                                              <div class="modal fade" id="contactFormPDP" tabindex="-1" role="dialog" aria-labelledby="contactForm" aria-hidden="true">
                                                                <div class="modal-dialog contact-form" role="document">
                                                                  <div class="modal-content">
                                                                    <div class="modal-header">
                                                                      <span class="modal-title">Send Inquiry To Supplier</span>
                                                                      <button  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                      <form>
                                                                        <div class="form-row">
                                                                          <div class="form-group col-md-6">
                                                                            <input type="text" class="form-control" id="contactName" placeholder="Contact Name" required="required">
                                                                          </div>
                                                                          <div class="form-group col-md-6">
                                                                            <input type="text" class="form-control" id="companyName" placeholder="Company Name" required="required">
                                                                          </div>
                                                                        </div>

                                                                        <div class="form-row">
                                                                          <div class="form-group col-md-6">
                                                                            <input type="number" class="form-control" id="contactNumber" placeholder="Contact Number" required="required">
                                                                          </div>
                                                                          <div class="form-group col-md-6">
                                                                            <input type="email" class="form-control" id="emailId" placeholder="E-mail" required="required">
                                                                          </div>
                                                                        </div>

                                                                        <div class="form-row">
                                                                          <div class="form-group col-md-6">
                                                                            <select name="country" class="form-control" id="countries" required="required">
                                                                              <option value="" selected="">Country</option>
                                                                            </select>
                                                                          </div>
                                                                          <div class="form-group col-md-6">
                                                                            <input type="text" class="form-control" id="city" placeholder="City" required="required">
                                                                          </div>
                                                                        </div>

                                                                        <div id="totalCharLeft">1000 characters remaining</div>
                                                                        <textarea id="describeRequirement" class="mb-4 textarea-box form-control" placeholder="Describe Your Requirement..." maxlength="1000"></textarea>

                                                                        <div class="form-row">
                                                                          <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                                            <ul data-toggle="buttons" class="mb-0">
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Sample with specification sheet
                                                                              </li>
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Latest Price Quotation
                                                                              </li>
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Compliance certification required
                                                                              </li>
                                                                            </ul>
                                                                          </div>
                                                                          <div class="form-group ticks-checkbox col-md-12 mt-0 mb-0">
                                                                            <ul data-toggle="buttons" class="mb-0">
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Preferred payment terms
                                                                              </li>
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Production Capacity
                                                                              </li>
                                                                              <li class="btn">
                                                                                <input class="input fa fa-square-o" type="checkbox" id="userCheckbox">Production Capacity
                                                                              </li>
                                                                            </ul>
                                                                          </div>
                                                                        </div>

                                                                        <div class="form-group ticks-checkbox mt-3 mb-3">
                                                                          <ul data-toggle="buttons" class="mb-0">
                                                                            <li class="w-100 btn d-flex">
                                                                              <input class="input fa fa-square-o" type="checkbox" id="termsCheckbox">
                                                                              <div>Please refer our <a href="#" class="text-link">Privacy Policy</a> and <a href="#" class="text-link">Terms & Conditions</a> before submitting your information</div>
                                                                            </li>
                                                                          </ul>
                                                                        </div>

                                                                        <input type="submit" class="btn submit-btn" value="Send Inquiry Now" disabled>

                                                                      </form>

                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                              <!-- Modal -->


                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td bgcolor="#fff">
                                                        {{ $product->min_order_quantity }}
                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td bgcolor="#fff">
                                                        {{ $product->product_service_name }} Pieces
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td bgcolor="#fff">
                                                    <div class="d-inline-block custom-control custom-checkbox">
                                                        <input type="checkbox" value="{{ $product->id }}" class="custom-control-input select-supplier"
                                                               id="selectSupplier{{$key}}">
                                                        <label class="custom-control-label" for="selectSupplier{{$key}}"></label>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </td>
                                    @endforeach
                                    @else
                                    <td width="170" class="product-info-container" valign="top" data-productleadvalue="20175873">
                                        <table class="table table-borderless" width="100%" cellspacing="2" cellpadding="0" class="mb-0 table">
                                            <tbody>
                                                <tr>
                                                    <td width="100" height="315" bgcolor="#fff" align="center"><p>No Product Found To Compare...</p></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>

                                    @endif

                                </tr>
                                <tr>
                                <td colspan="6" valign="middle" bgcolor="#f7f8fa">
                                    <table class="table table-borderless" width="100%" border="0" cellspacing="0" cellpadding="0"
                                           class="CompareSendInquiry">
                                        <tbody>
                                        <tr>
                                            <td width="300"><h4 class="product-info-headings text-left">Collective Inquiry</h4></td>
                                            <td width="444"  class="pt-2 pb-2">
                                                <div class="d-inline-block custom-control custom-checkbox">
                                                    <input type="checkbox" value="selectAll" class="custom-control-input"
                                                           id="selectAll">
                                                    <label class="custom-control-label" for="selectAll">Select All</label>
                                                </div>
                                                <a class="ml-3 pl-2 pr-2 pt-1 pb-1 red-btn"><small>Send Inquiry</small></a>
                                            </td>
                                            <td width="275">&nbsp;</td>
                                            <td width="278">&nbsp;</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
        </div>

      </div>

    </div>

  </main>



</body>



@endsection
@push('js')

      <!--  /*add to compare model*/ -->

    <script type="text/javascript">
            $(document).delegate('#cross', 'click', function(e) {
              e.preventDefault();

            var reference_no=$(this).attr("reference_no");
            var token='{{csrf_token()}}';

                $.ajax({
                       type:'DELETE',
                       url: '{{ url('/compare-product-deleted-ajax') }}' + '/' + reference_no,
                       data:{reference_no:reference_no,_token:token},
                       cache: false,
                       success: function(response) {
                         console.log(response);


                       }
                   });
            });



    </script>

@endpush
