@extends('web.layouts.main')
@section('content')
<!-- Slider End -->
<section class="usrregister-sec">
    <div class="container">
        <div class="user-register">
            <form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="usr-inputt">
                            <label>UserName</label>
                            <input type="text" />
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>FirstName</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>LastName</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>Email Address</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>Password</label>
                                <input type="text" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>Confrm Password</label>
                                <input type="text" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="row rh">
                            <div class="col-md-6">
                                <div class="register">
                                    <button class="res-btn">Register</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="Login">
                                    <button class="res-btn">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="sm">
        <div class="container-fluid">
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
                <h5>Like This:</h5>
                <a href="#"><i class="fa fa-star" aria-hidden="true"></i>Like</a>
                <p>Be the first to like this.</p>
            </div>
        </div>
    </div>
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
