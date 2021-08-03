<div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('{{$ASSET}}/front_site/images/banner-img.png'); padding:15px;">
    <div class="dimmer"></div>
    <div class="panel-content">
        @if (isset($icon))<i class='{{ $icon }}'></i>@endif
        <h4>{!! $title !!}</h4>
        <a href="{{ $button['link'] }}" class="btn btn-primary">{!! $button['text'] !!}</a>
    </div>
</div>
{{-- {{dd('hello')}} --}}