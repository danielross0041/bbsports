<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\product;
use App\Models\product_list;
use App\Models\product_varlist;
use App\Models\country;
use App\Models\order_details;
use App\Models\User;
use App\Models\orders;
use App\Models\colour;
use App\Models\size;
use App\Models\coupon;
use App\Mail\invoicemail;
use App\Mail\MailReview;
use DB;
use Session;
use Auth;
use Mail;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    

    private function generated_form($type = '', $product_id){
        // dd($product_id);
        $slug = $type["type"]; // any colour/size
        $body = '';
        $loop = product_varlist::distinct("type")->select("value")->where("is_active" , 1)->where("is_deleted" , 0)->where("type",$slug)->where("product_id",$product_id)->get();
        // dd($loop);
        $body .= '<select class="custom-select change" name = "'.$slug.'">
                    <option selected="true" disabled="disabled">Select '.$slug.'</option>';
                    foreach ($loop as $key => $value) {
                        $body.='<option value="'.$value["value"].'">'.$value["value"].'</option>';
                    }
        $body .= '</select>';
        return $body;
                                    
    }
    public function pricing(Request $request){
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $product_id = $post_feilds['product_id'];
        $type = $post_feilds['type'];
        try{
            $product_varlist = product_varlist::where("is_active" , 1)->where("is_deleted" , 0)->where("product_id",$product_id)->where("type",$type[0])->get();
            $all_variant = product_varlist::select("type")->where("is_active" , 1)->where("is_deleted" , 0)->where("product_id",$product_id)->groupBy("type")->get()->pluck("type")->toArray();
            DB::enableQueryLog();
            $product_varlist = product_varlist::where("is_active" , 1)->where("is_deleted" , 0)->where("product_id",$product_id)->whereIn("value",$type)->get();

            dd($type,$all_variant,$product_varlist , DB::getQueryLog());

            $status['message'] = $product_varlist;
            $status['status'] = 1;
            return json_encode($status);
            // foreach ($product_varlist as $key => $value) {
            //     $varlist = product_varlist::where("is_active" , 1)->where("is_deleted" , 0)->where("product_id",$product_id)->where("type",$type[1])->where("product_list_id",$value->product_list_id)->first();
            //     if ($varlist) {
            //         $status['message'] = $varlist;
            //         $status['status'] = 1;
            //         return json_encode($status);
            //     }
            // }
            // $body='<p id="price">${{}}</p>';
                    
            $status['message'] = $body;
            
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function save_cart(Request $request) {
        try {
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];
            $stock = $_POST['stock'];
            $product_colour = '';
            $product_size = '';
            if (isset($_POST['product_colour'])) {
                $product_colour = $_POST['product_colour'];
            }
            if (isset($_POST['product_size'])) {
                $product_size = $_POST['product_size'];
            }
            $code = $product_id . "|" . $product_colour . "|" . $product_size;
            $cart = array();
            if (Session::has('cart'))
            {
                $cart = Session::get('cart');
            }
            $cart[$code]['colour'] = '';
            $cart[$code]['size'] = '';
            if ($product_colour != '') {
                $cart[$code]['colour'] = $product_colour;
            }
            if ($product_size != '') {
                $cart[$code]['size'] = $product_size;
            }
            $cart[$code]['stock'] = $stock;
            $cart[$code]['product_id'] = $product_id;
            $cart[$code]['qty'] = $qty;
            $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$product_id)->first();
            Session::put('cart', $cart);
            // dd($cart);
            $msg ='"'. $product->name.'" has been added to cart';
            $status['message'] = $msg;
            $status['status'] = 1;
            return json_encode($status);
        } catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function get_cart(){

        if (Session::has('cart')) {
            $cart = Session::get('cart');
            if ($cart!=[]) {
                $cart_arr = array();
                $cost = 0;
                foreach ($cart as $key => $value) {
                    $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$value['product_id'])->first();
                    $cart_arr[$key]['product_id'] = $product->id;
                    $cart_arr[$key]['image'] = $product->picture;
                    $cart_arr[$key]['name'] = $product->name;
                    $cart_arr[$key]['price'] = $product->tagprice;
                    $cart_arr[$key]['stock'] = $value['stock'];
                    if (isset($value['colour'])) {
                        $cart_arr[$key]['colour'] = $value['colour'];
                    }
                    if (isset($value['size'])) {
                        $cart_arr[$key]['size'] = $value['size'];
                    }
                    $cart_arr[$key]['qty'] = $value['qty'];
                    $cart_arr[$key]['subtotal'] = $product->tagprice * $value['qty'];
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
                return view('shop.cart')->with(compact('cart_arr','cost' , 'discount' , 'total'));
            } else{
                $message = "You donot have anything set in cart";
                return redirect()->route('shop')->withErrors($message);
                // return redirect()->back()->withErrors($message);
            }
        } else{
            $message = "You donot have anything set in cart";
            return redirect()->route('shop')->withErrors($message);
            // return redirect()->back()->withErrors($message);
        }
    }
    public function remove_cart(Request $request){
        $colour = $_POST['colour'];
        $size = $_POST['size'];
        try{
            if (Session::has('cart')) {
                $cart = Session::get('cart');
                Session::forget('cart');
                $cart_arr = $cart;
                $product_id = $_POST['product_id'];
                $colour = $_POST['colour'];
                $size = $_POST['size'];
                $code = $product_id . "|" . $colour . "|" . $size;
                unset($cart[$code]);
                Session::put('cart', $cart);
            }
            $status['message'] = "Record has been removed from cart";
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            dd($code);
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    
    public function forget_cart(){
        if (Session::has('cart')) {    
            Session::forget('cart');
        }
        return redirect()->back();

    }
    public function forget_coupon(){
        if (Session::has('coupon')) {    
            Session::forget('coupon');
        }
        return redirect()->back();

    }
    public function update_cart(Request $request){
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $colour = $_POST['colour'];
        $size = $_POST['size'];
        $stock = $_POST['stock'];
        try{
            if (Session::has('cart')) {
                $cart = array();
                foreach ($product_id as $key => $value) {
                    $code = $product_id[$key] . "|" . $colour[$key] . "|" . $size[$key];
                    $cart[$code]['product_id'] = $product_id[$key];
                    $cart[$code]['qty'] = $qty[$key];
                    $cart[$code]['colour'] = $colour[$key];
                    $cart[$code]['size'] = $size[$key];
                    $cart[$code]['stock'] = $stock[$key];
                }
                Session::forget('cart');
                Session::put('cart', $cart);
                // dd($cart);
            }
            $status['message'] = "Record has been updated";
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }  
    }
    public function checkout(){
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            // dd($cart);
            $cost = 0;
            foreach ($cart as $key => $value) {
                $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$value['product_id'])->first();
                $cost = $cost + ($product->tagprice * $value['qty']);
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
            $country = country::get();
            return view('shop.checkout')->with(compact('cost' , 'discount' , 'total','country'));
        } else{
            $message = "You donot have anything set in cart";
            return redirect()->back()->withErrors($message);
        }
    }
    public function register_customer(Request $request) {
        $token_ignore = ['_token' => '', 'accountusername' => '', 'password' => '', 'ship_check'=>'','ship_othernotes'=>''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        // dd($post_feilds);
        try {
            if (Session::has('cart')) {

                $cart = Session::get('cart');
                $rules = [
                    'email' => 'required|string|email|max:255'
                ];
                $messages = [
                    'email.required' => 'The email is required.',
                    'email.email' => 'The email needs to have a valid format.',
                ];
                $validator = Validator::make($_POST,$rules,$messages);
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
                $custom = User::where('is_active',1)->where('is_deleted',0)->where('email',$_POST['email'])->where('role_id',4)->first();
                if ($custom) {
                    $user = $custom;
                    $password = $user->password;
                    $post_feilds['user_id'] = $user->id;
                    $order_details = order_details::create($post_feilds);
                    $order_details_id = $order_details->id;
                } else{
                    $user = new User;
                    $user->name = $_POST['fname'] . " " . $_POST['lname'];
                    $user->email = $_POST['email'];
                    $password = "12345";
                    $user->password = Hash::make("12345");
                    $user->role_id = 4;
                    $user->save();
                    if ($user) {
                        $post_feilds['user_id'] = $user->id;
                        $order_details = order_details::create($post_feilds);
                        $order_details_id = $order_details->id;
                    }
                }
                if ($order_details) {
                    $order_feilds =[];
                    $cost = 0;
                    foreach ($cart as $key => $value) {
                        $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$value['product_id'])->first();
                        $order_feilds['user_id'] = $user->id;
                        $order_feilds['order_details_id'] = $order_details_id;
                        $order_feilds['product_id'] = $value['product_id'];
                        if ($value['colour'] == '') {
                            $order_feilds['colour'] = null;
                            $order_feilds['size'] = null;
                        } else{
                            $order_feilds['colour'] = $value['colour'];
                            $order_feilds['size'] = $value['size'];
                        }
                        $order_feilds['qty'] = $value['qty'];
                        $order_feilds['cost'] = $product->tagprice * $value['qty'];
                        $cost = $cost + ($product->tagprice * $value['qty']);
                        $orders = orders::create($order_feilds);
                    }
                    if (Session::has('coupon')) {
                        $coupon = Session::get('coupon');
                        if ($coupon['detail'] == 'percentage') {
                            $amount = $coupon['amount'];
                            $discount = ($cost /100)*($amount);
                        } else{
                            $amount = $coupon['amount'];
                            $discount = $amount;
                        }
                        $coupon_feilds['coupon'] = $coupon['id'];
                    } else{
                        $discount = 0;
                    }

                    if (Session::has('coupon')) {
                        $check_coupon = order_details::where('email',$_POST['email'])->where('coupon',$coupon_feilds['coupon'])->first();
                        if ($check_coupon) {
                            $total = $cost;
                            $coupon_feilds['coupon'] = null;
                        } else{
                            $total = $cost - $discount;
                        }
                        $coupon_feilds['total_amount'] = $cost;
                        $coupon_feilds['discount_amount'] = $total;
                        // dd($coupon_feilds);
                    } else{
                        $total = $cost - $discount;
                        $coupon_feilds['total_amount'] = $cost;
                        $coupon_feilds['discount_amount'] = $total;
                        // dd($coupon_feilds,"here");
                    }
                    // $total = $cost - $discount;
                    // $coupon_feilds['total_amount'] = $cost;
                    // $coupon_feilds['discount_amount'] = $total;
                    $create = order_details::where("id" , $order_details_id)->update($coupon_feilds);
                    Session::forget('cart');
                    Session::forget('coupon');
                    $email = $_POST['email'];
                    return redirect()->route('invoice_mail' ,['email'=>$email, 'order_details_id'=>$order_details_id]);
                    // return redirect()->route('welcome');
                } else{
                    return redirect()->back()->withInput();
                }
            } else{
                // return redirect()->route('shop');
                return redirect()->back()->withInput()->withErrors();
            }
        } catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function apply_coupon(Request $request){
        $coupon_number = $_POST['coupon'];
        $today = date("Y-m-d H:i:s");
        $check = coupon::where('is_active',1)->where('is_deleted',0)->where('slug',$coupon_number)->first();
        try{
            if ($check) {
                if (Session::has('coupon')) {
                    $status['message'] = "You have already availed coupon";
                } else{
                    if ($today > $check->start_date && $today < $check->end_date) {
                        if ($check->dis_amount != null) {
                            $coupon['detail'] = 'cost';
                            $coupon['amount'] = $check->dis_amount;
                        } elseif ($check->dis_percentage != null) {
                            $coupon['detail'] = 'percentage';
                            $coupon['amount'] = $check->dis_percentage;
                        }
                        $coupon['id'] = $check->id;
                        Session::put('coupon', $coupon);
                        $status['message'] = "Coupon has been added";
                        $status['status'] = 1;
                        return json_encode($status);
                    } else{
                        $status['message'] = "This Coupon has expired";
                    }
                }
            } else{
                $status['message'] = "No such coupon Exits";
            }
            $status['status'] = 0;
            return json_encode($status);
        } catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        } 
    }
    public function login_customer(Request $request){
        $email = $_POST['email'];
        $password=$_POST['password'];
        $hashed_password = Hash::make($password);
        $user = User::where('is_active',1)->where('is_deleted',0)->where('email',$email)->first();
        try{
            if ($user) {
                $user_password = $user->password;
                $password_check =password_verify($password, $user_password);
                if ($password_check == true) {
                    dd("done");
                    if (Session::has('cart')) {
                        $cart = Session::get('cart');
                        foreach ($cart as $key => $value) {
                            $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$value['product_id'])->first();
                            $order_feilds['user_id'] = $user->id;
                            $order_feilds['order_details_id'] = $order_details->id;
                            $order_feilds['product_id'] = $value['product_id'];
                            $order_feilds['colour'] = $value['colour'];
                            $order_feilds['size'] = $value['size'];
                            $order_feilds['qty'] = $value['qty'];
                            $order_feilds['cost'] = $product->tagprice * $value['qty'];
                            $orders = orders::create($order_feilds);
                        }
                        $attempt = Auth::attempt(['email' => $_POST['email'], 'password' => $_POST['password']]);
                        Session::forget('cart');
                    }
                }
            } else{
                $status['message'] = "No such User Exits";
            }
            $status['status'] = 0;
            return json_encode($status);
        } catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        } 
    }
    public function invoice_mail($email = '',  $order_details_id = ''){
        
        $details = [
            'message' => 'INVOICE MAIL FROM BBSPORTS',
            'order_id' => $order_details_id,
        ];
        $mail = \Mail::to($email)->send(new MailReview($details));
        return redirect()->route('welcome');

    }

}
