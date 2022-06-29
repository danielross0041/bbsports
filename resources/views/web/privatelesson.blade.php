@extends('web.layouts.main')
@section('content')
<div class="private-main">
    <section class="private-lesson">
        <div class="container">
            <div class="training">
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'Private Lessons and Training' ,'h5PrivateLessonsandTrainingasadasd')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', 'Forget the cookie cutter programs' ,'pForget the cookie cutter programs')));?>
            </div>
        </div>
    </section>
    <section class="elevategame-sec">
        <div class="container">
            @include('web.includes.elevate')
        </div>
    </section>
</div>
<section class="prvtlesson-pricing">
    <div class="container">
        <div class="private-lesson">
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'Private Lessons' ,'h5Private Lessons')));?>
            <div class="private-list">
                <div class="row">
                    <div class="col-md-6">
                        <div class="list">
                            <h6>Single Lesson/Initial Eval</h6>
                            <div class="price-main">
                                <div class="pricee">
                                    <span class="span-1">$</span>
                                    <h4>70</h4>
                                    <span class="span-2">/session</span>
                                </div>
                                <ul>
                                    <li>If you are a new client, you will start with an evaluation that will test the skills of the athlete. Mobility, Strength, Bat Speed, Exit Velocity, Throwing Velocity, Body Mechanics, and more</li>
                                    <li>We then will get into the basics of areas we see needing fixed or improved</li>
                                    <li>Hittrax, Rapsodo, Strength Sensors, and 4D motion used</li>
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
                            <h6><span>4</span> Pack</h6>
                            <div class="price-main">
                                <div class="pricee">
                                    <span class="span-1">$</span>
                                    <h4>60</h4>
                                    <span class="span-2">/session</span>
                                </div>
                                <ul>
                                    <li>If you are a new client, you will start with an evaluation that will test the skills of the athlete. Mobility, Strength, Bat Speed, Exit Velocity, Throwing Velocity, Body Mechanics, and more</li>
                                    <li>4- 45 min sessions(If 1st time, 1st session will be evaluation)</li>
                                    <li>Hittrax, Rapsodo, Strength Sensors, and 4D motion used</li>
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
        </div>
    </div>
    @include('web.layouts.social')
</section>

<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
