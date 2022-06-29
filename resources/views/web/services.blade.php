@extends('web.layouts.main')
@section('content')
<!-- Slider End -->
<section class="servicemain-sec">
    <div class="container">
        <?php echo (html_entity_decode(Helper::editck('h4', '', 'BB Sports Services' ,'h4BB Sports Services')));?>
        <div class="programs">
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'PeakTop Program' ,'h5PeakTop Program')));?>
            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our top of the line program!!!' ,'pOur top of the line program!!!')));?>
            <div class="learn">
                <a class="res-btn" href="{{route('peaktop_program')}}"> Learn More</a>
            </div>
        </div>
        <div class="programs">
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'Private Lessons' ,'h5Private Lessons')));?>
            <?php echo (html_entity_decode(Helper::editck('p', '', 'Train in a 1 on 1 or 2 on 1 setting' ,'pTrain in a 1 on 1 or 2 on 1 setting')));?>
            <div class="learn">
                <a class="res-btn" href="{{route('privatelesson')}}"> Learn More</a>
            </div>
        </div>
        <div class="programs">
            <?php echo (html_entity_decode(Helper::editck('h5', '', 'PeOnline Services' ,'h5PeOnline Services')));?>
            <?php echo (html_entity_decode(Helper::editck('p', '', "Can't make it into the facility" ,"pCan't make it into the facility")));?>
            <div class="user-btn">
                <div class="row">
                    <div class="col-md-6">
                        <div class="learn-more">
                            <a class="res-btn" href="{{route('onlinelesson')}}"> Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="sign-up">
                            <a class="res-btn" href="#"> SignUp</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="programs">
                <?php echo (html_entity_decode(Helper::editck('h5', '', 'Recruiting Services' ,'h5Recruiting Services')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', "Get access to the knowledge and resources" ,"pGet access to the knowledge and resources")));?>
            </div>
        </div>
    </div>
    @include('web.layouts.social')
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection

