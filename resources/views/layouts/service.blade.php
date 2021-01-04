<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(getConfiguration('site_favicon'))
        <link rel="shortcut icon" href="{{ url('storage') . '/' . getConfiguration('site_favicon') }}"
              type="image/x-icon"/>
    @endif
    @php
        $currentRoute = Route::currentRouteName();
    @endphp
    @if ($currentRoute == 'product.show')
        <title>{{ getHome('site_title') ? getHome('site_title') : env('APP_NAME') }} | {{ $product->name }}</title>
    @else
        <title>{{ getHome('site_title') ? getHome('site_title') : env('APP_NAME') }}{{ getHome('site_description') ? ' - ' . getHome('site_description') : '' }}</title>

    @endif
<!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/css/uikit.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- include summernote css/js -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,500i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i" rel="stylesheet">


    <link rel="stylesheet" href="http://padashaala.com/vendor/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('front/css/app.min.css') }}">
    @stack('styles')

</head>
<body >

<div class="uk-offcanvas-content">
    <div class="containers-fluid">




        @include('partials.service-header')
        @yield('service_content')
        @include('partials.footer')






    </div>


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


<!-- UIkit JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.40/js/uikit-icons.min.js"></script>


<script src="http://padashaala.com/vendor/sweetalert2/sweetalert2.min.js"></script>

<script src="{{ asset('front/js/app.min.js') }}"></script>
@stack('scripts')

</body>
</html>
