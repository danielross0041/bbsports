@extends('web.layouts.main')
@section('content')
<!-- TOP BLUE BAR -->

<section class="services_sec sec_pad">
    <div class="container">
        <div class="row responsive-slider" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
            @foreach ($blog as $key => $bl)
                @if($bl->image != null)
                @php $path = $bl->image; @endphp
                @else
                @php $path = $bl->thumbnail; @endphp
                @endif
            <div class="col-md-6 col-lg-4">
                <div class="serv-blk">
                    <div class="service_box">
                        <div class="ser_img">
                            <img src="{{asset($path)}}" class="img-fluid" />
                        </div>
                        <div class="service_content">
                            <h4>{{$bl->title}}</h4>
                            {!! \Illuminate\Support\Str::limit($bl->desc, 250, $end='...') !!}
                            <a href="{{route('blog_details',$bl->id)}}" class="read-btn">Read More</a>
                        </div>
                    </div>
                    <div class="service_btm">
                        <a href="#">{{date("M d,Y" ,strtotime($bl->created_at))}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
