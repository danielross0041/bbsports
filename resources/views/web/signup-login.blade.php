@extends('web.layouts.main') 
@section('content')

        <div class="container">
            <div class="row">
                <div class="input-cart col s12 m10 push-m1 z-depth-2 grey lighten-5">
                    <div class="col s12 m5 login">
                        <h4 class="center">Log in</h4>
                        <br />
                        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf

                            <div class="row">
                                <div class="input-field">
                                    <input id="emailaddress" placeholder="Enter your email" type="email" class="validate @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                    <label for="user">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input id="password" type="password" class="validate @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

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
                            <div class="row">
                                <div class="switch col s6">
                                    <label>
                                        <input type="checkbox" />
                                        <span class="lever"></span>
                                        Remember Me
                                    </label>
                                </div>
                                <div class="col s6">
                                    <button type="submit" name="login" class="btn waves-effect waves-light blue right">Log in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Signup form -->
                    <div class="col s12 m7 signup">
                        <div class="signupForm">
                            <h4 class="center">Sign up</h4>
                            <br />
                            <form class="needs-validation" novalidate method="POST" autocomplete="off" action="{{route('registration_submit')}}" >
                            @csrf
                                <input type="hidden" name="package" value="{{!is_null($package)?$package->id:'0'}}">
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <input type="text" id="name-picked" name="name" placeholder="Full name" value="{{ old('name') }}" class="validate" required="required" />
                                        <label for="name-picked">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input type="email" id="email" name="email" class="validate validator" data-column="email"  data-type="duplicate"  data-table="user" required="required" placeholder="Enter your email" />

                                        <label for="pass-picked">
                                           <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <input type="text" id="username" name="username" data-column="username"  data-type="duplicate"  data-table="user" class="validate validator" required="required" placeholder="Enter your Telegram Username" />
                                        <label for="name-picked">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                    

                                    <div class="input-field col s12 m6">
                                        <input type="password" id="pass-picked" name="password" class="validate" required="required" placeholder="Password" />

                                        <label for="pass-picked">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </label>
                                    </div>

                                </div>

                            <div class="row signup-row">
                                <button type="submit" class="btn blue right waves-effect waves-light">Sign Up</button>
                            </div>
                            </form>
                            
                        </div>
                        <div class="signup-toggle center">
                            <h4 class="center">Have No Account ? <a href="#!">Sign Up</a></h4>
                        </div>
                    </div>
                    
                </div>
            </div>
            {{--
            <div class="fixed-action-btn toolbar">
                <a class="btn-floating btn-large amber black-text">
                    Login
                </a>
                <ul>
                    <li><a class="indigo center" href="#!">Login with FB</a></li>
                    <li><a class="blue center" href="#!">Login with Twitter</a></li>
                    <li><a class="red center" href="#!">Login with Google +</a></li>
                </ul>
            </div>
            --}}
        </div>


@endsection 
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('web/css/materialize.min.css')}}">
@endsection 
@section('js') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $("header").hide()
        $("footer").hide()
    })

    $(".validator").focusout(function(){
        var like = $(this)
    var val = $(this).val();
    var type = 'duplicate';
    var table = $(this).data('table');
    var column = $(this).data('column');
    $.ajax({
        type: 'post',
        dataType : 'json',
        url: "{{route('validator_check')}}",        
        data: {
            val: val,
            type: type,
            table: table,
            column: column,
            "_token": "{{ csrf_token() }}",
            },
        success: function (response) {
            if (response.status == 0) {
                $(like).val("")
                $(like).prop("placeholder" , response.data)
                toastr.error(response.message);
            }else{
                $(like).val(response.data)
            }
            
        }
    });
  });
</script>
@endsection
