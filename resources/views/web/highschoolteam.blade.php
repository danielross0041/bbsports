@extends('web.layouts.main')
@section('content')
<section class="highschool-sec">
    <div class="container">
        <?php echo (html_entity_decode(Helper::editck('h5', '', 'High School Showcase Teams' ,'h5High School Showcase Teams')));?>
        <div class="row rh">
            <div class="col-md-3">
                <div class="stu-logo">
                    <img src="{{asset('web/images/studentlogo.png')}}" />
                </div>
            </div>
            <div class="col-md-9">
                <div class="school-info">
                    <?php echo (html_entity_decode(Helper::editck('p', '', 'BB Elite is a college showcase and prep team ' ,'pBB Elite is a college showcase and prep team ')));?>
                </div>
            </div>
        </div>
        <div class="school-team">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="basball-team">
                        <?php echo (html_entity_decode(Helper::editck('h6', '', 'High School Baseball Teams' ,'h6High School Baseball Teams')));?>
                        <ul>
                            @foreach ($baseball as $bsball)
                            <li><a href="{{route('team_listing',$bsball->id)}}">{{$bsball->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="softball-team">
                        <?php echo (html_entity_decode(Helper::editck('h6', '', 'High School Softball Teams' ,'h6High School Softball Teams')));?>
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
@include('web.includes.benefits')
@include('web.includes.facilities')
@include('web.includes.facilitygallery')


@include('web.layouts.social')
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
