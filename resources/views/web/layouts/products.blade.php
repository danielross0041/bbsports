<?php
$products = App\Models\product::where('is_active',1)->orderBy("id", 'desc')->paginate(9);
?>
<div class="container-fluid">
    <div class="product">
        <ul>
            @foreach($products as $key => $val)
            <li>
                <div class="product-img">
                    <img src="{{asset($val->picture)}}" />
                </div>
                <div class="product-info">
                    <h5>{{$val->name}}</h5>
                </div>
                <div class="price">
                    <p>${{$val->tagprice}}</p>
                </div>
                <div class="cart-btn">
                    <a class="res-btn" href="{{route('product_details',$val->id)}}">Add to cart</a>
                </div>
            </li>
            @endforeach
        </ul>

          {!! $products->links("pagination::bootstrap-4") !!}
    </div>
    
</div>
