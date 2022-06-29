@extends('web.layouts.main')
@section('content')
<!-- Youth Team heading and para  -->
<div class="b-youth-team">
    <!-- Headings -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php echo (html_entity_decode(Helper::editck('h1', '', 'Youth Team' ,'h1Youth Team')));?>
                <?php echo (html_entity_decode(Helper::editck('p', '', 'Our youth teams the Colorado Yetis' ,'pOur youth teams the Colorado Yetis')));?>
            </div>
        </div>
    </div>
</div>
@include('web.includes.goal')
@include('web.includes.teamgallery')
@include('web.includes.facilities')
@include('web.includes.benefits')
@include('web.includes.facilitygallery')


<div class="back-img">
    <section class="product-pagination">
        @include('web.layouts.products')
    </section>
</div>
@endsection
