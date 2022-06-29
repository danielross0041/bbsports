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
?><!-- Header Start -->
<div class="container">
    <div class="row">
        <div class="col-md-1">
            <div class="logo">
                <?php $logo = App\Models\logo::where('is_active',1)->orderBy('id','desc')->first(); ?>
                @if($logo)
                @php $path = $logo->image; @endphp
                @else
                @php $path = "web/images/logo.png"; @endphp
                @endif
                <a href="{{route('welcome')}}"><img src="{{asset($path)}}" /></a>
            </div>
        </div>
        <div class="col-md-8">
            <nav id="cssmenu">
                <div id="head-mobile"></div>
                <div class="button"></div>
                <ul class="hdr-menu">
                    <li class="{{(isset($menu) && $menu  == 'home'?'active':'')}}"><a class="anchor" href="{{route('welcome')}}">HOME</a></li>
                    <li class="{{(isset($menu) && $menu  == 'shop'?'active':'')}}"><a class="anchor" href="{{route('shop')}}">shop</a></li>
                    <li class="{{(isset($menu) && $menu  == 'services'?'active':'')}}">
                        <a class="anchor" href="{{route('services')}}">Services</a>
                        <ul>
                            <li><a href="{{route('peaktop_program')}}">peaktop program</a></li>
                            <li><a href="{{route('privatelesson')}}">private lessons/training </a></li>
                            <li><a href="{{route('onlinelesson')}}">online lesson</a></li>
                        </ul>
                    </li>
                    <li class="{{(isset($menu) && $menu  == 'teams'?'active':'')}}">
                        <a class="anchor" href="{{route('teams')}}">Teams</a>
                        <ul>
                            <li><a href="{{route('highschoolteam')}}">High School Teams</a></li>
                            <li><a href="{{route('youthteam')}}">Youth Teams</a></li>
                        </ul>
                    </li>
                    <li class="{{(isset($menu) && $menu  == 'recruiting'?'active':'')}}">
                        <a class="anchor" href="{{route('recruiting')}}">Recruits</a>
                        <ul>
                            <li><a href="{{route('baseball')}}">Baseball</a></li>
                            <li><a href="{{route('softball')}}">Softball</a></li>
                        </ul>
                    </li>
                    <li class="{{(isset($menu) && $menu  == 'event'?'active':'')}}">
                        <a class="anchor" href="{{route('event')}}">Events</a>
                        <ul>
                            <li><a href="{{route('tournament')}}">Tournaments</a></li>
                        </ul>
                    </li>
                    <li class="{{(isset($menu) && $menu  == 'blog'?'active':'')}}"><a class="anchor" href="{{route('blog')}}">Blog</a></li>
                    <li class="{{(isset($menu) && $menu  == 'about'?'active':'')}}">
                        <a class="anchor" href="{{route('about')}}">ABOUT</a>
                        <ul>
                            <li><a href="{{route('instructor')}}">Instructor</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </li>
                    
                    
                    
                    
                    @auth
                        <li class="">
                            <a class="anchor" href="{{route('dashboard')}}">Admin Panel</a>
                        </li>
                        <li class="">
                            <a class="anchor" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="{{(isset($menu) && $menu  == 'login'?'active':'')}}">
                            <a class="anchor" href="{{route('login')}}">login/register</a>
                            <ul>
                                <li><a href="{{route('register')}}">register</a></li>
                                <li><a href="{{route('login')}}">login</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
        <div class="col-md-3">
            <div class="header-cart">
                <ul>
                    <li>
                        <?php $fb = App\Models\config::where('type','facebooklink')->first(); ?>
                        <?php $ins = App\Models\config::where('type','instagramlink')->first(); ?>
                        <a href="{{$ins->value}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="{{$fb->value}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="{{route('get_cart')}}" class="cart">
                            ${{$total}} <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span>{{$count}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
