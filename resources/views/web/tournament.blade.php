@extends('web.layouts.main')
@section('content')
<section class="tournament-sec">
    <div class="container">
        <h5>Tournaments</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="tounament-logo">
                    <img src="{{asset('web/images/tournament.png')}}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="usr-baseball">
                    <a class="res-btn" href="{{route('baseball')}}">BaseBall</a>
                    <p>April 17/18th - Buffalo Creek Complex - Wellington, CO</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="usr-softball">
                    <a class="res-btn" href="{{route('baseball')}}">SoftBall</a>
                    <p>April 10/11th - Buffalo Creek Complex - Wellington, CO</p>
                </div>
            </div>
        </div>
    </div>
    @include('web.layouts.social')
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
