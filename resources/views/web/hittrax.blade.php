@extends('web.layouts.main')
@section('content')

<section class="leagues">
    <div class="leagues-background">
        <div class="container">
            <h2>BB SPORTS HitTrax HITTING LEAGUE</h2>
        </div>
    </div>
</section>

<section class="leagues-c">
    <div class="container">
        <div class="leagues-main-background">
            <div class="row">
                <div class="col-md-4">
                    <div class="league-photo">
                        <img src="{{asset('web/images/league1.jpg')}}" />
                        <h5>Fall Hittrax League</h5>
                        <p><a href="#">October 12, 2020</a> /// <a href="#">No Comments</a></p>
                        <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="league-photo">
                        <img src="{{asset('web/images/league2.png')}}" />
                        <h5>Fall Hittrax League</h5>
                        <p><a href="#">October 12, 2020</a> /// <a href="#">No Comments</a></p>
                        <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="league-photo">
                        <div class="img-hold"><img src="{{asset('web/images/league3.jpg')}}" /></div>
                        <h5>Fall Hittrax League</h5>
                        <p><a href="#">October 12, 2020</a> /// <a href="#">No Comments</a></p>
                        <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div class="leagues-tap">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                </ul>
                <p>Utilizing HitTrax technology, BB Sports offers winter hitting leagues for players to both elevate their game and also have some fun while they are at it!</p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="list">
                        <h6>Fall Hittrax League Solo Pricing</h6>
                        <div class="price-main">
                            <div class="pricee">
                                <span class="span-1">$</span>
                                <h4>125</h4>
                                <span class="span-2">/session</span>
                            </div>
                            <ul>
                                <li>Will be placed with other players of similar age</li>
                                <li>4-6 kids per team</li>
                                <li>6 Game Guaranteed(unless severe weather or COVID)</li>
                                <li>25 Minute per game or 7 Innings</li>
                                <li>Playoff week will be Dec 17th</li>
                                <li>All Star Week will be in between Dec 2nd and Dec 6th and will consist of All Star Game and Homerun Derby</li>
                                <li>Prizes for Championship Winner, Runner Up, All Star Game Winner, and Homerun Derby winner</li>
                            </ul>

                            <div class="book-now">
                                <a class="res-btn" href="#">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list">
                        <h6>Fall Hittrax League Team Pricing</h6>
                        <div class="price-main">
                            <div class="pricee">
                                <span class="span-1">$</span>
                                <h4>500</h4>
                                <span class="span-2">/session</span>
                            </div>
                            <ul>
                                <li>4-6 kids per team</li>
                                <li>6 Game Guaranteed(unless severe weather or COVID)</li>
                                <li>25 Minute per game or 7 Innings</li>
                                <li>Playoff week will be Dec 17th</li>
                                <li>All Star Week will be in between Dec 2nd and Dec 6th and will consist of All Star Game and Homerun Derby</li>
                                <li>Prizes for Championship Winner, Runner Up, All Star Game Winner, and Homerun Derby winner</li>
                            </ul>

                            <div class="book-now">
                                <a class="res-btn" href="#">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="leage-pr-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="league-bass">
                            <img src="{{asset('web/images/league6.jpg')}}" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="league-bass-content">
                            <h5>Do I have to have a team to sign up?</h5>
                            <p>Single and Duos will be put on our wait list and will be put with other duos and singles for the season.</p>

                            <h5>How do the divisions work?</h5>
                            <p>We’ll wait until all the teams participating are registered, but divisions will be determined by age.</p>
                            <p>Hittrax Technology adapts to ages and moves fences and fielder difficulties based on age though, so technically a 9u team could play an 18u team and the software adjusts to make the game fair.</p>
                            <p>After registration closes, we will email participants the division that they will participate in.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="league-bass-content">
                            <h5>What if a player has to miss a game?</h5>
                            <p>If a player has to miss a game we will allow a substitute to participate for that player.</p>
                            <p>However, the player or the players teammates are responsible for finding the sub.</p>

                            <h5>Scheduling Flexibility</h5>
                            <p>We will release the schedule at the beginning of the season and we ask that teams commit to the schedule. We will do our best to help with issues, but we ask that you show up for scheduled times</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="league-bass">
                            <img src="{{asset('web/images/league7.jpg')}}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('web.layouts.social')
</section>

<!-- <section class="sm">
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
