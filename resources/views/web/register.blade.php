@extends('web.layouts.main')
@section('content')
<!-- Slider End -->
<section class="usrregister-sec">
    <div class="container">
        <div class="user-register">
            <form class="needs-validation" novalidate method="POST" action="{{route('registration_submit')}}" >
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>First Name</label>
                                    <input type="text" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Last Name</label>
                                    <input type="text" id="lastname" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" data-column="email" data-type="duplicate" data-table="users" required="required" placeholder="Enter your Email" required/>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="validate @error('password') is-invalid @enderror"  data-column="password" data-table="users" required="required" placeholder="Enter your Password" required/>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="sports_register_team">
                                <div class="usr-inputt" >
                                    <label>Sport</label>
                                    <select name="sports" class="form-control" id="sports" required>
                                        <option selected="true" disabled="disabled">Select Sport</option>
                                        @foreach ($sports as $spt)
                                        {{ $id = $spt->id}}
                                        <option value="{{$spt->id}}" {{ old('sports') == $id ? 'selected' : ' ' }}>{{$spt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="register_team">
                                <div class="usr-inputt">
                                    <label>Team</label>
                                    <select name="team_id" class="form-control" id="team_id">
                                        <option selected="true" disabled="disabled">Select Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Date of Birth</label>
                                    <input type="date" id="dob" name="dob" max="2021-12-31" value="{{ old('dob') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Primary Position</label>
                                    <select name="primary_position" class="form-control" id="primary_position" required>
                                        <option selected="true" disabled="disabled">Primary Position</option>
                                        @foreach ($position as $pst)
                                        {{$id = $pst->id}}
                                        <option value="{{$pst->id}}" {{ old('primary_position') == $id ? 'selected' : ' ' }}>{{$pst->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Secondary Position</label>
                                    <select name="secondary_position" class="form-control" id="secondary_position" required>
                                        <option selected="true" disabled="disabled">Secondary Position</option>
                                        @foreach ($position as $pst)
                                        {{$id = $pst->id}}
                                        <option value="{{$pst->id}}" {{ old('secondary_position') == $id ? 'selected' : ' ' }}>{{$pst->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Tertiary Position</label>
                                    <select name="tertiary_position" class="form-control" id="tertiary_position" required>
                                        <option selected="true" disabled="disabled">Tertiary Position</option>
                                        @foreach ($position as $pst)
                                        {{ $id = $pst->id }}
                                        <option value="{{$pst->id}}" {{ old('tertiary_position') == $id ? 'selected' : ' ' }}>{{$pst->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Height</label>
                                    <input type="text" id="height" name="height" placeholder="Height" value="{{ old('height') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Weight</label>
                                    <input type="text" id="weight" name="weight" placeholder="Weight" value="{{ old('weight') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="usr-inputt">
                                    <label>Grad Year</label>
                                    <input type="text" id="gradyear" name="gradyear" placeholder="Grad Year" value="{{ old('gradyear') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Bats</label>
                                    <select name="bats" class="form-control" id="bats" required>
                                        <option selected="true" disabled="disabled">Select Bats</option>
                                        <option value="L" {{ old('bats') == 'L' ? 'selected' : ' ' }}>Left</option>
                                        <option value="R" {{ old('bats') == 'R' ? 'selected' : ' ' }}>Right</option>
                                        <option value="Switch" {{ old('bats') == 'Switch' ? 'selected' : ' ' }}>Switch</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Throws</label>
                                    <select name="throws" class="form-control" id="throws" required>
                                        <option selected="true" disabled="disabled"> Select Throws</option>
                                        <option value="L" {{ old('throws') == 'L' ? 'selected' : ' ' }}>Left</option>
                                        <option value="R" {{ old('throws') == 'R' ? 'selected' : ' ' }}>Right</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>High School</label>
                                    <input type="text" id="highschool" name="highschool" placeholder="High School" value="{{ old('highschool') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Travel Team</label>
                                    <input type="text" id="travelteam" name="travelteam" placeholder="Travel Team" value="{{ old('travelteam') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="usr-inputt">
                                <label>Address</label>
                                <input type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}" class="validate" required="required" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Country</label>
                                    <select class="form-control" id="country" name="country" placeholder="Country" required>
                                        <option selected="true" disabled="disabled">Select Country</option>
                                        @foreach ($country as $cnt)
                                        {{ $id = $cnt->id }}
                                        <option value="{{$cnt->id}}" {{ old('country') == $id ? 'selected' : ' ' }}>{{$cnt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>City</label>
                                    <input type="text" id="city" name="city" placeholder="City" value="{{ old('city') }}" class="city" required="required" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>State</label>
                                    <input type="text" id="state" name="state" placeholder="State" value="{{ old('state') }}" class="validate" required="required" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="Zip" value="{{ old('zip') }}" class="validate" required="required" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Parent First Name</label>
                                    <input type="text" id="parentfirstname" name="parentfirstname" placeholder="Parent First Name" value="{{ old('parentfirstname') }}" class="validate" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Parent Last Name</label>
                                    <input type="text" id="parentlastname" name="parentlastname" placeholder="Parent Last Name" value="{{ old('parentlastname') }}" class="validate" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Parent Email</label>
                                    <input type="email" id="parentemail" value="{{ old('parentemail') }}" name="parentemail" class="validate validator" data-column="parentemail" data-type="duplicate" data-table="user"  placeholder="Enter your Parent Email" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="usr-inputt">
                                    <label>Parent Phone</label>
                                    <input type="text" id="parentphone" name="parentphone" placeholder="Enter your Parent Phone Number" value="{{ old('parentphone') }}" class="validate" required/>
                                </div>
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
                                    <a href="{{route('login')}}" class="res-btn">Login</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('web.layouts.social')
</section>
<section class="product-pagination">
    @include('web.layouts.products')
</section>
@endsection
