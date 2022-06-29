@extends('web.layouts.main')
@section('content')

<section class="showdown-softball">
    <div class="container">
        <div class="img-holder">
            <img src="{{asset('images/2021-Showdown-At-The-Well-p1t871qhl6821ejb2lqzx4ui9eo14vug0l2d6l0w74.png')}}" alt="" />
            <div class="yellow-heading">
                <h3>April 10/11th - Buffalo Creek Complex - Wellington, CO</h3>
            </div>
            <ul class="two-btns">
                <li><a href="#">14U Sign Up</a></li>
                <li><a href="#">16U Sign Up</a></li>
            </ul>
        </div>
    </div>

    <div class="showdown-two-col">
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <img src="{{asset('images/groupphoto.jpeg')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>

<section class="scandup">
    <div class="container-fluid">
        <h2>Schedule and Updates</h2>

        <iframe
            style="display: block; overflow: scroll;"
            src="https://tourneymachine.com/Public/Results/TournamentEmbed.aspx?IDTournament=h202104021632078070460c3e82c3545"
            height="800"
            width="100%"
            allowfullscreen=""
            frameborder="0"
            scrolling="yes"
        ></iframe>
    </div>
</section>

<section class="more-info">
    <p>
        For more information, questions, or troubleshooting contact:<br />
        tournaments@bbsportstraining.com
    </p>
</section>
@include('web.layouts.social')
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
