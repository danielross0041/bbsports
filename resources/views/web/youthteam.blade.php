@extends('web.layouts.main')
@section('content')
<section class="youth-team">
    <div class="container">
        <?php echo (html_entity_decode(Helper::editck('h5', '', 'Youth Teams' ,'h5Youth Teams')));?>
        <div class="row">
            <div class="col-md-6">
                <div class="youh-logo">
                    <img src="{{asset('web/images/youth1.png')}}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="youh-logo">
                    <img src="{{asset('web/images/youth2.png')}}" />
                </div>
            </div>
        </div>
        <div class="youth-info">
            <?php echo (html_entity_decode(Helper::editck('p', '', 'Our youth teams the Colorado' ,'pOur youth teams the Colorado')));?>
        </div>
        <div class="school-team">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="basball-team">
                        <?php echo (html_entity_decode(Helper::editck('h6', '', 'Youth Baseball Teams' ,'h6Youth Baseball Teams')));?>
                        <ul>
                            @foreach ($baseball as $bsball)
                            <li><a href="{{route('team_listing',$bsball->id)}}">{{$bsball->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="softball-team">
                        <?php echo (html_entity_decode(Helper::editck('h6', '', 'Youth Softball Teams' ,'h6Youth Softball Teams')));?>
                        <ul>
                            @foreach ($softball as $sfball)
                            <li><a href="{{route('team_listing',$sfball->id)}}">{{$sfball->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('web.includes.goal')
@include('web.includes.teamgallery')
@include('web.includes.facilities')
@include('web.includes.benefits')
@include('web.includes.facilitygallery')


@include('web.layouts.social')
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection