<div class="position-relative">
    <div id="SupplierSlider" class="carousel slide carousel-fade suppliers-slider" data-ride="carousel">
        <ol class="carousel-indicators mb-2">
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
           {{$about_us->company_name}}
        </p>
    </div>
</div>
<nav class="suppliers-nav">
    <a href="{{route('about-us-suppliers',['id'=>$about_us->id,'company'=>getCompanyName($about_us->id)])}}" class="d-inline-block text-decoration-none link">ABOUT US</a>
    <a href="{{route('products-suppliers',$about_us->id)}}" class="d-inline-block text-decoration-none link">PRODUCTS</a>
    <a href="{{route('services-suppliers',$about_us->id)}}" class="d-inline-block text-decoration-none link">SERVICES</a>
    <a href="{{route('contact-us-suppliers',$about_us->id)}}" class="d-inline-block text-decoration-none link">CONTACT US</a>
</nav>
