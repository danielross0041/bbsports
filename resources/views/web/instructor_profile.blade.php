@extends('web.layouts.main')
@section('content')

<!-- SHEA BELL  -->
<section class="shea-ball">
    <div class="shea-ball-heading">
        <div class="container">
            <h1>Shea Bell</h1>
        </div>
    </div>

    <div class="container">
        <div class="shea-ball-white">
            @foreach ($instructor_profile as $ins)
            <div class="row">
                <div class="col-md-7 shea-ball-white-text">
                    <?php echo html_entity_decode($ins->desc); ?>
                </div>
                <div class="col-md-5">
                    <div class="shea-img-1">
                        <?php 
                        $images = unserialize($ins->image);
                        if (is_array($images) || is_object($images))
                        {
                            foreach ($images as $value)
                            {
                        ?>
                        <img src="{{asset($value)}}" class="instructor-img-multiple" alt="img1" />
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
                    @include('web.layouts.social')
    </section>

    <section class="product-pagination">
        @include('web.layouts.products')
    </section>
@endsection
