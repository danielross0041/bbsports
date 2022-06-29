@extends('shop.layouts.main')
@section('content')
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
    <div class="container-fluid">
        <div class="shop-anker">
            <nav>
                <a href="{{route('welcome')}}">Home /</a>

                <a href="{{route('shop')}}">Shop /</a>

                <a href="#"> Shop All</a>
            </nav>
            <a class="res-btn cart" href="{{route('get_cart')}}">${{$total}}<i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="container">
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
{{--
<!-- best seller -->
<section class="product-pagination product-pagination-cards">
    <div class="container">
        <div class="pagination-card-heading">
            <h2>Best Sellers</h2>
        </div>

        <div class="product">
            <ul>
                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/3.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>4 Pack Online Hitting Lesson</h5>
                    </div>

                    <div class="price">
                        <p>$100.00</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Add to cart</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/7.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB American Flag Men’s Long Sleeve T-Shirt</h5>
                    </div>

                    <div class="price">
                        <p>$24.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Select Options</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/18.jpg')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB White/White Richardson Hat</h5>
                    </div>

                    <div class="price">
                        <p>$24.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Add to cart</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/7.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB Silver/Heather Navy Richardson Hat</h5>
                    </div>

                    <div class="price">
                        <p>$24.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Add to cart</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/6.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>8 Pack Online Pitching Lesson</h5>
                    </div>

                    <div class="price">
                        <p>$175.00</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Add to cart</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/10.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB Black/Charcoal Richardson Hat</h5>
                    </div>

                    <div class="price">
                        <p>$24.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Select Options</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/12.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB Men’s Long Sleeve T-Shirt</h5>
                    </div>

                    <div class="price">
                        <p>$24.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Select Options</a>
                    </div>
                </li>

                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/1.jpg')}}" />
                    </div>

                    <div class="product-info">
                        <h5>12 Week Power and Velo Workout</h5>
                    </div>

                    <div class="price">
                        <p>$99.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Add to cart</a>
                    </div>
                </li>
                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/21.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB Womens TriBlend T-Shirt</h5>
                    </div>

                    <div class="price">
                        <p>$22.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Select Options</a>
                    </div>
                </li>
                <li>
                    <div class="product-img">
                        <img src="{{asset('web/img/8.png')}}" />
                    </div>

                    <div class="product-info">
                        <h5>BB American Flag Mens TriBlend T-Shirt</h5>
                    </div>

                    <div class="price">
                        <p>$22.99</p>
                    </div>

                    <div class="cart-btn">
                        <a href="">Select Options</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="pagination">
            <a href="#">1</a>

            <a class="active" href="#">2</a>

            <a href="#">3</a>

            <a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</section>

<!-- best seller end -->

<section class="sm">
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
</section>
--}}
<div class="container">
    
    <a class="catalog" title="Download" target="_blank"  href="{{asset('uploads/catalog/BB-Sports-Training-Store-Catalog-1646869427.pdf')}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
Download Catalog</a>
</div>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection