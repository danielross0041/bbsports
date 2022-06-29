@extends('web.layouts.main')
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('web/images/home-banner-img.png')}}" alt="home-banner-img" />
            <div class="carosel-cap">
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'BUILT ELITE' ,'h4BUILT ELITE')));?>
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'TRAIN ELITE' ,'h4TRAIN ELITE')));?>
                <div class="carosel-btn">
                    <a href="#client">new clients</a>
                    <a href="{{route('pricinghome')}}">book now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="partner-sec">
    <div class="container">
        <div class="partner-title">
            <?php echo (html_entity_decode(Helper::editck('h4', '', 'OUR PARTNERS' ,'h4OUR PARTNERS')));?>
        </div>
        <div class="partner-slider">
            @foreach ($partners as $prt)
            <?php
            $u='';
            $u=$prt->image;
            ?>
            <div class="partner-slide">
                <img src="{{asset($u)}}" />
            </div>
            @endforeach
            <!-- <div class="partner-slide">
                <img src="{{asset('web/images/lorem-slider-img1.png')}}" />
            </div>
            <div class="partner-slide">
                <img src="{{asset('web/images/lorem-slider-img1.png')}}" />
            </div>
            <div class="partner-slide">
                <img src="{{asset('web/images/lorem-slider-img1.png')}}" />
            </div>
            <div class="partner-slide">
                <img src="{{asset('web/images/lorem-slider-img1.png')}}" />
            </div> -->
        </div>
    </div>
</section>
<div class="back-img">
    <section class="wilson-sec">
        <div class="container">
            <div class="wilson-blk">
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'Best Wilson, Demarini, ATEC, and Louisville Slugger Deals' ,'h4Best Wilson, Demarini, ATEC, and Louisville Slugger Deals')));?>
                <div class="wilson-btn">
                    <a
                        class="res-btn"
                        href="https://www.wilson.com/en-us?clickid=Q-UQ0H3WRxyIUO-WCzznVUCXUkGwv2URqSmcw40&cmpid=aff%7CONLINE_TRACKING_LINK%7Cimpact%7CBB%20Sports%7Cwilsonfamilyofbrands%7COnline%20Tracking%20Link&Utm_source=impact&Utm_medium=affiliate&Utm_campaign=BB%20Sports&utm_content=Online%20Tracking%20Link&irgwc=1"
                        target="_blank"
                    >
                        wilson
                    </a>
                    <a class="res-btn" href="https://www.demarini.com/en-us/sale/outlet?clickid=Q-UQ0H3WRxyIUO-WCzznVUCXUkGwv2UVqSmcw40&irgwc=1" target="_blank">demarini</a>
                </div>
            </div>
        </div>
    </section>
    <section class="work-sec">
        <div class="container">
            <div class="work-title">
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'Our Work' ,'h4Our Work')));?>
            </div>
            <div class="work-slider">
                @foreach ($ourwork as $work)
                <?php $u='';
                $u=$work->image; $l=$work->link; ?>
                <div class="work-slide">
                    <img src="{{asset($u)}}" alt="" />
                    <span>
                        <a href="{{$l}}" data-fancybox="gallery"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </span>
                </div>
                @endforeach
            </div>
            <div class="work-social">
                <ul>
                    <li>
                        <?php $fb = App\Models\config::where('type','facebooklink')->first(); ?>
                        <?php $ins = App\Models\config::where('type','instagramlink')->first(); ?>
                        <?php $yt = App\Models\config::where('type','youtubelink')->first(); ?>
                        <a href="{{$fb->value}}" target="_blank" style="background-color: #3b5998;"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="{{$ins->value}}" target="_blank" style="background-color: #262626;"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="{{$yt->value}}" target="_blank" style="background-color: #cd201f;"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>
<div class="back-img">
    <section class="peaktop-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/peaktop-img1.jpg')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'Peaktop Program' ,'h4Peaktop Program')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our top of the line training program!! Built from organizations like the Yankees, Blue Jays, Dodgers, and more' ,'pOur top of the line training program!! Built from organizations like the Yankees, Blue Jays, Dodgers, and more')));?>
                            <a class="res-btn" href="{{route('peaktop_program')}}">more info</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/peaktop-img2.jpg')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'APPAREL' ,'h4APPAREL')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our apparel, equipment, and more' ,'pOur apparel, equipment, and more')));?>
                            <a class="res-btn" href="{{route('shop')}}">more info</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/peaktop-img3.jpg')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'ONLINE PROGRAMS' ,'h4ONLINE PROGRAMS')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our programs are designed to get the most out of your training' ,'pOur programs are designed to get the most out of your training')));?>
                            <a class="res-btn" href="{{route('onlinetraining')}}">more info</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/peaktop-img4.jpg')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'PRIVATE LESSONS' ,'h4PRIVATE LESSONS')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Get one on one lessons/training for hitting, pitching, fielding, catching, lifting, speed/agility, and more' ,'pGet one on one lessons/training for hitting, pitching, fielding, catching, lifting, speed/agility, and more')));?>
                            <a class="res-btn" href="{{route('privatelesson')}}">more info</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/peaktop-img5.jpg')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'HITTRAX LEAGUES & GAMES' ,'h4HITTRAX LEAGUES & GAMES')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Indoor leagues and games to train and play year round in a competitive setting' ,'pIndoor leagues and games to train and play year round in a competitive setting')));?>
                            <a class="res-btn" href="{{route('hittrax')}}">more info</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="peaktop-blk shop-prod">
                        <img src="{{asset('web/images/recruited.png')}}" />
                        <div class="peaktop-cap">
                            <?php echo (html_entity_decode(Helper::editck('h4', '', 'RECRUITING VIDEOS' ,'h4RECRUITING VIDEOS')));?>
                            <?php echo (html_entity_decode(Helper::editck('p', '', 'Showcase your talent to college coaches all over the country with our recruiting services' ,'pShowcase your talent to college coaches all over the country with our recruiting services')));?>
                            <a class="res-btn" href="{{route('recruiting')}}">more info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="family-sec">
        <div class="container">
            <div class="family-title">
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'THE BB SPORTS FAMILY' ,'h4THE BB SPORTS FAMILY')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', 'All of our instructors are highly qualified and have played sports at high school, collegiate, and professional levels. We have a passion for all sports and want every athlete that joins our BB Sports Family to develop
                    that same passion.' ,'pAll of our instructors are highly qualified and have played sports at high school, collegiate, and professional levels. We have a passion for all sports and want every athlete that joins our BB Sports Family to develop
                    that same passion.')));?>
                <a class="res-btn" href="{{route('instructor')}}">Instructor</a>
                <?php echo (html_entity_decode(Helper::editck('h4', '', 'PRO AND COLLEGE ATHLETES USING FACILITY' ,'h4PRO AND COLLEGE ATHLETES USING FACILITY')));?>
            </div>
            @include('web.includes.athletes')
        </div>
    </section>
