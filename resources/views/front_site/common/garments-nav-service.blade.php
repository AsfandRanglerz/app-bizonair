<nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="#">Garments</a>
          <button class="navbar-toggler"  data-toggle="collapse" data-target="#garmentsNav" aria-controls="garmentsNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="fa fa-angle-down"></span>
          </button>
    <div class="py-2 collapse navbar-collapse show" id="garmentsNav">
      <ul class="navbar-nav">
       @foreach(getCategories('Services') as $category)
          <li class="nav-item position-relative">
              <a class="nav-link" href="{{route('service-products',['category'=>$category->slug])}}" id="eachcat" cat-id="" cat-name="">
                <img src="{{$STORAGEASSET}}/{{ $category->image }}">

                <span>{{ $category->name }}</span>
              </a>
          </li>
        @endforeach
      </ul>
  </div>
</nav>
