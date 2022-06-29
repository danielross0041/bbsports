<?php
$players = App\Models\player::where('is_active',1)->where('is_deleted',0)->get();
?>
<div class="family-slider">
    @foreach($players as $val)
    <?php $ply = App\Models\User::where('is_active',1)->where('id',$val->user_id)->first(); ?>
    @if($ply->profile_pic != null)
    @php $path = $ply->profile_pic; @endphp
    @else
    @php $path = "images/no-img.png"; @endphp
    @endif
    <div class="family-slide">
        <img src="{{asset($path)}}" />
    </div>
    @endforeach
    <!-- <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img2.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img3.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img4.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img5.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img6.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img7.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img8.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img9.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img1.png')}}" />
    </div>
    <div class="family-slide">
        <img src="{{asset('web/images/family-slide-img2.png')}}" />
    </div> -->
</div>