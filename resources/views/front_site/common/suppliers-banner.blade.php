<div class="position-relative">
    <div id="SupplierSlider" class="carousel slide carousel-fade suppliers-slider" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#SupplierSlider" data-slide-to="0" class="indicators active"></li>
            <li data-target="#SupplierSlider" data-slide-to="1" class="indicators"></li>
            <li data-target="#SupplierSlider" data-slide-to="2" class="indicators"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="d-block w-100 slider-img" src="{{$ASSET}}/front_site/images/Slider3.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 slider-img" src="{{$ASSET}}/front_site/images/Slider4.jpg" alt="second-slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block w-100 slider-img" src="{{$ASSET}}/front_site/images/Slider6.jpg" alt="Third slide">
            </div>
        </div>
    </div>
    <div class="position-absolute slider-text">
        <p class="mb-0">
            <?php  $comp_name = \App\CompanyProfile::where('id',session()->get('company_id'))->first(); ?>
            {{$comp_name->company_name}}
        </p>
    </div>
</div>
<nav class="suppliers-nav">
    <a href="{{route('suppliers-about-us')}}" class="d-inline-block text-decoration-none link">ABOUT US</a>
    <a href="{{route('supplier-products')}}" class="d-inline-block text-decoration-none link">PRODUCTS</a>
    <a href="{{route('suppliers-services')}}" class="d-inline-block text-decoration-none link">SERVICES</a>
    <a href="{{route('suppliers-contact-us')}}" class="d-inline-block text-decoration-none link">CONTACT US</a>
</nav>
