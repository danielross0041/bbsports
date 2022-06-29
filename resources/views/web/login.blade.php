@extends('web.layouts.main')
@section('content')
<section class="usrregister-sec">
    <div class="container">
        <div class="user-register">
            <form method="POST" action="{{route('login')}}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="usr-inputt">
                            <label>E-mail</label>
                            <input id="emailaddress" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <label for="user">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>Password</label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="pass">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <div class="form-group">
                                    <input type="checkbox" id="css" />
                                    <label for="css">Keep Me Signed In</label>
                                </div>
                            </div>
                        </div>
                        <div class="row rh">
                            <div class="col-md-6">
                                <div class="register">
                                    <button class="res-btn">Login</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="Login">
                                    <a href="{{route('register')}}" class="res-btn">Register</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="forget-password">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- <div class="sm">
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
    </div> -->
    @include('web.layouts.social')
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
