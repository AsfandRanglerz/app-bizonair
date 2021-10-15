<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#" id="catNameSec">CATEGORIES</a>
    <button class="navbar-toggler"  data-toggle="collapse" data-target="#garmentsNav" aria-controls="garmentsNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-angle-down"></span>
    </button>
    <div class="py-2 collapse navbar-collapse" id="garmentsNav">
        <ul class="navbar-nav" style="margin: 0 -4px">
            @foreach(getCategories('Services') as $category)
                <div class="position-relative px-1 pro-cat-links-box">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('service-products',['category'=>$category->slug])}}" id="eachcat" cat-id="" cat-name="">
                            <img src="{{ $category->image }}">
                            <span>{{ $category->name }}</span>
                        </a>
                    </li>
                </div>
            @endforeach
        </ul>
    </div>
</nav>
