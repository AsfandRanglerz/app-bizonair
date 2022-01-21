<!DOCTYPE html>
<html>
<head>
    <title>WEB</title>
    <style>
        p, span, h1, h2, h3, h4, h5, h6 {
            color: #5f6368!important;
        }

        td.content-cell {
            padding: 16px 30px!important;
        }

        .main-heading {
            text-align: center!important;
            font-size: 24px!important;
        }

        .label-heading {
            font-weight: 500!important;
            display: inline-block!important;
            width: 30%!important;
        }

        .attachment-img {
            width: 200px!important;
            height: 200px!important;
            object-fit: contain!important;
            object-position: left!important;
            margin-bottom: 15px!important;
        }

        .mb-0 {
            margin-bottom: 0!important;
        }

        .d-block {
            display: block!important;
        }
    </style>
</head>
<body>
<h3 class="main-heading">Favourite</h3>
<h3>
    {{$detail['user_name']}} favourite your product {{$detail['product_title']}} reference number {{$detail['reference_no']}}.

    <?php $exist = \App\Product::where('reference_no', $detail['reference_no'])->first(); ?>
    @if($exist)
        <a target="_blank" @if(auth()->check()) href="https://www.bizonair.com/lead-favs" @else href="https://www.bizonair.com/login" @endif>Click here</a> to open!
    @else
        <a target="_blank" @if(auth()->check()) href="https://www.bizonair.com/one-time-favs" @else href="https://www.bizonair.com/login" @endif>Click here</a> to open!
    @endif
</h3>


<h1 class="mb-0 biz-thanks">Thanks {{ config('app.name') }}</h1>
</body>
</html>