</div>
<div class="back-img">
    <section class="testi-sec">
        <div class="container">
            <div class="testi-info">
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'Testimonials' ,'Testimonials')));?>
            </div>
            <div class="testi-slider">
                @foreach ($testimonials as $tst)
                <div class="testi-slide">
                    <h4>{{ $tst->name }}</h4>
                    <ul>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                    </ul>
                    <?php echo html_entity_decode($tst['desc']); ?>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="bookclient-sec">
        <div class="container">
            <div class="row">
                <div class="booking">
                    <div class="booking-info" id="client">
                        <?php echo (html_entity_decode(Helper::editck('h4', '', 'New Clients' ,'h4New Clients')));?>
                        <?php echo (html_entity_decode(Helper::editck('h5', '', 'For someone to contact you, complete the form below...Or head to our booking website by clicking on the button here Everything can be booked and bought on this site' ,'h5For someone to contact you, complete the form below...Or head to our booking website by clicking on the button here Everything can be booked and bought on this site')));?>
                        <a class="res-btn" href="https://app.upperhand.io/customers/1228/create_user" target="_blank">Book Here</a>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="{{route('contact_details')}}">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="user-input">
                            <div class="col-md-12">
                                <label class="custom" for="athlete_level">Athlete Level* </label>
                                <select name="athlete_level" id="athlete_level" required="" required>
                                    <option value="Pro">Pro</option>
                                    <option value="College">College</option>
                                    <option value="High School">High School</option>
                                    <option value="Youth">Youth</option>
                                </select>
                            </div>
                        </div>
                        <div class="user-input">
                            <div class="col-md-12">
                                <label class="custom" for="training_type">Training Type*</label>
                                <select name="training_type" id="training_type" required="" required>
                                    <option value="Hitting">Hitting</option>
                                    <option value="Pitching">Pitching</option>
                                    <option value="Lifting">Lifting</option>
                                    <option value="Hitting/Lifting">Hitting/Lifting</option>
                                    <option value="Hitting/Lifting">Pitching/Lifting</option>
                                </select>
                            </div>
                        </div>
                        <div class="user-input">
                            <div class="col-md-12">
                                <label class="custom" for="preferred_training">Preferred Training*</label>
                                <select name="preferred_training" id="preferred_training" required="" required>
                                    <option value="In Person">In Person</option>
                                    <option value="Remote">Remote</option>
                                </select>
                            </div>
                        </div>
                        <div class="user-inputt">
                            <div class="col-md-6">
                                <label class="custom" for="first_name">Player Name*</label>
                                <input type="text" name="first_name" id="first_name" required="" required/>
                                <p class="first">First</p>
                            </div>
                            <div class="col-md-6 md6">
                                <input type="text" name="last_name" id="last_name" required="" required/>
                                <p class="first">Last</p>
                            </div>
                        </div>
                        <div class="user-input">
                            <div class="col-md-12">
                                <input id="phone" name="phone" id="phone" type="tel" required="" required/>
                            </div>
                        </div>
                        <div class="user-input mail">
                            <div class="col-md-12">
                                <div class="user-input">
                                    <label class="custom" for="email">Email*</label>
                                    <input type="email" name="email" id="email" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="user-rangeslider">
                            <div class="col-md-12">
                                <div class="slider-main">
                                    <label for="range">Athlete Age(In-Person Training 10-30)</label>
                                    <div class="slidecontainer">
                                        <input type="range" name="range" min="10" max="30" value="11" class="slider" id="myRange" />
                                        <p>Value:<span id="demoo"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-input checkbox">
                            <div class="col-md-12">
                                <label class="custom" for="position">Positions(select all that apply) </label>
                                <div class="list-main">
                                    <ul>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="p" /> <label for="vehicle1">p</label></li>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="1B" /> <label for="vehicle1">1B</label></li>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="2B" /> <label for="vehicle1">2B</label></li>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="SS" /> <label for="vehicle1">SS</label></li>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="3B" /> <label for="vehicle1">3B</label></li>
                                        <li><input type="checkbox" id="checkbox" name="position[]" value="OF" /> <label for="vehicle1">OF</label></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="message">
                            <div class="col-md-12">
                                <label class="custom">Comment or Message </label>
                                <textarea name="comment"></textarea>
                            </div>
                        </div>
                        <div class="submit-btn">
                            <div class="col-md-12">
                                <button>Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="back-img">
    <section class="product-pagination">
        @include('web.layouts.products')
    </section>
</div>
@endsection
