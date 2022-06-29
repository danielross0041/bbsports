@extends('web.layouts.main')
@section('content')
<section class="Instructor">
    <div class="ins-heading">
        <?php echo (html_entity_decode(Helper::editck('h3', '', 'INSTRUCTORS AT BB SPORTS' ,'h3INSTRUCTORS AT BB SPORTS')));?>
    </div>
    <div class="container"></div>
</section>
<section class="instructor-img">
    <div class="container">
        <div class="ins-content">
            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our staff is second to none! All of our instructors' ,'pOur staff is second to none! All of our instructors')));?>
        </div>
        <div class="row">
            @foreach ($instructors as $ins)
            @if(($pic=$model['user']::where(['id'=>$ins->user_id])->pluck('profile_pic')->first()) != null)
            @php $path = $pic; @endphp
            @else
            @php $path = "images/no-img.png"; @endphp
            @endif
            <div class="col-md-6">
                <div class="shea-bell">
                    <img src="{{asset($path)}}" />
                    <div class="shea-bell-text">
                        <div class="bell-content">
                            <h2>{{$ins->name}}</h2>
                            <p>{{$ins->desc}}</p>
                            @if(($profile=$model['instructor_profile']::where(['user_id'=>$ins->user_id])->first()) != null)
                            <a class="res-btn" href="{{route('instructor_profile',$ins->user_id)}}">MORE INFO</a>
                            @else
                            <a class="res-btn" href="#">MORE INFO</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{--
            @foreach ($instructor as $ins)
            <div class="col-md-6">
                <?php $u='';
                $u=$ins->image;
                ?>
                <div class="shea-bell">
                    <img src="{{asset($u)}}" />
                    <div class="shea-bell-text">
                        <div class="bell-content">
                            <h2>{{$ins->name}}</h2>
                            <?php echo html_entity_decode($ins['desc']); ?>
                            <a class="res-btn" href="#">MORE INFO</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            --}}
            
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
