@extends('web.layouts.main')
@section('content')
<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-content">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', 'BB Sports' ,'h2BB Sports')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'We are an athletic training facility that mixes a' ,'pWe are an athletic training facility that mixes a')));?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="training">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tran-process">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Training Process' ,'h2Our Training Process')));?>
                    <img src="{{asset('web/img/Training-Process.png')}}" />
                </div>
            </div>
        </div>
    </div>
</section>
<section class="evaluation">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobility">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', 'Our Evaluation Tests' ,'h2Our Evaluation Tests')));?>
                    <?php echo (html_entity_decode(Helper::editck('h3', '', 'HipExternalRotationHipInternalRotationShoulderExternalRotation' ,'h3HipExternalRotationHipInternalRotationShoulderExternalRotation')));?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<section class="for">
    <div class="container">
        <div class="fm">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <label>Player First Name*</label>
                        <input type="text" name="name" />
                    </div>
                    <div class="col-md-3">
                        <label>Player Last Name*</label>
                        <input type="text" name="name" />
                    </div>
                    <div class="col-md-3">
                        <label>Player Email*</label>
                        <input type="text" name="name" />
                    </div>
                    <div class="col-md-3">
                        <label>Player Phone(if driving self)</label>
                        <input type="text" name="name" />
                    </div>
                </div>
                <div class="row re">
                    <div class="col-md-4">
                        <label>Parent Name*</label>
                        <input type="text" name="parentname" />
                    </div>
                    <div class="col-md-4">
                        <label>Parent Email*</label>
                        <input type="text" name="parentemail" />
                    </div>
                    <div class="col-md-4">
                        <label>Parent Phone Number*</label>
                        <input type="text" name="parentname" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rad">
                            <ul>
                                <li>
                                    <input type="radio" id="baseball" name="fav_language" value="HTML" />
                                    <label for="html">Baseball</label><br />
                                </li>
                                <li>
                                    <input type="radio" id="Softball" name="fav_language" value="HTML" />
                                    <label for="html">Softball</label><br />
                                </li>
                                <li>
                                    <input type="radio" id="football" name="fav_language" value="HTML" />
                                    <label for="html">Football</label><br />
                                </li>

                                <li>
                                    <input type="radio" id="Basketball" name="fav_language" value="HTML" />
                                    <label for="html">Basketball</label><br />
                                </li>

                                <li>
                                    <input type="radio" id="soccer" name="fav_language" value="HTML" />
                                    <label for="html">Soccer</label><br />
                                </li>

                                <li>
                                    <input type="radio" id="volleyball" name="fav_language" value="HTML" />
                                    <label for="html">Volleyball</label><br />
                                </li>

                                <li>
                                    <input type="radio" id="tennis" name="fav_language" value="HTML" />
                                    <label for="html">Tennis</label><br />
                                </li>

                                <li>
                                    <input type="radio" id="golf" name="fav_language" value="HTML" />
                                    <label for="html">Golf</label><br />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Experience*</label>
                        <select name="cars" id="cars">
                            <option value="volvo">10U</option>
                            <option value="volvo">11U</option>
                            <option value="volvo">12U</option>
                            <option value="volvo">13U</option>
                            <option value="volvo">14U</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">High School</option>
                            <option value="audi">College</option>
                            <option value="audi">Professional</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Password*</label>
                        <input type="Password" name="Password" />
                    </div>
                    <div class="col-md-4">
                        <label>Confirm Password*</label>
                        <input type="Password" name="confirmpass" />
                    </div>
                </div>
                <div class="sub">
                    <a class="res-btn" href="#">Submit</a>
                </div>
            </form>
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
