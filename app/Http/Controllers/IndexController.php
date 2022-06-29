<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\attributes;
use App\Models\packages;
use App\Models\testimonials;
use App\Models\peaktop;
use App\Models\ourwork;
use App\Models\instructor;
use App\Models\instructors;
use App\Models\instructor_profile;
use App\Models\faqs;
use App\Models\cms;
use App\Models\contact;
use App\Models\team;
use App\Models\new_feeds;
use App\Models\country;
use App\Models\sports;
use App\Models\contact_details;
use App\Models\position;
use App\Models\inquiry;
use App\Models\product;
use App\Models\player;
use App\Models\player_position_stats;
use App\Models\player_all_stats;
use App\Models\blog;
use App\Models\colour;
use App\Models\size;
use App\Models\partners;
use App\Models\videos;
use App\Models\blog_image;
use App\Models\product_colour;
use App\Models\product_size;
use Illuminate\Support\Str;
use App\Mail\mail;
use Session;
use Helper;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function about()
    {
        $title = "About - BB Sports Training";
        $menu = "about";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 1)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 1)->where("sectionID",2)->orderBy('id', 'desc')->first();
        // dd($section1);
        return view('web.about')->with(compact('section1','section2','menu','title'));
        // return view('web.about');
    }
    public function index()
    { 
        $title = "BB Sports Training";
        $menu = "home";
        $testimonials = testimonials::where("is_active" , 1)->get();
        $peaktop = peaktop::where("is_active" , 1)->get();
        $ourwork = ourwork::where("is_active" , 1)->get();
        $partners = partners::where("is_active" , 1)->where('is_deleted',0)->get();
        return view('web.welcome')->with(compact('testimonials','peaktop','ourwork','menu','partners','title'));
        // return view('web.welcome');
    }
    public function teams()
    {
        $title = "Teams - BB Sports Training";
        $menu = "teams";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 8)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 8)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 8)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 8)->where("sectionID",4)->orderBy('id', 'desc')->first();
        // dd($section1);
        return view('web.teams')->with(compact('section1','section2','section3','section4','menu','title'));
    }
    public function instructor()
    {
        $title = "Instructor - BB Sports Training";
        $menu = "about";
        // $instructor = instructor::where("is_active" , 1)->get();
        $instructors = instructors::where("is_active",1)->where("is_deleted",0)->orderBy("id", 'desc')->get();
        $model['user'] = User::find(1);
        $model['instructor_profile'] = instructor_profile::find(17);
        
        return view('web.instructor')->with(compact('instructors', 'menu','model','title'));
        // return view('web.instructor');
    }
    public function contact()
    {
        $menu = "about";
        $title = "Contact - BB Sports Training";
        // $section1 = contact::where("is_active" , 1)->where("section",1)->orderBy('id', 'desc')->first();
        // $section2 = contact::where("is_active" , 1)->where("section",2)->orderBy('id', 'desc')->first();
        $contact = contact::where("is_active" , 1)->get();
        // dd($section2);
        return view('web.contact')->with(compact('contact', 'menu','contact'));
        // return view('web.contact');
    }
    public function highschoolteam()
    {
        $title = "High School Team - BB Sports Training";
        $menu = "teams";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 9)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 9)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 9)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 9)->where("sectionID",4)->orderBy('id', 'desc')->first();
        $baseball = team::where("is_active" , 1)->where("sports_id",1)->where("section_id",1)->get();
        $softball = team::where("is_active" , 1)->where("sports_id",2)->where("section_id",1)->get();
        return view('web.highschoolteam')->with(compact('section1','section2','section3','section4','baseball', 'softball','menu','title'));
    }
    public function youthteam()
    {
        $menu = "teams";
        $title = "Youth Team - BB Sports Training";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 10)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 10)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 10)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 10)->where("sectionID",4)->orderBy('id', 'desc')->first();
        $baseball = team::where("is_active" , 1)->where("sports_id",1)->where("section_id",2)->get();
        $softball = team::where("is_active" , 1)->where("sports_id",2)->where("section_id",2)->get();
        return view('web.youthteam')->with(compact('section1','section2','section3','section4', 'baseball', 'softball' ,'menu','title'));
    }
    public function services()
    {
        $menu = "services";
        $title = "Services - BB Sports Training";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 4)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 4)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 4)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 4)->where("sectionID",4)->orderBy('id', 'desc')->first();
        return view('web.services')->with(compact('section1','section2','section3','section4','menu','title'));
    }
    public function peaktop_program()
    {
        $menu = "services";
        $title = "Peaktop - BB Sports Training";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",4)->orderBy('id', 'desc')->first();
        $section5 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",5)->orderBy('id', 'desc')->first();
        $section6 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",6)->orderBy('id', 'desc')->first();
        $section7 = cms::where("is_active" , 1)->where("pageID" , 5)->where("sectionID",7)->orderBy('id', 'desc')->first();
        // dd($section1);
        return view('web.peaktop_program')->with(compact('section1','section2','section3','section4','section5','section6','section7','menu','title'));
        // return view('web.peaktop_program');
    }
    public function privatelesson()
    {
        $menu = "services";
        $title = "Private Lesson - BB Sports Training";
        $section1 = cms::where("is_active" , 1)->where("pageID" , 6)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 6)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 6)->where("sectionID",3)->orderBy('id', 'desc')->first();
        // dd($section1);
        return view('web.privatelesson')->with(compact('section1','section2','section3','menu','title'));
        // return view('web.privatelesson');
    }
    public function onlinelesson()
    {
        $title = "Online Lesson - BB Sports Training";
        $menu = "services";
        $ourwork = ourwork::where("is_active" , 1)->get();
        $section1 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",1)->orderBy('id', 'desc')->first();
        $section2 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",2)->orderBy('id', 'desc')->first();
        $section3 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",3)->orderBy('id', 'desc')->first();
        $section4 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",4)->orderBy('id', 'desc')->first();
        $section5 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",5)->orderBy('id', 'desc')->first();
        $section6 = cms::where("is_active" , 1)->where("pageID" , 7)->where("sectionID",6)->orderBy('id', 'desc')->first();
        // dd($section1);
        return view('web.onlinelesson')->with(compact('section1','section2','section3','section4','section5','section6','menu','title','ourwork'));
        // return view('web.onlinelesson');
    }
    public function event()
    {
        $menu = "event";
        $title = "Events - BB Sports Training";
        return view('web.event')->with(compact('menu','title'));
    }
    public function tournament()
    {
        $menu = "event";
        $title = "Tournament - BB Sports Training";
        return view('web.tournament')->with(compact('menu','title'));
    }
    
    public function login()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', "You're already logged In");
        }
        $menu = "login";
        return view('web.login')->with(compact('menu'));
    }
    public function register()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', "You're already logged In");
        }
        $menu = "login";
        $country = country::get();
        $sports = sports::get();
        $position = position::get();
        return view('web.register')->with(compact('menu','country','sports','position'));
    }
    
    
    public function pricinghome()
    {
        $menu="home";
        return view('web.pricing')->with(compact('menu'));
    }
    public function instructor_profile($user_id = '')
    {
        $menu = 'about';
        $title = "Instructor - BB Sports Training";
        $instructor_profile = instructor_profile::where("is_active",1)->where("is_deleted",0)->where("user_id",$user_id)->get();
        $n = instructors::where("is_active",1)->where("is_deleted",0)->where("user_id",$user_id)->first();
        $name = $n->name;

        return view('web.instructor_profile')->with(compact('menu','instructor_profile','name','title'));
    }
    public function onlinetraining()
    {
        $menu= "services";
        $title = "Services - BB Sports Training";
        return view('web.online_training')->with(compact('menu','title'));
    }
    public function hittrax()
    {
        $menu = "event";
        return view('web.hittrax')->with(compact('menu'));
    }
    public function recruiting()
    {
        $menu = "recruiting";
        $title = "Player - BB Sports Training";
        $player = player::where("is_active",1)->where("is_deleted",0)->where("is_approved",1)->where("is_recruited",1)->get();
        $model['position'] = position::find(1);
        $model['country'] = country::find(1);
        $model['sports'] = sports::find(1);
        $model['user'] = User::find(1);
        // $country = country::find(1);
        // View::make('view')->withModel($model);
        return view('web.recruiting')->with(compact('menu','player','title'))->withModel($model);
    }
    public function blog()
    {
        $menu = "blog";
        $title = "Blogs - BB Sports Training";
        $blog = blog::where("is_active",1)->where("is_deleted",0)->orderBy('id','desc')->get();
        return view('web.blog')->with(compact('menu','blog','title'));
    }
    public function blog_details($id='')
    {
        // dd($id);
        $menu = "blog";
        $title = "Blog - BB Sports Training";
        $blogs = blog::where("is_active",1)->where("is_deleted",0)->where('id', '!=' , $id)->orderBy('id','desc')->get();
        $mainBlog = blog::where("is_active",1)->where("is_deleted",0)->where('id',$id)->first();
        if ($mainBlog->image != null) {
            $images = blog_image::where('is_active',1)->where('is_deleted',0)->where('blog_id',$id)->get();
        } else{
            $images = null;
        }
        // $user = User::where("is_active",1)->where("is_deleted",0)->where('id',$mainBlog->user_id)->first();
        // $name = $user->name;
        // $date = date("M d,Y" ,strtotime($mainBlog->created_at));
        // $details = [];
        // $details['name'] = $name;
        // $details['date'] = $date;
        // dd($name);
        // dd($details);
        return view('web.blog_detail')->with(compact('menu','blogs','mainBlog','images','title'));
    }
    public function baseball()
    {
        $menu = "recruiting";
        $title = "Baseball Players - BB Sports Training";
        $player = player::where("is_active",1)->where("is_deleted",0)->where("is_approved",1)->where("sports",1)->get();
        $model['position'] = position::find(1);
        $model['country'] = country::find(1);
        $model['sports'] = sports::find(1);
        $model['user'] = User::find(1);
        return view('web.baseball')->with(compact('menu','player','title'))->withModel($model);
    }
    public function player_profile($id='')
    {
        $title = "Player - BB Sports Training";
        $player = player::where("is_active",1)->where("is_deleted",0)->where("is_approved",1)->where("id",$id)->first();
        $videos = videos::where("is_active",1)->where("is_deleted",0)->where("player_id",$id)->get();
        $model['position'] = position::find(1);
        $model['country'] = country::find(1);
        $model['player_position_stats'] = player_position_stats::find(2);
        $model['player_all_stats'] = player_all_stats::find(1);
        // $model['sports'] = sports::find(1);
        $model['user'] = User::find(1);
        // $pps = $model['player_position_stats']::where("player_id",$player->id)->pluck('of_velo')->first();
        // dd($pps);
        return view('web.player_profile')->with(compact('player','videos','title'))->withModel($model);
              }

    public function softball()
    {
        $title = "Softball - BB Sports Training";
        $menu = "recruiting";
        $player = player::where("is_active",1)->where("is_deleted",0)->where("is_approved",1)->where("sports",2)->get();
        $model['position'] = position::find(1);
        $model['country'] = country::find(1);
        $model['sports'] = sports::find(1);
        $model['user'] = User::find(1);
        return view('web.baseball')->with(compact('menu','player','title'))->withModel($model);
    }

    public function team_listing($id = '')
    {
        $menu = "teams";
        $title = "Team - BB Sports Training";
        $player = player::where("is_active",1)->where("is_deleted",0)->where("is_approved",1)->where("team_id",$id)->get();
        $model['position'] = position::find(1);
        $model['country'] = country::find(1);
        $model['sports'] = sports::find(1);
        $model['user'] = User::find(1);
        return view('web.baseball')->with(compact('menu','player','title'))->withModel($model);
    }

    public function contact_details(Request $request){
        $token_ignore = ['_token' => '' , 'position' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try{
            $position = $_POST['position'];
            $position = serialize($position);
            $post_feilds['position'] = $position;
            $create = contact_details::create($post_feilds);
            return redirect()->route('send_mail' , $post_feilds['email']);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
     }

    public function send_mail($email = ''){
        $details = [
            'title' => 'Mail from BBSPORTS',
        ];

        $mail = \Mail::to($email)->send(new mail($details));
        return redirect()->route('welcome');
    }
    public function shop()
    {
        $title = "Shop - BB Sports Training";
        $menu = "shop";
        $product = product::where("is_active" , 1)->where("is_deleted" , 0)->orderBy('id','desc')->get();
        return view('shop.shop')->with(compact('menu','product','title'));

    }
    public function shopall($url = ''){
        // dd($url);
        $title = "Shop - BB Sports Training";
        if ($url == 'shopall') {
            $menu = "shopall";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->orderBy('id','desc')->get();
        } else if($url === 'shirt'){
            // dd("shirt");
            $menu = "shirt";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',1)->orderBy('id','desc')->get();
        } else if($url == 'hat'){
            // dd("hat");
            $menu = "hat";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',4)->orderBy('id','desc')->get();
        } else if($url == 'bag'){
            // dd("bag");
            $menu = "bag";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',5)->orderBy('id','desc')->get();
        } else if($url == 'outerwear'){
            // dd("outerwear");
            $menu = "outerwear";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',6)->orderBy('id','desc')->get();
        }  else if($url == 'onlinelesson'){
            // dd("onlinelesson");
            $menu = "onlinelesson";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',7)->orderBy('id','desc')->get();
        } else{
            // dd("else");
            $menu = "onlinelesson";
            $product = product::where("is_active" , 1)->where("is_deleted" , 0)->where('categoryid',10)->get();

        }
        
        return view('shop.shopall')->with(compact('menu','product','title'));
    }


    
    public function product_details($id='')
    {
        $title = "Product - BB Sports Training";
        $product = product::where("is_active",1)->where("is_deleted",0)->where("id",$id)->first();
        $product_colour = product_colour::where('is_active',1)->where('is_deleted',0)->where('product_id',$id)->get();
        return view('shop.product_details')->with(compact('product','product_colour','title'));
    }
    public function get_sizes(Request $request){
        // dd($_POST);
        $product_colour = product_colour::where('is_active',1)->where('product_id',$_POST['product_id'])->where('colour',$_POST['colour_id'])->first();
        // dd($product_colour);
        $product_size = product_size::where('is_active',1)->where('product_id',$_POST['product_id'])->where('product_colour_id',$product_colour->id)->get();
        // dd($product_size);
        $body = '';
        foreach ($product_size as $key => $value) {
            $size = size::where('is_active',1)->where('id',$value->size)->first();
            $body .='<option value="'.$size->id.'" class="removal">'.$size->name.'</option>';
        }
        $status['product_colour_id'] = $product_colour->id;
        $status['message'] = $body;
        $status['status'] = 1;
        return json_encode($status);
    }

    public function get_stock(Request $request){
        // dd($_POST);
        $product_size = product_size::where('is_active',1)->where('product_id',$_POST['product_id'])->where('product_colour_id',$_POST['product_colour_id'])->where('size',$_POST['size_id'])->first();
        // dd($product_size);
        $status['stock'] = $product_size->stock;
        $status['sku'] = "SKU: ".$product_size->sku;
        $status['status'] = 1;
        return json_encode($status);
    }













    public function register_team(Request $request)
    {
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $sports_id = $post_feilds['sports_id'];
        // dd($sports_id);
        try{
            $body='<div class="col-md-4" id="register_team">
                        <div class="usr-inputt">
                            <label>Team</label>
                            <select name="team_id" class="form-control" id="team_id">
                                <option selected="true" disabled="disabled">Select Team</option>';
                                $team = team::where("is_active",1)->where("sports_id",$sports_id)->get();
                                foreach ($team as $key => $value){
                                    $selected = " ";
                                    if (old('team_id') == $value->id) {
                                        $selected = 'selected="true"';
                                    }
                                    $body.='<option value="'.$value->id.'" '.$selected.'>'.$value->name.'</option>';
                                }
                    $body.='</select>
                        </div>
                </div>';
            $status['message'] = $body;
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }

    // public function newslettersubmit($email ='')
    // {
    //     // Mail::to($request->email)->send(new SendNewsLetter());
    //     $body = "<html>
    //             <body>
    //                 <div style=''>
    //                     <div style='width: 600px;  margin: 50px auto; color: #2A3342; border:7px solid #eee; '>
    //                         <div style='background-color: #2A3342; padding: 20px 0 20px 0;'>
    //                             <h2 style='text-align: center; color: #ffe51c; margin: 0;'>BBSPORTS</h2>
    //                             <div style='width: 20%; height: 1px; background-color: #ffe51c; margin: 10px auto 10px auto;'>
    //                             </div>
    //                         </div>
    //                         <!-- For Newsletter -->
    //                         <br><br>
    //                         <div style='padding: 0 40px 0px 40px;'>
    //                             <h3><span style='color: black;'>Newsletter Subscribtion </span></h3>
    //                             <p> Hello<br>
    //                             You are Successfully registered in Grandeur</p>
    //                         </div>
    //                         <!-- End Newsletter -->
    //                         <div style='padding: 30px 40px 35px 40px;'>
    //                             <p style='color: black; margin: 0;'>
    //                                 Best Regards, <br>
    //                                 <span><strong>grandeur.com</strong></span> <br>
    //                                 <a href='grandeur.com'>grandeur.com</a>
    //                             </p>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </body>
    //             </html>";
    //     $subject='Newsletters Subscription Inquiry';
    //     // Company Email Address
    //     // $com_email = Helper::returnFlag(218);
    //     $com_email = $email;
    //     // dd($com_email);
    //     // Mail::send($com_email,$subject,$body,$headers);

    //     // $mail = new Mail;
    //     // $mail->send($com_email,$subject,$body);
    //     $data = array('name'=>"Virat Gandhi");
    //     Mail::send('web.mail', $data, function($message) {
    //         $message->to('danielross0041@gmail.com', 'Tutorials Point')->subject
    //         ('Laravel HTML Testing Mail');
    //     });
    //     // Mail::send($com_email,$subject,$body);
    //     // Mail::send($com_email,$subject,$body,$headers);
    //     // $mailSent=mail($com_email,$subject,$body,$headers);
    //     // $mailSent=mail('digitonics.developer.454@gmail.com',$subject,$body,$headers);
    //     return redirect()->route('welcome')->with();
    //     // return redirect()->back()->with('notify_error','You have been Successfully Registered For NewsLetter! An email will be send shortly.');
    // }











    // public function index()
    // {
    //     $data['menu'] = 'home';
    //     $title = "Nexa Forex | Forex trading in a new Light";
    //     $packages = packages::where("is_active" , 1)->get();
    //     $new_feeds = new_feeds::where("is_active" , 1)->where("is_deleted" , 0)->first();
        
    //     $output = unserialize($new_feeds->resp_data);
    //     $array = $output['response'];
    //     $new_feed = "";
    //     $blue_img = asset('web/images/m1.png');
    //     $red_img = asset('web/images/m2.png');
    //     //dd($array);
    //     foreach ($array as $key => $value) {
    //         if ($value['ch'] > 0) {
    //             $new_feed .= "<div class='market-slides'>
    //                 <div class='mrkt-log'>
    //                     <img src='".$blue_img."' alt='market' />
    //                     <p class='m1-p'>".$value['s']."<span>".$value['c']."(".$value['cp'].")</span></p>
    //                 </div>
    //             </div>";
    //         }else{
    //             $new_feed .= "<div class='market-slides'>
    //                 <div class='mrkt-log'>
    //                     <img src='".$red_img."' alt='market' />
    //                    <p class='m2-p'>".$value['s']."<span>".$value['c']."(".$value['cp'].")</span></p>
    //                 </div>
    //             </div>";
    //         }
    //     }

    //     return view('web.index')->with(compact('title','data','packages','new_feed'));
    // }

    // public function about_us()
    // {
    //     $data['menu'] = 'about';
    //     return view('web.about')->with(compact('data'));
    // }

    // public function privacy_policy()
    //  {
    //     $data['menu'] = 'privacy-policy';
    //     return view('web.privacy-policy')->with(compact('data'));
    //  }

    // public function contact()
    // {
    //     $data['menu'] = 'contact';
    //     return view('web.contact')->with(compact('data'));
    // }

    // public function contact_submit(Request $request)
    // {
    //     $token_ignore = ['_token' => ''];
    //     $post_feilds = array_diff_key($_POST , $token_ignore);
    //     $inquiry = inquiry::create($post_feilds);
        
    //     return redirect()->route('welcome')->with('message', "Inquiry has been submitted.");
    // }

    

    // public function pricing()
    // {
    //     $data['menu'] = 'pricing';
    //     $packages = packages::where("is_active" , 1)->get();
    //     $faqs = faqs::where("is_active" , 1)->get();
    //     return view('web.pricing')->with(compact('data','packages','faqs'));
    // }

    // public function how_it_work()
    // {
    //     $data['menu'] = 'how_it_work';
    //     return view('web.how-it-works')->with(compact('data'));
    // }

    // public function terms()
    // {
    //     return view('web.terms');
    // }
    // public function policy()
    // {
    //     return view('web.policy');
    // }

    // public function signup_login()
    // {
    //     if (Auth::check()) {
    //         return redirect()->back()->with('error', "You're already logged In");
    //     }
    //     $package = null;
    //     if (isset($_GET) && isset($_GET['package'])) {
    //         $package = packages::where("is_active" , 1)->where("slug" , $_GET['package'])->first();
    //     }

    //     return view('web.signup-login')->with(compact('package'));
    // }

    // public function signup()
    // {
    //     if (Auth::check()) {
    //         return redirect()->route('welcome')->with('error', "You're already logged In");
    //     }
    //     return view('web.signup');
    // }

    
    // public function upload_resume()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->back()->with('error', "Kindly login first to upload your resume");
    //     }
    //     return view('web.upload-resume');
    // }
    

    // public function upload_resume_submit(Request $request)
    // {
    //     if (!empty($_FILES)) {
    //         $file = $request->file('file');
    //         $file_name = $request->file('file')->getClientOriginalName();
    //         $file_name = substr($file_name, 0, strpos($file_name, "."));
    //         $name = $file_name."_".time().'.'.$file->getClientOriginalExtension();
    //         $destinationPath = public_path().'/uploads/resume/';
    //         $share = $request->file('file')->move($destinationPath,$name);
    //         $user = User::find(Auth::user()->id);
    //         $user->resume_doc = $name;
    //         $user->save();
    //         return redirect()->back()->with('message', 'Resume has been uploaded');
    //     }else{
    //         return redirect()->back()->with('error', 'Format not allowed');
    //     }

    // }
    

    

    // public function steps()
    // {
    //     if(Auth::user()->role_id == 1){
    //         $projects = attributes::where('attribute' , 'project')->where('is_active' ,1)->get();
    //         return view('steps')->with(compact('projects'));
    //     }else{
    //         return redirect()->back()->with('error', 'No Page Found');
    //     }
    // }

    
    // public function user_infoupdate(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
        
    //     $user->name = $request->name;
    //     $user->personal_email = $request->personal_email;
    //     $user->phonenumber = $request->phonenumber;
    //     $user->emergency_number = $request->emergency_number;
    //     $user->cnic = $request->cnic;
    //     $user->residential_address = $request->residential_address;
    //     $user->blood_group = $request->blood_group;
    //     $user->dob = $request->dob;
    //     $user->gender = $request->gender;
    //     $user->marital_status = $request->marital_status;
    //     $user->save();
    //     return redirect()->back()->with('message', 'Information updated successfully');
    // }

    


    // public function user_office_infoupdate(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
        
    //     // $user->emp_id = $request->emp_id;
    //     // $user->email = $request->email;
    //     // $user->designation = $request->designation;
    //     // $user->department = $request->department;
    //     // $user->join_date = $request->join_date;
    //     // $user->reporting_line = $request->reporting_line;
    //     $user->bank_account_number = $request->bank_account_number;
    //     $user->v_model_name = $request->v_model_name;
    //     $user->v_model_year = $request->v_model_year;
    //     $user->v_number_plate = $request->v_number_plate;
        
    //     $user->save();
    //     // Session::flash('message', 'This is a message!'); 
    //      Session::flash('alert-class', 'alert-danger'); 
    //     return redirect()->back()->with('message', 'Information updated successfully');
    // }

    // public function profile_submit(Request $request)
    // {
    //     $user = User::find(Auth::user()->id);
    //     // Avatar Upload
    //     if ($request->has('avatar')) {
    //         if ($request->file('avatar') != '') {
    //              $request->validate([
    //              'avatar' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
    //             ]);
    //             $path_a = ($request->file('avatar'))->store('uploads/avatar/'.md5(Str::random(20)), 'public');
    //             $user->profile_pic = $path_a;
    //             $user->save();
    //             return redirect()->back()->with('message', 'Profile Picture been updated successfully');
    //         }
    //         else{
    //              return redirect()->back()->with('error', 'File not found, please update your Profile Picture');
    //         }
    //     }
    //     // Resume Upload
    //     if ($request->has('cnic_file')) {
    //         if ($request->file('cnic_file') != '') {
    //         $request->validate([
    //          'cnic_file' => ['required', 'mimes:jpeg,png,jpg', 'max:2000']
    //         ]);
    //         $path_c = ($request->file('cnic_file'))->store('uploads/cnic/'.md5(Str::random(20)), 'public');
    //         $user->cnic_doc = $path_c;
    //         $user->save();
    //         return redirect()->back()->with('message', 'NIC Picture has been updated successfully');
    //     }
    //         else{
    //              return redirect()->back()->with('error', 'File not found, please update your NIC Picture');
    //         }
    //     }
    //     // // CNIC Upload
    //     if ($request->has('cv_file')) {
    //         if ($request->file('cv_file') != '') {
    //         $request->validate([
    //          'cv_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
    //         ]);
    //         $path_r = ($request->file('cv_file'))->store('uploads/resume/'.md5(Str::random(20)), 'public');
    //         $user->resume_doc = $path_r;
    //         $user->save();
    //         return redirect()->back()->with('message', 'Resume/CV Document has been updated successfully');
    //     }
    //         else{
    //              return redirect()->back()->with('error', 'File not found, please update your Resume/CV Document');
    //         }
    //     }
    //    // // Education Upload
    //     if ($request->has('education_file')) {
    //         if ($request->file('education_file') != '') {
    //         $request->validate([
    //          'education_file' => ['required', 'mimes:doc,docs,pdf', 'max:5000']
    //         ]);
    //         $path_e = ($request->file('education_file'))->store('uploads/education/'.md5(Str::random(20)), 'public');
    //         $user->education_doc = $path_e;
    //         $user->save();
    //         return redirect()->back()->with('message', 'Education Document has been updated successfully');
    //     }
    //         else{
    //              return redirect()->back()->with('error', 'File not found, please update your Education Document');
    //         }
    //     }
    // }

}
