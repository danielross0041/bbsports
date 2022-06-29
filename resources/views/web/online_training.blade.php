@extends('web.layouts.main')
@section('content')
<?php
$product = App\Models\product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',7)->orderBy('id','desc')->get();
$product_order = App\Models\product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',7)->get();
?>
<section class="online-hitting-lesson">
    <div class="container">
        <div class="o-h-l-heading">
            <h2>ONLINE LESSONS</h2>
        </div>
        <div class="row">
            @foreach($product as $key => $val)
            @if($key < 6)
            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset($val->picture)}}" />
                    </div>
                    <div class="on-hitting-content">
                        <!-- <h3>Hitting Analysis</h3> -->
                        <!-- <p>Receive video breakdown of swing mechanics along with a drill progression to follow to quickly fix problems</p> -->
                        <a href="{{route('product_details',$val->id)}}">Book Here</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            <!-- <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/onhitting.jpg')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>Hitting Analysis</h3>
                        <p>Receive video breakdown of swing mechanics along with a drill progression to follow to quickly fix problems</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/onhitting.jpg')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>4 Pack Hitting Analysis</h3>
                        <p>Best if used 1 or 2 times a week in order to allow for drill work</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/onhitting.jpg')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>8 Pack Hitting Analysis</h3>
                        <p>Best if used 1 or 2 times a week in order to allow for drill work</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div> -->
        </div>
        {{--
        <div class="o-p-l-heading">
            <h2>ONLINE PITCHING LESSONS</h2>
        </div>
        <div class="row">
            
            
            @foreach($product_order as $key => $val)
            @if($key < 3)
            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset($val->picture)}}" />
                    </div>
                    <div class="on-hitting-content">
                       <!-- <h3>Pitching  Analysis</h3>
                        <p>Receive video breakdown of throwing motion along with a drill progression to follow to quickly fix problems</p> -->
                        <a href="{{route('product_details',$val->id)}}">Book Here</a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            <!-- <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/hitting.png')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>Pitching Analysis</h3>
                        <p>Receive video breakdown of throwing motion along with a drill progression to follow to quickly fix problems</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/hitting.png')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>4 Pack Pitching Analysis</h3>
                        <p>Best if used 1 or 2 times a week in order to allow for drill work</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="online-hitting-border">
                    <div class="online-inner-phot">
                        <img src="{{asset('web/images/hitting.png')}}" />
                    </div>
                    <div class="on-hitting-content">
                        <h3>8 Pack Pitching Analysis</h3>
                        <p>Best if used 1 or 2 times a week in order to allow for drill work</p>
                        <a href="#">Book Here</a>
                    </div>
                </div>
            </div> -->
        </div>
        --}}
    </div>
    @include('web.layouts.social')
</section>

<<!-- section class="sm">
    <div class="container">
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
            <h5>Share this:</h5>
            <a href="#"><i class="fa fa-star" aria-hidden="true"></i>Like</a>
            <p>Be the first to like this.</p>
        </div>
    </div>
</section> -->

<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
