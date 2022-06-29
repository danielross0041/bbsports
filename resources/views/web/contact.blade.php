@extends('web.layouts.main')
@section('content')
<section class="contact">
    <div class="ins-heading">
        <h3>CONTACT BB SPORTS</h3>
    </div>
    <div class="container"></div>
</section>
<div class="back-img">
    <section class="bookclient-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
<section class="cont">
    <div class="container mp-ne">
        @foreach ($contact as $cnt)
        <div class="row contact-content">
            <div class="col-md-6">
                <div class="cont-content">
                    <h3>{{ $cnt->title }}</h3>
                    <ul>
                        <li>
                            <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $cnt->address }}</a>
                        </li>
                        @if ($cnt->contact != '')
                        <li>
                            <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>{{ $cnt->contact }}</a>
                        </li>
                        @endif
                        @if ($cnt->email != '')
                        <li>
                            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>{{ $cnt->email }}</a>
                        </li>
                        @endif
                    </ul>
                    @if ($cnt->email != '' || $cnt->contact != '' )
                    <h2>Text Is Quickest Way To Communicate</h2>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="map">
                    <iframe
                        src="{{ $cnt->map }}"
                        width="600"
                        height="450"
                        style="border: 0;"
                        allowfullscreen=""
                        loading="lazy"
                    ></iframe>
                </div>
            </div>
        </div>
        @endforeach
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
</section>  -->       
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection