@extends('web.layouts.main')
@section('content')

<section class="walter-sec">
    <div class="container">
        <div class="walter-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="walter-img">
                    	@if(($pic=$model['user']::where(['id'=>$player->user_id])->pluck('profile_pic')->first()) != null)
                        @php $path = $pic; @endphp
                        @else
                        @php $path = "images/no-img.png"; @endphp
                        @endif
                        <img src="{{asset($path)}}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="walter-txt">
                        <h4>{{$player->name}}</h4>
                        <!-- <h3>2019 14U SELECT FESTIVAL PLAYER</h3> -->
                        <h5>{{$player->gradyear}} GRAD | {{$position=$model['position']::where(['id'=>$player->primary_position])->pluck('name')->first();}}/{{$player->throws}} | PACE, {{$cnt=$model['country']::where(['id'=>$player->country])->pluck('iso')->first();}}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="national-blk">
            <div class="row">
                <div class="col-md-6 national-line">
                    <div class="national-title">
                        <div class="national-head">
                            <h4>NATIONAL RANKING</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="national-icon">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <h3>premium</h3>
                                    <h4>OVERALL</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="national-icon">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <h3>premium</h3>
                                    <h4>3B</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="national-title">
                        <div class="national-head">
                            <h4>FL STATE RANKING</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="national-icon">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <h3>premium</h3>
                                    <h4>OVERALL</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="national-icon">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <h3>premium</h3>
                                    <h4>3B</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="national-pace">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pace-blk">
                            <h4>PACE</h4>
                            <h4>HIGH SCHOOL</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pace-blk">
                            <h4>{{$player->height}}/{{$player->weight}}</h4>
                            <h4>HEIGHT/WEIGHT</h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="pace-blk">
                            <h4>{{$player->bats}}/{{$player->throws}}</h4>
                            <h4>BATS/THROWS</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="player-sec work-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="player-tabs">
                    <div id="STATS" class="tabcontent">
                        <div class="player-txt">
                            @if(($pps=$model['player_all_stats']::where(['player_id'=>$player->id,'is_active'=>1])->orderBy('id','desc')->first()) != null)
                            <div class="player-inner">
                                <h4>{{$pps->broad_jump}}</h4>
                                <h5>BROAD JUMP</h5>
                            </div>
                            <div class="player-inner">
                                <h4>{{$pps->grip_strength}}</h4>
                                <h5>GRIP STRENGTH</h5>
                            </div>
                            <div class="player-inner">
                                <h4>{{$pps->yard20_dash}}</h4>
                                <h5>20 YARD DASH</h5>
                            </div>
                            @endif
                            @if(($pps=$model['player_position_stats']::where(['player_id'=>$player->id,'is_active'=>1])->orderBy('id','desc')->first()) != null)
                            <div class="player-inner">
                                <h4>{{$pps->max_acceleration}}</h4>
                                <h5>Acceleration</h5>
                            </div>
	                        
                            <div class="player-inner">
                                <h4>
                                	{{$pps->of_velo}}
                                </h4>
                                <h5>OF VELO</h5>
                            </div>
                            <div class="player-inner">
                                <h4>{{$pps->avg_exit_velo}}</h4>
                                <h5>EXIT VELO</h5>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="work-slider">
                    @foreach ($videos as $work)
                    <?php $u='';
                    $u=$work->image; 
                    $l=$work->link; ?>
                    <div class="work-slide">
                        <img src="{{asset($u)}}" alt="" />
                        <span>
                            <a href="{{$l}}" data-fancybox="gallery"><i class="fa fa-play" aria-hidden="true"></i></a>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
