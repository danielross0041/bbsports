@extends('web.layouts.main')
@section('content')
<div class="blog-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Blogs</h1>
            </div>
        </div>
    </div>
</div>
<section class="prod-section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @if($images != null)
                <div class="product-details">
                    <div class="slider-for">
                        @foreach ($images as $key => $img)
                        <div class="items">
                            <img src="{{asset($img->image)}}" alt="" />
                        </div>
                        @endforeach
                    </div>
                    <div class="slider-nav">
                        @foreach ($images as $key => $img)
                        <div class="item-img">
                            <img src="{{asset($img->image)}}" alt="" />
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="video-rw">
                    <div class="vid-area">
                        <div class="play-btn">
                            <div class="play">
                                <a data-fancybox="gallery" data-src="{{$mainBlog->link}}" width="100%" height="500" controls="controls" preload="metadata">
                                    <img src="{{asset($mainBlog->thumbnail)}}" />
                                    <svg
                                        version="1.1"
                                        id="play"
                                        x="0px"
                                        y="0px"
                                        height="100px"
                                        width="100px"
                                        viewBox="0 0 100 100"
                                        enable-background="new 0 0 100 100"
                                        xml:space="preserve"
                                    >
                                        <path
                                            class="stroke-solid"
                                            fill="none"
                                            stroke="#fff"
                                            d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
                                            C97.3,23.7,75.7,2.3,49.9,2.5"
                                        />
                                        <path class="icon" fill="#fff" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="product-descript">
                    <h2>{{$mainBlog->title}}</h2>
                    {!!$mainBlog->desc!!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="product-search-sec">
                    <h2>Latest Blogs</h2>
                    @foreach ($blogs as $key => $blog)
                    <div class="latest-content-sec">
                        <a href="{{route('blog_details',$blog->id)}}">
                            <div class="pro-imgs">
                                @if($blog->image != null)
                                <img src="{{asset($blog->image)}}" alt="" />
                                @else
                                <img src="{{asset($blog->thumbnail)}}" alt="" />
                                @endif
                            </div>
                            <div class="pro-txt">
                                <a href="">
                                    <h3>{{$blog->title}}</h3>
                                </a>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
