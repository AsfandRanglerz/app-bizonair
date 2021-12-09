<div class="p-2 h-100 journal-sidebar">
    <h3 class="heading">Blogs</h3>
    <div class="row mx-0">
        <div class="col-md-12 col-6 px-md-3 pl-0 pr-1">
            <h3 class="heading">MyBiz TALK</h3>
            <a href="{{route('blog-detail',['id'=>$ads->id])}}" class="text-reset text-decoration-none">
                <div class="mb-1 hover-scale journal-content">
                    <img src="@if(isset($ads1->image)) {{ $ads->image }} @else {{$ASSET}}/front_site/images/noimage.png @endif" class="journal-sidebar-img">
                    <p class="px-2 py-1 mb-0 overflow-text-dots" style="height: 2.3rem">{{$ads->title}}</p>
                </div>
            </a>
        </div>
        <div class="col-md-12 col-6 px-md-3 pl-1 pr-0">
            <h3 class="heading">MyBiz IDOL</h3>
            <a href="{{route('blog-detail',['id'=>$ads1->id])}}" class="text-reset text-decoration-none">
                <div class="mb-1 hover-scale journal-content">
                    <img src="@if(isset($ads1->image)) {{ $ads1->image }} @else {{$ASSET}}/front_site/images/noimage.png @endif" class="journal-sidebar-img">
                    <p class="px-2 py-1 mb-0 overflow-text-dots" style="height: 2.3rem">{{$ads1->title}}</p>
                </div>
            </a>
        </div>
    </div>
    <?php $dataa = \App\Vcast::first();?>
    <h3 class="heading">{{$dataa->name}}</h3>
    <div class="journal-content">
        <video class="embed-responsive embed-responsive-16by9 video-section" controls>
            <source src="{{$dataa->link}}" type="video/mp4">
        </video>
    </div>
</div>
