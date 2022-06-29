@extends('web.layouts.main')
@section('content')
<section class="event-sec">
    <div class="container">
        <div class="events">
            <h5>Events</h5>
            <h6>Tournament</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="{{route('baseball')}}">BasketBall</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="{{route('baseball')}}">SoftBall</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="events">
            <h6>Showcases- Coming Soon!!!</h6>
        </div>
        <div class="events">
            <h6>Clinic- Coming Soon!!</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="#">BasketBall</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="#">SoftBall</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="events">
            <h6>Hittrax Tournaments- Coming Soon!!</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="#">BasketBall</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="basketball">
                        <a class="res-btn" href="#">SoftBall</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.layouts.social')
</section>
<!-- <div class="sm">
    <div class="container-fluid">
        <div class="sb">
            <h5>Share this:</h5>
            <ul>
                <li>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i>Facebook</a>
                </li>
            </ul>
        </div>
        <div class="like-bt">
            <h5>Like This:</h5>
            <a href="#"><i class="fa fa-star" aria-hidden="true"></i>Like</a>
            <p>Be the first to like this.</p>
        </div>
    </div>
</div> -->
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
