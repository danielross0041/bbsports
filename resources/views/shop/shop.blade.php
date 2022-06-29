@extends('shop.layouts.main')
@section('content')
<!-- Header End -->
<section class="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="shop-all shop-prod">
                    <span>
                        <img src="{{asset('web/img/shopall1.jpg')}}" />
                    </span>
                    <div class="shop-all-cont">
                        <h4>SHOP ALL</h4>
                        <a class="res-btn" href="{{route('shopall','shopall')}}">Click Here</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="shirts shop-prod">
                            <span>
                                <img src="{{asset('web/img/Apparel.png')}}" />
                            </span>
                            <div class="shop-content">
                                <h4>SHIRTS</h4>
                                <a class="res-btn" href="{{route('shopall','shirt')}}">Click Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shirts shop-prod">
                            <span>
                                <img src="{{asset('web/img/Screen-Shot-2020-09-10-at-1.13.59-PM.png')}}" />
                            </span>
                            <div class="shop-content">
                                <h4>HATS</h4>
                                <a class="res-btn" href="{{route('shopall','hat')}}">Click Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shirts shop-prod">
                            <span>
                                <img src="{{asset('web/img/outer.jpg')}}" />
                            </span>
                            <div class="shop-content">
                                <h4>OUTERWEAR</h4>
                                <a class="res-btn" href="{{route('shopall','outerwear')}}">Click Here</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shirts shop-prod">
                            <span>
                                <img src="{{asset('web/img/Screen-Shot-2020-09-10-at-1.33.19-PM.png')}}" />
                            </span>
                            <div class="shop-content">
                                <h4>BOTTOMS</h4>
                                <a class="res-btn" href="#">Click Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="analysis shop-prod">
                    <span>
                        <img src="{{asset('web/img/shopall2.jpg')}}" />
                    </span>
                    <div class="shop-all-cont">
                        <h4>ONLINE ANALYSIS</h4>
                        <a class="res-btn" href="{{route('shopall','onlinelesson')}}">Click Here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
if (Session::has('cart')) {
    $cart = Session::get('cart');
    if ($cart!=[]) {
        $cart_arr = array();
        $cost = 0;
        $count = 0;
        foreach ($cart as $key => $value) {
            $count++;
            $product_cart = App\Models\product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$value['product_id'])->first();
            $cart_arr[$key]['qty'] = $value['qty'];
            $cart_arr[$key]['subtotal'] = $product_cart->tagprice * $value['qty'];
            $cost = $cost + $cart_arr[$key]['subtotal'];
            if (Session::has('coupon')) {
                $coupon = Session::get('coupon');
                if ($coupon['detail'] == 'percentage') {
                    $amount = $coupon['amount'];
                    $discount = ($cost /100)*($amount);
                } else{
                    $amount = $coupon['amount'];
                    $discount = $amount;
                }
            } else{
                $discount = 0;
            }
            $total = $cost - $discount;
        }
    } else{
        $total = 0;
        $count = 0;
    }
} else{
    $total = 0;
    $count = 0;
}
?>
<section class="shop-seller shop-seller-all">
    <div class="container">
        <div class="shop-best-heading">
            <h2>BEST SELLERS</h2>
        </div>
        <div class="shop-anker">
            <a class="res-btn cart" href="{{route('get_cart')}}">${{$total}}<i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        </div>
        {{--
        <div class="shop-sort">
            <select id="cars">
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="vw">VW</option>
                <option value="audi" selected>Audi</option>
            </select>
        </div>
        --}}
        <div class="row">
            @foreach ($product as $prdct)
            <div class="col-md-3">
                <div class="shop-pro-all">
                    <div class="shop-product">
                        <img src="{{asset($prdct->picture)}}" />
                    </div>
                    <div class="shop-product-cont">
                        <h3>{{$prdct->name}}</h3>
                        <p>${{$prdct->tagprice}}</p>
                        <a class="res-btn" href="{{route('product_details',$prdct->id)}}">Select option</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="container">
    
    <a class="catalog" title="Download" target="_blank"  href="{{asset('uploads/catalog/BB-Sports-Training-Store-Catalog-1646869427.pdf')}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
Download Catalog</a>
</div>
@endsection
