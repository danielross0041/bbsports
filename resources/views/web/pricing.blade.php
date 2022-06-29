@extends('web.layouts.main')
@section('content')

<section class="pricing">
    <div class="pricing-background">
        <h2>Elevate Your Game</h2>
    </div>

    <div class="container">
        <div class="pricing-client-heading">
            <h4>Client Favorites</h4>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="elevate-content">
                    <a href="#peaktop_main">PeakTop Program</a>

                    <p>PeakTop Classes, Multiple Week Classes</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="elevate-content">
                    <a href="#private_lesson">Private Lessons</a>

                    <p>1 on 1 or 2 on 1 Skills or Gym Training</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="elevate-content">
                    <a href="{{route('shop')}}">Online Training/Store</a>

                    <p>Remote Training and Online Programs</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="elevate-content">
                    <a href="#memebership">College/Pro Membership</a>

                    <p>Monthly Memberships for College and Pro</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="prvtlesson-pricing">
    <div class="container">
        <div class="peaktop-main" id="peaktop_main">
            <h5>Youth PeakTop Program(ages 11-14)</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="list">
                        <h6>Youth PeakTop Basic Pass</h6>

                        <div class="price-main">
                            <div class="pricee">
                                <span class="span-1">$</span>

                                <h4>250</h4>

                                <span class="span-2">/session</span>
                            </div>

                            <ul>
                                <li>8- 45 min small group skill sessions per 30 days</li>

                                <li>4- 45 min gym small group session per 30 days</li>

                                <li>15% off additional services</li>

                                <li>1 BB Shirt shirt credit per year</li>
                            </ul>

                            <div class="book-now">
                                <a class="res-btn" href="http://app.upperhand.io/customers/1228-bb-sports-training/memberships#pdo3136" target="_blank">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="list">
                        <h6><span>Youth PeakTop Premier Pass</span> Pack</h6>

                        <div class="price-main">
                            <div class="pricee">
                                <span class="span-1">$</span>

                                <h4>350</h4>

                                <span class="span-2">/session</span>
                            </div>

                            <ul>
                                <li>Unlimited Small Group Skill Sessions per 30 Days</li>

                                <li>Unlimited Small Group Gym Session per 30 Days</li>

                                <li>1 Monthly Custom Lifting Program</li>

                                <li>1 Online Analysis per week, submitted through our 3rd party app "bb sports training"</li>

                                <li>25% off additional services</li>

                                <li>1 BB Shirt shirt credit per year</li>
                            </ul>

                            <div class="book-now">
                                <a class="res-btn" href="http://app.upperhand.io/customers/1228-bb-sports-training/memberships#pdo3135"target="_blank">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- </div> -->
        </div>
    </div>
</section>

<section class="prvtlesson-pricing">
    <div class="container">
        <div class="peaktop-main">
            <h5>HS PeakTop Program(ages 15+)</h5>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="list">
                    <h6>HS+ PeakTop Basic Pass</h6>

                    <div class="price-main">
                        <div class="pricee">
                            <span class="span-1">$</span>

                            <h4>250</h4>

                            <span class="span-2">/session</span>
                        </div>

                        <ul>
                            <li>For Athletes that are ages 15+s</li>

                            <li>8- 45 min skill sessions per month</li>

                            <li>4- 45 min gym session per month</li>

                            <li>15% off additional services</li>

                            <li>1 BB Shirt shirt credit per year</li>
                        </ul>

                        <div class="book-now">
                            <a class="res-btn" href="http://app.upperhand.io/customers/1228-bb-sports-training/memberships#pdo3133" target="_blank">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="list">
                    <h6><span>Youth PeakTop Premier Pass</span> Pack</h6>

                    <div class="price-main">
                        <div class="pricee">
                            <span class="span-1">$</span>

                            <h4>350</h4>

                            <span class="span-2">/session</span>
                        </div>

                        <ul>
                            <li>For Athletes that are ages 15+</li>

                            <li>Unlimited Skill Sessions per 30 Days</li>

                            <li>Unlimited Gym Session per 30 Days</li>

                            <li>Unlimited Open Training Sessions</li>

                            <li>1 Monthly Custom Lifting Program</li>

                            <li>1 Online Analysis per week, submitted through our 3rd party app "bb sports training</li>

                            <li>25% off additional services</li>

                            <li>1 BB Shirt shirt credit per year</li>
                        </ul>

                        <div class="book-now">
                            <a class="res-btn" href="http://app.upperhand.io/customers/1228-bb-sports-training/memberships#pdo3134" target="_blank">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- </div> -->
    </div>
</section>

<section class="pricing-small">
    <div class="container" id="private_lesson">
        <div class="pr-small">
            <h3>Private Lessons</h3>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="list">
                    <h6>Single</h6>

                    <div class="price-main">
                        <div class="pricee">
                            <span class="span-1">$</span>

                            <h4>70</h4>

                            <span class="span-2">/session</span>
                        </div>

                        <ul>
                            <li>1- 45 min sessions</li>

                            <li>Hittrax and 4D motion used</li>

                            <li>Instructors who have played College or Pro Ball</li>
                        </ul>

                        <div class="book-now">
                            <a class="res-btn" href="https://app.upperhand.io/customers/1228-bb-sports-training/events?eventTypeFilter%5B%5D=6216" target="_blank">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="list">
                    <h6>4 Pack</h6>

                    <div class="price-main">
                        <div class="pricee">
                            <span class="span-1">$</span>

                            <h4>240</h4>

                            <span class="span-2">/session</span>
                        </div>

                        <ul>
                            <li>4- 45 min sessions</li>

                            <li>Hittrax and 4D motion used</li>

                            <li>Instructors who have played College or Pro Ball</li>
                        </ul>

                        <div class="book-now">
                            <a class="res-btn" href="https://app.upperhand.io/customers/1228-bb-sports-training/events?eventTypeFilter%5B%5D=6216" target="_blank">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pricing-league">
    <div class="pricing-leag">
        <h4>Leagues<span>We currently do not have any leagues</span></h4>
    </div>

    <div class="pricing-le">
        <h4>Clinics and Live ABs <span>We currently do not have any Clinic or Live AB opportunities</span></h4>
    </div>
    <div class="pricing-le">
        <h4>College and Pro Membership</h4>
    </div>
</section>

<section class="pricing-last" id="memebership">
    <div class="container">
        <div class="list">
            <h6>College/Pro Membership</h6>

            <div class="price-main">
                <div class="pricee">
                    <span class="span-1">$</span>

                    <h4>100</h4>

                    <span class="span-2">monthly</span>
                </div>

                <ul>
                    <li>Key Card Access to the facility during 5am-12am(midnight)</li>

                    <li>Access to hittrax, rapsodo, weightroom, etc.</li>

                    <li>Can not bring anyone without a memebership</li>

                    
                </ul>

                <div class="book-now">
                    <a class="res-btn" href="https://app.upperhand.io/customers/1228-bb-sports-training/events?eventTypeFilter%5B%5D=6216" target="_blank">Book Now</a>
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
