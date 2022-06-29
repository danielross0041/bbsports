@extends('shop.layouts.main')
@section('content')
<!-- Header End -->
<!-- breadcrumb  -->
<?php $allColour = App\Models\product_colour::where('is_active',1)->where('product_id',$product->id)->get(); ?>
<?php $allSize = App\Models\product_size::where('is_active',1)->where('product_id',$product->id)->get(); ?>

@if (Session::has('cart'))
<section class="slot" style="display:;">
@else
<section class="slot" style="display:none;">
@endif

   <p class="display_text"></p>
   <a href="{{route('get_cart')}}">View cart</a> 
</section>

<div class="cart-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul>
                    <li><a href="{{route('welcome')}}">Home /</a></li>
                    <li><a href="#">Apparel /</a></li>
                    <li><a href="#" class="active">{{$product->name}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End  -->
<!-- main-container  -->
<div class="our-cart-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">

                <div class="laptop-sliders">
                    <div class="slider slider-for-pro">
                        @if(!$product_colour->isEmpty())
                        @foreach($product_colour as $key => $val)
                        <div>
                            <img class="slider_image" src="{{asset($val->image)}}" />
                        </div>
                        @endforeach
                        <div>
                            <img class="slider_image" src="{{asset('uploads/product/6010nl-VN-Silky-WhiteFill-NavyFill_1646838023.png')}}" />
                        </div>
                        @else
                        <div>
                            <img src="{{asset($product->picture)}}" />
                        </div>
                        @endif
                    </div>
                    <div class="slider slider-nav-pro">
                        @if(!$product_colour->isEmpty())
                        @foreach($product_colour as $val)
                        <div>
                            <img src="{{asset($val->image)}}" />
                        </div>
                        @endforeach
                        <div>
                            <img src="{{asset('uploads/product/6010nl-VN-Silky-WhiteFill-NavyFill_1646838023.png')}}" />
                        </div>
                        @endif
                    </div>
                </div>
            </div>
             <div class="col-lg-7">
                <h1 id="pricediv">{{$product->name}}</h1>
                <p id="price">${{$product->tagprice}}</p>
                <div class="row flx-row">
                    <div class="col-md-2">
                        @if(!$product_colour->isEmpty())
                        <h5>Color</h5> 
                        @endif
                    </div> 
                    <div class="col-md-10">
                        @if(!$product_colour->isEmpty())
                        <select id="colour" name="colour" class="form-control">
                            <option selected="true" disabled="disabled">Select Colour</option>
                            @foreach($product_colour as $key => $val)
                            <?php $colour = App\Models\colour::where('is_active',1)->where('id',$val->colour)->first(); ?>
                            <option value="{{$colour->id}}" data-sliderattr="{{$key}}">{{$colour->name}}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="row flx-row">
                    <div class="col-md-2">
                        @if(!$product_colour->isEmpty())
                        <h5>Size</h5> 
                        @endif
                    </div>
                    <div class="col-md-10">
                        @if(!$product_colour->isEmpty())
                        <select id="size" name="size" class="form-control">
                            <option selected="true" disabled="disabled">Select Size</option>
                        </select>
                        @endif
                   </div>
                </div>
                <input type="hidden" name="product_colour_id" id="product_colour_id" value="" />
                <input type="hidden" name="category" id="category" value="{{$product->categoryid}}" />
                <span class="green-txt"></span>
                <div class="add-to-cart">
                    <form class="" id="" method="POST" enctype="multipart/form-data" action="">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}" />
                        <input type="number" min="1" max="{{ $product->categoryid == "1" || $product->categoryid == "5"?  "1": "" }}" value="1" name="qty" id="qty" />
                        <span>
                            <button type="button" id="cart_submit" class="btn add-cart">Add to cart</button>
                        </span>
                    </form>
                    <ul class="c-share_options" data-title="Share">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook fa-1x"></i> Share on Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="desc-tab">
    <div class="container">
        <div class="tags-blk">
            <h5 class="sku_text">SKU: {{$product->sku}}</h5>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> Description</a>
            </li>
            @if(!$allColour->isEmpty())
            <li class="nav-item">
                <a class="nav-link" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true"> Additional information</a>
            </li>
            @endif
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {!!$product->desc!!}
            </div>
            <div class="tab-pane fade show" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                <div class="tbl-sec" style="">
                    @if(!$allColour->isEmpty())
                    <h2>Additional information</h2>
                    <table class="shop_attributes">
                        <tbody>
                            <tr class="attributes-item">
                                <th class="attributes-item__label">Colour</th>
                                <td class="attributes-item__value">
                                    <p>
                                        @foreach($allColour as $allCol)
                                        <?php $c = App\Models\colour::where('is_active',1)->where('id',$allCol->colour)->first(); ?>
                                        <a href="#">{{$c->name}}</a>,
                                        @endforeach
                                        
                                    </p>
                                </td>
                            </tr>
                            <tr class="attributes-item">
                                <th class="attributes-item__label">Size</th>
                                <td class="attributes-item__value">
                                    <p>
                                        @foreach($allSize as $allSiz)
                                        <?php $s = App\Models\size::where('is_active',1)->where('id',$allSiz->size)->first(); ?>
                                        <a href="#">{{$s->name}}</a>,
                                        @endforeach
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="desc-tab">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
         <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> Description</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                {!!$product->desc!!}
            </div>
        </div>
    </div>
