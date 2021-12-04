<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="{{url('privacy')}}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="App Bizonair" />
        <meta property="fb:app_id" content="1326570987799969" />
        <meta property="og:image" content="https://www.app.bizonair.com/public/storage/settings/November2020/bizonair-logo.png" />
        <meta property="og:description" content="Home Maintenance Made Easy!!
    Connecting Customers and Service Providers for Quick, Safe, and Affordable Bookings"/>
    </head>


    <body>
                @foreach($data as $dat)
        
                    <p>{!! $dat->description !!}</p>

                @endforeach

    </body>
