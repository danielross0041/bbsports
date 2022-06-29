@extends('web.layouts.main')
@section('content')
<section class="online">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="online-cont">
                    <?php echo (html_entity_decode(Helper::editck('h2', '', 'BB SPORTS ONLINE TRAINING' ,'h2BB SPORTS ONLINE TRAINING')));?>
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'Our head instructor Shea Bell has done' ,'pOur head instructor Shea Bell has done')));?>
                </div>
                @include('web.includes.athletes')
                <div class="online-buy-now">
                    <a class="res-btn" href="{{route('onlinetraining')}}">Buy Now</a>
                </div>
                <div class="online-s-link">
                    <a href="https://www.facebook.com/bbsportstraining" target="_blank"><i class="fa fa-facebook-square fa" aria-hidden="true"></i></a>
                    <a href="https://www.instagram.com/bbsportstraining/?hl=en" target="_blank"><i class="fa fa-instagram ins" aria-hidden="true"></i></a>
                    <a href="https://www.youtube.com/channel/UC4hjycqrsCyQGNvjcETT7IA" target="_blank"><i class="fa fa-youtube-play you" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="online-expert">
    <div class="container">
        <div class="expert-content">
            <?php echo (html_entity_decode(Helper::editck('h2', '', 'WHAT SHOULD YOU EXPECT?' ,'h2WHAT SHOULD YOU EXPECT?')));?>
        </div>
        <div class="online-all-border bg-white">
            <div class="row">
                <div class="col-md-6">
                    <div class="online-analysis">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '1) Skills and Mobility Analysis' ,'h31) Skills and Mobility Analysis')));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="online-hand">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '2) Easy Video Upload with APEX by Upper Hand' ,'h32) Easy Video Upload with APEX by Upper Hand')));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="online-all-border">
            <div class="row">
                <div class="col-md-6">
                    <div class="online-analysis">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '3)Top of the Line Evaluations' ,'h33)Top of the Line Evaluations')));?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="online-hand">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '4) Lesson Plans' ,'h34) Lesson Plans')));?>
                    </div>
                </div>
            </div>
        </div>
        <div class="online-all-border bg-white">
            <div class="row">
                <div class="col-md-12">
                    <div class="online-pay">
                        <?php echo (html_entity_decode(Helper::editck('h3', '', '5) Multiple Ways to Pay' ,'h35) Multiple Ways to Pay')));?>
                    </div>
                    <div class="online-anker">
                        <a href="{{route('onlinetraining')}}">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="back-img">
    
    <section class="work-sec">
        <div class="container">
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
        </div>
    </section>
</div>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
