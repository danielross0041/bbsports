<section class="touch-sec">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
       <div class="touch-form">
          <h4>Get in touch</h4>
        <form class="needs-validation" method="POST" action="{{route('contact_submit')}}" >
          @csrf
          <input type="hidden" name="user_id" value="{{(Auth::user())?Auth::user()->id:'0'}}">
          <div class="row">
            <div class="col-md-12">
              <input type="text" name="name" required="" placeholder="Name">
            </div>
            <div class="col-md-12">
              <input type="email" name="email" required="" placeholder="Email">
            </div>
            <div class="col-md-12">
              <input type="text" required="" placeholder="Phone Number" name="contactnumber">
            </div>
            <div class="col-md-12">
              <textarea required="" placeholder="Message" name="message"></textarea>
            </div>
            <div class="col-md-12">
              <button type="submit">submit</button>
            </div>
          </div>
        </form>
       </div>
      </div>
      <div class="col-md-4">
        <div class="touch-us">
          <h4>Contact Us</h4>
          <h3>Postal Address</h3>
          <P><?=Helper::config("address")?></P>
          <h3>Business Phone</h3>
          <a href="tel:<?=Helper::config("contactnumber")?>">+<?=Helper::config("contactnumber")?> </a>
          <h3>Say Hello</h3>
          <a href="mailto:<?=Helper::config("emailaddress")?>"><?=Helper::config("emailaddress")?></a>
          <ul>
            <li><a href="<?=Helper::config("facebooklink")?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="<?=Helper::config("twitterlink")?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="<?=Helper::config("instagramlink")?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="<?=Helper::config("linkedinlink")?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>