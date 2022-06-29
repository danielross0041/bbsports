@extends('shop.layouts.main')
@section('content')
<!-- Header End -->
<section class="view-cart">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="cart-vi">
                    <table>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Product</th>
                            <th>Colour</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach ($cart_arr as $cart)
                        <tr class="cart_table">
                            <td>
                                <button id="" class="fa fa-times remove_cart" aria-hidden="true" data-product_id = "{{$cart['product_id']}}"  data-colour ="{{isset($cart['colour']) ? $cart['colour'] : "null"}}" data-size = "{{isset($cart['size']) ? $cart['size'] : "null"}}">
                                </button>
                            </td>
                            <td>
                                <img src="{{asset($cart['image'])}}" />
                            </td>
                           
                            <td><a href="{{route('product_details',$cart['product_id'])}}">{{$cart['name']}}</a></td>
                            @if(isset($cart['colour']) && $cart['colour'] !="")
                            <?php $col = App\Models\colour::where('id',$cart['colour'])->first(); ?>
                             <td>{{$col->name}}</td>
                             @else
                             <td>-</td>
                             @endif
                             @if(isset($cart['size']) && $cart['size'] !="")
                             <?php $siz = App\Models\size::where('id',$cart['size'])->first(); ?>
                            <td>{{$siz->name}}</td>
                            @else
                             <td>-</td>
                            @endif
                            <td>${{$cart['price']}}</td>
                            <td>
                                <input type="hidden" name="product_id[]" class="product_id" value="{{$cart['product_id']}}" />
                                <input type="number" min="1" max="{{$cart['stock']}}" value="{{$cart['qty']}}" name="qty[]" class="qty" />
                                @if(isset($cart['colour']))
                                <input type="hidden" name="colour[]" class="colour" value="{{$cart['colour']}}" />
                                @else
                                 <input type="hidden" name="colour[]" class="colour" value="" />
                                 @endif
                                 @if(isset($cart['size']))
                                <input type="hidden" name="size[]" class="size" value="{{$cart['size']}}" />
                                @else
                                 <input type="hidden" name="size[]" class="size" value="" />
                                 @endif
                            </td>
                            <td>${{$cart['subtotal']}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="cart-coupon">
                        <input type="text" name="coupon" id="coupon"/> <a class="coupon res-btn" href="#">Apply Coupon</a>
                        <a class="update res-btn btn add-cart" id="update_cart" href="#">Update Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cart-totals">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="ct">
                    <div class="ct-heading">
                        <h3>Cart totals</h3>
                    </div>
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td>${{$cost}}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>${{$discount}}</td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td>${{$total}}</td>
                        </tr>
                    </table>
                    <div class="proceed">
                        <a class="res-btn" href="{{route('checkout')}}">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
@section('js')
<script type="text/javascript">
    $(".coupon").click(function(){
        var coupon = $("input[name='coupon']").val();
        console.log(coupon)
        $.ajax({
            type: 'post',
            dataType : 'json',
            url: "{{route('apply_coupon')}}",
            data: {coupon:coupon, _token: '{{csrf_token()}}'},
            success: function (response) {
                if (response.status == 0) {
                    toastr.error(response.message);
                }else{
                    location.reload();
                    toastr.success(response.message);
                }
            }
        });
    });
    $(".remove_cart").click(function(){
        var product_id = $(this).data("product_id");
        var colour = $(this).data("colour");
        var size = $(this).data("size");
        if (colour == null) {
            colour = ""
        }
        if (size == null) {
            size = ""
        }
        $.ajax({
            type: 'post',
            dataType : 'json',
            url: "{{route('remove_cart')}}",        
            data: {product_id:product_id, colour:colour, size:size, _token: '{{csrf_token()}}'},
            success: function (response) {
                if (response.status == 0) {
                    toastr.error(response.message);
                }else{
                    location.reload();
                    toastr.success(response.message);
                }
            }
        });
    })
    $("#update_cart").click(function(){
        var product_id = $("input[name='product_id[]']").map(function(){return $(this).val();}).get();

        var stock = $("input[name='qty[]']").map(function(){return $(this).attr("max");}).get();

        var colour = $("input[name='colour[]']").map(function(){return $(this).val();}).get();
        var size = $("input[name='size[]']").map(function(){return $(this).val();}).get();

        var qty = $("input[name='qty[]']").map(function(){return $(this).val();}).get();
        console.log(product_id);
        console.log(qty);
        console.log(colour);
        console.log(size);
        console.log(stock);
        $.ajax({
            type: 'post',
            dataType : 'json',
            url: "{{route('update_cart')}}",        
            data: {stock:stock,product_id:product_id, qty:qty, colour:colour, size:size, _token: '{{csrf_token()}}'},
            success: function (response) {
                if (response.status == 0) {
                    toastr.error(response.message);
                }else{
                    location.reload();
                    toastr.success(response.message);
                }
            }
        });
    })
</script>
@endsection