</div> -->
@endsection
@section('js')

<script>
$('.slider-for-pro').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  asNavFor: '.slider-nav-pro'
});
$('.slider-nav-pro').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.slider-for-pro',
  dots: false,
  centerMode: false,
  focusOnSelect: true
});
    
</script>
<script type="text/javascript">
    $(document).ready(function () {
        console.log("here")
        // var check_key = ($(".slider_image").data("slider")).map(function(){return $(this).val();}).get();
        // var check_key = $(".slider_image").data("slider");
        // console.log(check_key);
    })
    $("#cart_submit").click(function(){
        var product_id = $("#product_id").val();
        var category = $("#category").val();
        console.log(category);
        var check_qty = $("#qty").attr("max");
        console.log(check_qty);
        if (check_qty) {
            stock = check_qty;
        } else{
            stock = "";
        }
        if ($("#size").val() || (category != 1 && category != 5)) {
            var product_colour = $("#colour").val();
            var product_size = $("#size").val();
            var qty = $("#qty").val();
            $.ajax({
                type: 'post',
                dataType : 'json',
                url: "{{route('save_cart')}}",
                data: {stock:stock,product_id:product_id,product_colour:product_colour,product_size:product_size, qty:qty, _token: '{{csrf_token()}}'},
                success: function (response) {
                    if (response.status == 0) {
                        toastr.error(response.message);
                    }else{
                        // location.reload();
                        $(".display_text").text(response.message)
                        $(".slot").css("display", "");
                        toastr.success(response.message);
                    }
                }
            });
        } else{
            toastr.error("Kindly choose your desired variation");
        }
    })
    $('#size').bind('change', function() {
        size_id = $(this).find(":selected").val()
        // console.log(size_id)
        product_colour_id = $("#product_colour_id").val();
        // console.log(product_colour_id);
        var product_id = {{$product->id}}

        $.ajax({
            type : 'POST',
            dataType : 'JSON',
            url: "{{route('get_stock')}}",
            data: {product_id:product_id, product_colour_id:product_colour_id, size_id:size_id, _token:"{{csrf_token()}}"},
            success: function (response) {
                if (response.status == 1) {
                    $(".sku_text").text(response.sku);
                    $(".green-txt").text(response.stock+" in stock");
                    // console.log(response.sku)
                    // console.log(response.stock)
                    $("#qty").attr({
                        "max" : response.stock
                    });
                    // $(".removal").remove();
                    // $("#size").append(response.message)
                    // $("#product_colour_id").val(response.product_colour_id)
                    // alert(response.message);
                    // $(response.message).insertAfter("#pricediv");
                }
            }
        });
    })
    $('#colour').bind('change', function() {
        // console.log($(this).find(":selected").val())
        colour_id = $(this).find(":selected").val()
        var product_id = {{$product->id}}
        $("#qty").val(1)
        $("#qty").attr({
            "max" : 1
        });
        // console.log(product_id)
        $.ajax({
            type : 'POST',
            dataType : 'JSON',
            url: "{{route('get_sizes')}}",
            data: {product_id:product_id, colour_id:colour_id, _token:"{{csrf_token()}}"},
            success: function (response) {
                if (response.status == 1) {
                    $(".sku_text").text("SKU: N/A");
                    $(".green-txt").text("");
                    // console.log(response.message)
                    $(".removal").remove();
                    $("#size").append(response.message)
                    $("#product_colour_id").val(response.product_colour_id)
                    // alert(response.message);
                    // $(response.message).insertAfter("#pricediv");
                }
            }
        });
    })

    {{--
        var total = "{{count($var)}}";
        var product_id = "{{$product->id}}";
        console.log(product_id);
        var type = [];
        var onchange = 0
        $(".change").change(function(){
            if($(this).find(":selected").val() != ""){ 
                type[onchange] = $(this).find(":selected").val();
                onchange++;
            }
            if(total  == onchange){
                console.log(type);
                $.ajax({
                    type : 'POST',
                    dataType : 'JSON',
                    url: "{{route('pricing')}}",
                    data: {product_id:product_id, type:type, _token:"{{csrf_token()}}"},
                    success: function (response) {
                        if (response.status == 1) {
                            $("#price").remove();
                            alert(response.message);
                            // $(response.message).insertAfter("#pricediv");
                        }
                    }
                });
            } 
        })

        // product id..
        // size..
        // colour..
        // productid+colour value = product list id
        // product list id->price
        // $('#categoryid').bind('change', function() {
        //     var value = $('#categoryid :selected').val();
        //     $.ajax({
        //         type : 'POST',
        //         dataType : 'JSON',
        //         url: "{{route('variation')}}",
        //         data: {id:value, _token:"{{csrf_token()}}"},
        //         success: function (response) {
        //             if (response.status == 1) {
        //                 $("#varlist").remove();
        //                 $("#repeted").append(response.message);
        //             }
        //         }
        //     });
        // });
    });
    --}}
</script>
@endsection 
