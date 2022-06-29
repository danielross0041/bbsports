<div class="container">
    <div class="pricing-title">
      <h4>Our Pricing</h4>
      <p>Get ready to beat the market with exclusive guidance by Nexa Forex Trading. Select the plan that fits your needs.</p>
    </div>
    <div class="row">
      
      @if($packages)
      @foreach($packages as $val)
      <div class="col-md-4">
        <div  class="pricing-blk">
          <h6>{{$val->name}}</h6>
          <h4>${{$val->amount}}</h4>
          <h3>{{$val->period}} Month</h3>
          {!! $val->desc !!}
          <a href="{{route('signup_login')}}?package={{$val->slug}}">join now</a>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>