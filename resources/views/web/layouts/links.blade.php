<?php $logo = App\Models\logo::where('is_active',1)->orderBy('id','desc')->first(); ?>
@if($logo)
@php $path = $logo->image; @endphp
@else
@php $path = "web/images/logo.png"; @endphp
@endif

<link rel="icon" type="image/x-icon" href="{{asset($path)}}">
<link rel="stylesheet" href="{{asset('web/css/custom.css')}}">

<link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('web/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('web/css/slick-theme.css')}}">
<link rel="stylesheet" href="{{asset('web/css/fancybox.min.css')}}">
<link rel="stylesheet" href="{{asset('web/css/intlTelInput.css')}}">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@yield('link')

	
