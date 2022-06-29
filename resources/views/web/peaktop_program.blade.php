@extends('web.layouts.main')
@section('content')
<div class="prvt-main">
    <section class="gallery-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery1.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery1.png')}}" />
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery2.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery2.png')}}" />
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery3.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery3.png')}}" />
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery4.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery4.png')}}" />
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery5.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery5.png')}}" />
                        </div>
                    </a>
                </div>
                <div class="col-md-2">
                    <a href="{{asset('web/images/gallery6.png')}}" data-fancybox="gallery">
                        <div class="gallery-img">
                            <img src="{{asset('web/images/gallery6.png')}}" />
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="top-program">
        <div class="container">
            <div class="top-program"> 
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'Our Top of the Line Program' ,'h5Our Top of the Line Program')));?>
                <div class="top-program-info">
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'This is our top of the line training program for serious athletes' ,'pThis is our top of the line training program for serious athletes')));?>
                </div>
            </div>
        </div>
    </section>
    <section class="elevategame-sec">
        <div class="container">
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'ELEVATE YOUR GAME' ,'h5ELEVATE YOUR GAME')));?>
            @include('web.includes.elevate')
        </div>
    </section>
    <section class="prvtlesson-pricing">
        <div class="container">
            <div class="peaktop-main">
                <?php echo (html_entity_decode(Helper::editck('p', '', 'We are looking for committed athletes that are wanting' ,'pWe are looking for committed athletes that are wanting')));?>
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'Youth PeakTop Program(ages 11-14)' ,'h5Youth PeakTop Program(ages 11-14)')));?>
            </div>
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'Private Lessons' ,'h5Private Lessons')));?>
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
                                <a class="res-btn" href="http://app.upperhand.io/customers/1228-bb-sports-training/memberships#pdo3135" target="_blank">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="prvtlesson-pricing">
        <div class="container">
            <div class="peaktop-main">
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'HS/College/Pro PeakTop Program(ages 15+)' ,'h5HS/College/Pro PeakTop Program(ages 15+)')));?>
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
        </div>
    </section>
    <section class="peaktop-grp">
        <div class="container">
            <div class="peaktop-group">
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'PeakTop Small Group Schedule' ,'h5PeakTop Small Group Schedule')));?>
                <?php echo (html_entity_decode(Helper::editck('h6', '', 'This is a rough schedule for the facility, please head to our upper hand site to see the most up to date' ,'h5This is a rough schedule for the facility')));?>
                <a href="https://app.upperhand.io/customers/1228-bb-sports-training/events?viewMode=week&eventTypeFilter%5B%5D=6248&eventTypeFilter%5B%5D=6231" target="_blank">
                    <h5><span>SMALL GROUP SCHEDULE </span></h5>
                </a>
                <h6>and</h6>
                <a href="https://app.upperhand.io/customers/1228-bb-sports-training/events?viewMode=week" target="_blank">
                    <h5><span> FULL SCHEDULE </span></h5>
                </a>
            </div>
        </div>
    </section>
    <section class="product-pagination">
        @include('web.layouts.products')
    </section>
    @endsection
</div>
