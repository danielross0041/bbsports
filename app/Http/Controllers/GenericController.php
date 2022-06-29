<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RequestAttributes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\product;
use App\Models\player;
use App\Models\product_list;
use App\Models\User;
use App\Models\attributes;
use App\Models\role_assign;
use App\Models\sections;
use App\Models\sports;
use App\Models\team;
use App\Models\category;
use App\Models\web_cms;
use App\Models\partners;
use App\Models\product_variation;
use App\Models\instructor_profile;
use App\Models\product_varlist;
use App\Models\instructors;
use App\Models\instructor;
use App\Models\blog;
use App\Models\videos;
use App\Models\colour;
use App\Models\size;
use App\Models\coupon;
use App\Models\order_details;
use App\Models\orders;
use App\Models\blog_image;
use App\Models\country;
use App\Models\product_colour;
use App\Models\product_size;



use Illuminate\Support\Str;
use Session;
use Helper;
class GenericController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $user = Helper::curren_user();
        // $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        // $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        // View()->share('att_tag',$att_tag);
        // View()->share('role_assign',$role_assign);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roles()
    {
        $user = Auth::user();
        if ($user->role_id != 1) {
            return redirect()->back()->with('error', "No Link found");
        }
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active' ,1)->get();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        return view('roles/roles')->with(compact('attributes','att_tag','role_assign'));
    }
    public function generic_submit(RequestAttributes $request)
    {
        // $user = User::find(Auth::user()->id);
        // $columns  = \Schema::getColumnListing("attributes");
        // $ignore = ['id' , 'is_active' ,'is_deleted' , 'created_at' , 'updated_at' ,'deleted_at'];
        //$push_in = array_diff($columns, $ignore);
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try{
            attributes::insert($post_feilds);
            return redirect()->back()->with('message', 'Information updated successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Error will saving record');
        }
    }
    public function role_assign_modal()
      {
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$_POST['role_id'])->orderBy('id','desc')->first();
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $body = "";
        if ($att_tag) {
            $route = route('roleassign_submit');
            $body .= "<input type='hidden' name='role_id' id='fetch-role-id' value='".$_POST['role_id']."'>";
            if ($role_assign && $role_assign->assignee!='N;') {
                $checker = unserialize($role_assign->assignee);
                $body .= "<input type='hidden' name='record_id' value='".$role_assign->id."'>";
            }else{
                $checker = [];
            }
            foreach($att_tag as $key => $role){
                $body .= "<tr><td>".ucwords($role->attribute)."</td><td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck1".$key."' ";
                                   if(in_array($role->attribute."_1", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_1'>
                                  <label class='custom-control-label' for='customCheck1".$key."'>1</label></div></td>
                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck2".$key."' ";
                                   if(in_array($role->attribute."_2", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_2'>
                                  <label class='custom-control-label' for='customCheck2".$key."'>2</label></div></td>
                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck3".$key."' ";
                                   if(in_array($role->attribute."_3", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_3'>
                                  <label class='custom-control-label' for='customCheck3".$key."'>3</label></div></td>
                            <td><div class='custom-control custom-checkbox'>
                                  <input type='checkbox' name='assignee[]' class='custom-control-input' id='customCheck4".$key."' ";
                                   if(in_array($role->attribute."_4", $checker)){ $body .= "checked"; }
                                    $body .= " value='".$role->attribute."_4'>
                                  <label class='custom-control-label' for='customCheck4".$key."'>4</label></div></td></tr>";    
            }
        }
        $bod['body'] = $body;
        $response = json_encode($bod);
        return $response;
    }
    public function roleassign_submit(Request $request)
    {
        if (isset($request->record_id) && $request->record_id != 0) {
            $role_assign = role_assign::where('is_active' ,1)->where("id" ,$request->record_id)->first();
        }else{
            $role_assign = new role_assign;
            $role_assign->role_id = $request->role_id;    
        }
        $role_assign->assignee = serialize($request->assignee);
        $role_assign->save();
        return redirect()->back()->with('message', 'Role has been assigned successfully');
    }
    public function listing($slug='')
    {
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        }else{
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }
        $form = null;
        $table = null;
        $eloquent = '';
        if($slug == "roles"){
            $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
            $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
            $is_hide = 0;
        }else{
            if($slug == "instructor"){
               $slug = "instructor_profile";
            }
            $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
            $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
            $get_eloquent = attributes::where('is_active' ,1)->where('attribute' , $slug)->first();
            $eloquent = ($get_eloquent->model != '')?$get_eloquent->model:'';
            $is_hide = 1;
            if ($eloquent != '') {
                $form = $this->generated_form($slug);
                $table = $this->generated_table($slug);
            }
        }
        return view('roles/crud')->with(compact('attributes','att_tag','role_assign','validator','slug','is_hide','eloquent','form','table'));
    }
    public function variation_product($id='') {
        $slug='product_list';
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        }else{
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }
        $form = null;
        $table = null;
        $eloquent = '';
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
        $get_eloquent = attributes::where('is_active' ,1)->where('attribute' , $slug)->first();
        $eloquent = ($get_eloquent->model != '')?$get_eloquent->model:'';
        $is_hide = 1;
        if ($eloquent != '') {
            $form = $this->product_form($id);
            $table = $this->product_table($id);
        }
        return view('roles/crud')->with(compact('attributes','att_tag','role_assign','validator','slug','is_hide','eloquent','form','table'));
    }
    private function product_form($id = '')
    {
        $c= product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$id)->first();
        $cat=$c->categoryid;
        $body = '';
        if ($id) {
            $route_url = route('variation_generator');
            $body = '<div id="productdiv" class="productdiv">
            <form class="productForm" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="product_id" id="product_id" value="'.$id.'">
                    <input type="hidden" name="product_colour_id" id="product_colour_id" value="">
                    <input type="hidden" name="product_size_id" id="product_size_id" value="">
                    <div class="row" id="row">
                        <div id="assignrole"></div>';
                        $body.= '
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Colour:</label>
                                <div class="d-flex">
                                    <select name="colour" id="colour" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled" >Select Colour</option>';
                                        $colour= colour::where("is_active",1)->where("is_deleted",0)->where('category_id',$cat)->get();
                                        if ($colour) {
                                            foreach($colour as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" name="image" multiple class="form-control profession">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12">
                        <span id="add" class="btn btn-outline-primary">Add</span>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                        <div class="row" id="repeted">
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Size:</label>
                                <div class="d-flex">
                                    <select name="size[]" id="size" class="form-control profession" required="true" required value="">
                                        <option selected="true" disabled="disabled">Select Size</option>';
                                        $size= size::where("is_active",1)->where("is_deleted",0)->where('category_id',$cat)->get();
                                        if ($size) {
                                            foreach($size as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Stock:</label>
                                <div class="d-flex">
                                    <input id="stock" placeholder="Stock" name="stock[]" class="form-control profession" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12 stc" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">SKU:</label>
                                <div class="d-flex">
                                    <input id="sku" placeholder="SKU" name="sku[]" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        </div></div>
                    </div>
                </form>
                </div>';
            return $body;
        } else{
            return $body;
        }
    }
    private function product_table($id='')
    {
        $body = '';
        if ($id) {
            $data = 'App\Models\product_size';
            $product = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$id)->first();
            $product_colour = product_colour::where('is_active',1)->where('is_deleted',0)->where('product_id',$id)->get();
            if ($product) {
            $body = '<h4>'.$product->name.' List</h4>
                                    <thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Colour</th>
                                          <th>Size</th>
                                          <th>Stock</th>
                                          <th>SKU</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($product_colour) {
                                        $count = 0;
                                       foreach($product_colour as $key => $val){
                                            $product_size = product_size::where('is_active',1)->where('product_id',$id)->where('product_colour_id',$val->id)->get();
                                            $i=asset($val->image);
                                            $colour = colour::where('is_active',1)->where('is_deleted',0)->where('id',$val->colour)->first();
                                            foreach($product_size as $k => $value){
                                                $size = size::where('is_active',1)->where('id',$value->size)->first();
                                                $count ++;
                                                $body .= '<tr>
                                                  <td>'.$count.'</td>
                                                  <td>'.$colour->name.'</td>
                                                  <td>'.$size->name.'</td>
                                                  <td>'.$value->stock.'</td>
                                                  <td>'.$value->sku.'</td>
                                                  <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                                  <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                                  <td>
                                                     <button type="button" class="btn btn-primary editor-form" data-product_id= "'.$id.'" data-product_colour_id= "'.$val->id.'" data-product_size_id= "'.$value->id.'" data-colour= "'.$val->colour.'" data-size= "'.$value->size.'" data-stock= "'.$value->stock.'" data-sku= "'.$value->sku.'">Edit</button>
                                                     <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$value->id.'" >Delete</button>
                                                  </td>
                                               </tr>';
                                            }
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Colour</th>
                                          <th>Size</th>
                                          <th>Stock</th>
                                          <th>SKU</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#product_id").val($(this).data("product_id"))
                                                $("#product_colour_id").val($(this).data("product_colour_id"))
                                                $("#product_size_id").val($(this).data("product_size_id"))
                                                $("#colour").val($(this).data("colour"))
                                                $("#size").val($(this).data("size"))
                                                $("#stock").val($(this).data("stock"))
                                                $("#sku").val($(this).data("sku"))
                                                $("#add").hide();
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else{
            return $body;
        }
    }
    private function generated_form($slug = '')
    {
        $body = '';
        if ($slug == 'testimonials') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'colour' ||  $slug == 'size') {
            $route_url = route('pro_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="category_id">Choose a Category:</label>
                                <div class="d-flex">
                                    <select name="category_id" class="form-control" id="category_id" required="true" required>
                                    <option selected="true" disabled="disabled">Select Category</option>';
                                    $category= category::where("is_active",1)->where("is_deleted",0)->get();
                                    if ($category) {
                                        foreach($category as $key => $val){
                                            if ($val->slug!="onlinelesson") {
                                                $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                                    }
                                    $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">'.$slug.':</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="'.$slug.'" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'category') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">'.$slug.':</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="'.$slug.'" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'instructor_profile') {
            $route_url = route('instructor_generator', 'instructor_profile');
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6 im" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Images:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" name="image[]" required="true" required multiple class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'product') {
            $route_url = route('product_generator', $slug);
            $category= category::where("is_active",1)->where("is_deleted",0)->get();
            // $fabric= product_variation::where("is_active",1)->where("is_deleted",0)->where("type", "fabric")->get();
            $body = '<div id="productdiv" class="productdiv">
            <form class="productForm" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row" id="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="category_id">Choose a Category:</label>
                                <div class="d-flex">
                                    <select name="categoryid" required="true" required class="form-control" id="categoryid">
                                    <option selected="true" disabled="disabled">Select Category</option>';
                                    if ($category) {
                                        foreach($category as $key => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                        }
                                    }
                                    $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Product Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Product Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Price:</label>
                                <div class="d-flex">
                                    <input id="tagprice" placeholder="Price" name="tagprice" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="const_picture" placeholder="Image" name="const_picture" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">SKU:</label>
                                <div class="d-flex">
                                    <input id="sku" placeholder="SKU" name="sku" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control"  required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                        ';
                        // <div class="col-md-12 col-sm-6 col-12" id="insertafter"></div>
                        // <div class="col-md-12 col-sm-6 col-12 profession" id="rank-label" >
                        //     <div class="form-group start-date">
                        //         <label for="start-date" class="">Colour:</label>
                        //         <div class="no-flex profession" >';
                        //           $body.='</div>
                        //     </div>
                        // </div>
                        
                        // <div class="col-md-12 col-sm-6 col-12">
                        // <span id="add" class="btn btn-outline-primary">Add</span>
                        // </div>';
                        // $body.='
                        // <div class="col-md-12 col-sm-6 col-12" id="role-label">
                        // <div class="row" id="var">
                        // <div class="col-md-12 col-sm-6 col-12" id="role-label">
                        // <div class="row" id="repeted">
                        // <div class="col-md-2 col-sm-6 col-2 prc" id="rank-label">
                        //     <div class="form-group start-date">
                        //         <label for="start-date" class="">Price:</label>
                        //         <div class="d-flex">
                        //             <input id="price" placeholder="Price" name="price[]" class="form-control" type="text" autocomplete="off" required="true" required/>
                        //         </div>
                        //     </div>
                        // </div>
                        // <div class="col-md-2 col-sm-6 col-2 stc" id="rank-label">
                        //     <div class="form-group start-date">
                        //         <label for="start-date" class="">Stock:</label>
                        //         <div class="d-flex">
                        //             <input id="stock" placeholder="Stock" name="stock[]" class="form-control" type="text" autocomplete="off" required="true" required/>
                        //         </div>
                        //     </div>
                        // </div>
                        // <div class="col-md-4 col-sm-6 col-4 sk" id="rank-label">
                        //     <div class="form-group start-date">
                        //         <label for="start-date" class="">SKU:</label>
                        //         <div class="d-flex">
                        //             <input id="sku" placeholder="SKU" name="sku[]" class="form-control" type="text" autocomplete="off" required="true" required/>
                        //         </div>
                        //     </div>
                        // </div>
                        // <div class="col-md-4 col-sm-6 col-4 im" id="rank-label">
                        //     <div class="form-group start-date">
                        //         <label for="start-date" class="">Image:</label>
                        //         <div class="d-flex">
                        //             <input type="file" id="image" placeholder="Image" name="image[]" class="form-control" required="true" required>
                        //         </div>
                        //     </div>
                        // </div>
                        // </div>
                        // </div>
                        // </div>
                        // </div>
                    $body .= '</div>
                </form>
                </div>';
            return $body;
        } else if ($slug == 'team') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>';
                    $body.='<div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Select Section:</label>
                                <div class="d-flex">
                                    <select name="section_id" id="section_id" class="form-control type" required="true" required value="">
                                        <option selected="true" disabled="disabled">Select Section</option>';
                                        $sections= sections::where("is_active" ,1)->where("is_deleted" ,0)->get();
                                        if ($sections) {
                                            foreach($sections as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Select Sport:</label>
                                <div class="d-flex">
                                    <select name="sports_id" id="sports_id" class="form-control type" required="true" required value="">
                                        <option selected="true" disabled="disabled">Select Sport</option>';
                                        $sports= sports::where("is_active" ,1)->where("is_deleted" ,0)->get();
                                        if ($sports) {
                                            foreach($sports as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'peaktop') {
            $image_route_url = route('image_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Image" name="image" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'partners') {
            $image_route_url = route('image_crud_generator', $slug);
            $body = '<form class=""  id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Image" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'instructor') {
            $image_route_url = route('image_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Image" name="image" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'instructors') {
            $image_route_url = route('instructor_registration');
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="name" class="">Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="desc" class="">Description:</label>
                                <div class="d-flex">
                                    <input id="desc" placeholder="Description" name="desc" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="profile_pic" class="">Image:</label>
                                <div class="d-flex">
                                    <input type="file" id="profile_pic" placeholder="Image" name="profile_pic" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12 hideinstructor">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="email" class="">Email:</label>
                                    <div class="d-flex">
                                        <input id="email" placeholder="Email" name="email" class="form-control" type="email" autocomplete="off" required="true" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="password" class="">Password:</label>
                                    <div class="d-flex">
                                        <input id="password" placeholder="Password" name="password" class="form-control" type="password" autocomplete="off" required="true" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'ourwork') {
            $image_route_url = route('image_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Link:</label>
                                <div class="d-flex">
                                    <input id="link" placeholder="Link" name="link" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Thumbnail:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Thumbnail" name="image" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'coupon') {
            $image_route_url = route('coupon_generator');
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Coupan Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Coupan Name" name="name" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Start Date:</label>
                                <div class="d-flex">
                                    <input type="datetime-local" id="start_date" placeholder="Start Date" name="start_date" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">End Date:</label>
                                <div class="d-flex">
                                    <input type="datetime-local" id="end_date" placeholder="End Date" name="end_date" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                        <ul class="col-md-12 nav nav-tabs ">
                            <li><a data-toggle="tab" href="#discount_amount" class="btn btn-outline-primary active">Discount Amount</a></li>
                            <li><a class="btn btn-outline-primary" data-toggle="tab" href="#discount_per">Discount Percentage</a></li>
                        </ul>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="tab-content">
                                <div id="discount_amount" class="tab-pane fade in active">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Discount Amount:</label>
                                            <div class="d-flex">
                                                <input id="dis_amount" placeholder="Discount Amount" name="dis_amount" class="form-control" type="text" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div id="discount_per" class="tab-pane fade">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Discount Percentage:</label>
                                            <div class="d-flex">
                                                <input id="dis_percentage" placeholder="Discount Percentage" name="dis_percentage" class="form-control" type="text" autocomplete="off"/>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'videos') {
            $image_route_url = route('image_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Select Player:</label>
                                <div class="d-flex">
                                    <select name="player_id" id="player_id" class="form-control type" value="" required="true" required>
                                        <option selected="true" disabled="disabled">Select Player</option>';
                                        $player= player::where("is_active" ,1)->where("is_deleted" ,0)->get();
                                        if ($player) {
                                            foreach($player as $k => $val){
                                            $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                            }
                                        }
                            $body.='</select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Thumbnail:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Thumbnail" name="image" class="form-control"  required="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Link:</label>
                                <div class="d-flex">
                                    <input id="link" placeholder="Link" name="link" class="form-control" type="text" autocomplete="off"  required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'playerVideo') {
            $image_route_url = route('image_crud_generator', 'videos');
            $player = player::where('user_id',Auth::user()->id)->first();
            $loop = videos::where("is_active" ,1)->where("is_deleted" ,0)->where('player_id',$player->id)->get();
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$image_route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <input type="hidden" name="player_id" id="player_id" value="'.$player->id.'">
                    <div class="row">
                        <div id="assignrole"></div>

                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Thumbnail:</label>
                                <div class="d-flex">
                                    <input type="file" id="image" placeholder="Thumbnail" name="image" class="form-control" required="true" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Link:</label>
                                <div class="d-flex">
                                    <input id="link" placeholder="Link" name="link" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'contact') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Title:</label>
                                <div class="d-flex">
                                    <input id="title" placeholder="Title" name="title" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Address:</label>
                                <div class="d-flex">
                                    <input id="address" placeholder="Address" name="address" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Contact:</label>
                                <div class="d-flex">
                                    <input id="contact" placeholder="Contact" name="contact" class="form-control" type="text" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Email:</label>
                                <div class="d-flex">
                                    <input id="email" placeholder="Email" name="email" class="form-control" type="text" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Map Link:</label>
                                <div class="d-flex">
                                    <input id="map" placeholder="Map" name="map" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'blog') {
            $route_url = route('blog_generator');
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="user_id" id="user_id" value="'.Auth::user()->id.'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Title:</label>
                                <div class="d-flex">
                                    <input id="title" placeholder="Title" name="title" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Blog:</label>
                                <div class="d-flex">
                                    <textarea name="desc" id="description" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                        <ul class="col-md-12 nav nav-tabs ">
                            <li><a data-toggle="tab" href="#blog_image" class="btn btn-outline-primary active">Blog Images</a></li>
                            <li><a class="btn btn-outline-primary" data-toggle="tab" href="#blog_video">Blog Video</a></li>
                        </ul>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="tab-content">
                                <div id="blog_image" class="tab-pane fade in active">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Blog Images:</label>
                                            <div class="d-flex">
                                                <input type="file" id="blog_image" name="blog_image[]" multiple class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div id="blog_video" class="tab-pane fade">
                                    <div class="row">
                                    <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Thumbnail:</label>
                                            <div class="d-flex">
                                                <input type="file" id="thumbnail" placeholder="Thumbnail" name="thumbnail" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                                        <div class="form-group start-date">
                                            <label for="start-date" class="">Link:</label>
                                            <div class="d-flex">
                                                <input id="link" placeholder="Link" name="link" class="form-control" type="text" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'packages') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Package Name:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Package Name" onload="convertToSlug(this.value)" 
  onkeyup="convertToSlug(this.value)" name="name" class="form-control" type="text" autocomplete="off" required="true" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Package Slug:</label>
                                <div class="d-flex">
                                    <input id="slug" placeholder="Package slug" name="slug" class="form-control" type="text" autocomplete="off" required="true" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Package Amount:</label>
                                <div class="d-flex">
                                    <input id="amount" placeholder="Package Amount" name="amount" class="form-control" type="text" autocomplete="off" required="true" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Package Period (In Month):</label>
                                <div class="d-flex">
                                    <input id="period" placeholder="Package Period" name="period" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea name="desc" id="description" class="keyouttext form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'faqs') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Question:</label>
                                <div class="d-flex">
                                    <input id="name" placeholder="Question" name="name" class="form-control" type="text" autocomplete="off" required="true" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Description:</label>
                                <div class="d-flex">
                                    <textarea id="description" name="desc" class="form-control" required="true" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'cms') {
            $route_url = route('crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <div class="row">
                        <div id="assignrole"></div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Page ID:</label>
                                <div class="d-flex">
                                    <input id="pageID" placeholder="Page ID" name="pageID" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Section ID:</label>
                                <div class="d-flex">
                                    <input id="sectionID" placeholder="Section ID" name="sectionID" class="form-control" type="text" autocomplete="off" required="true" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="form-group end-date">
                                <label for="end-date" class="">Content:</label>
                                <div class="d-flex">
                                    <textarea id="description"  name="content" class="form-control" required="true" required here_done></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else{
            return $body;
        }
    }
    private function generated_table($slug='')
    {
        $body = '';
        if ($slug == "testimonials") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td> 
                                          <td>'.$val->desc.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc= "'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "instructor_profile") {
            $data = 'App\Models\instructor_profile';
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("user_id", Auth::user()->id)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Description</th>
                                          <th>Images</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $images = unserialize($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td>
                                          <td>'.$val->desc.'</td><td>';
                                          if ($images) {
                                          foreach ($images as $k => $img) {
                                              $i=asset($img);
                                              $body.= '<img style="width:80px;height:80px;" src="'.$i.'">';
                                          }
                                          }
                                          $body .= '</td><td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-user_id= "'.$val->user_id.'" data-desc= "'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Description</th>
                                          <th>Images</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#user_id").val($(this).data("user_id"))
                                                $("#desc").val($(this).data("desc"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "blog") {
            $data = 'App\Models\blog';
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Images</th>
                                          <th>Thumbnail</th>
                                          <th>Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       foreach($loop as $key => $val){
                                        
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->title.'</td>
                                          <td>'.$val->desc.'</td>';
                                          if ($val->image == null) {
                                            $i=asset($val->thumbnail);
                                            $body .= '<td>-</td>
                                            <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                            <td>'.$val->link.'</td>';
                                          } else{
                                            $images = blog_image::where('is_active',1)->where('is_deleted',0)->where('blog_id',$val->id)->get();
                                            $body .= '<td>';
                                            foreach ($images as $i => $v) {
                                                $i = asset($v->image);
                                                $body .= '<img style="width:80px;height:80px;" src="'.$i.'">';
                                            }
                                            
                                            $body .= '</td>
                                            <td>-</td>
                                            <td>-</td>';
                                          }
                                          $body.='<td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-title= "'.$val->title.'" data-desc="'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Iamges</th>
                                          <th>Thumbnail</th>
                                          <th>Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#title").val($(this).data("title"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "team") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Section</th>
                                          <th>Sport</th>
                                          <th>Name</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $sections = sections::where("is_active",1)->where("id",$val->section_id)->first();
                                        $sports = sports::where("is_active",1)->where("id",$val->sports_id)->first();
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$sections->name.'</td> 
                                          <td>'.$sports->name.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-sports_id= "'.$val->sports_id.'" data-section_id= "'.$val->section_id.'" data-name= "'.$val->name.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Section</th>
                                          <th>Sport</th>
                                          <th>Name</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#section_id").val($(this).data("section_id")).change();
                                                $("#sports_id").val($(this).data("sports_id")).change();
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "player") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Email</th>
                                          <th>Approve</th>
                                          <th>Recruited</th>
                                          <th>Team</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $email = User::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$val->user_id)->first();
                                        $checked = " ";
                                        if ($val->is_approved == 1) {
                                            $checked = "checked";
                                        }
                                        $recruited = " ";
                                        if ($val->is_recruited == 1) {
                                            $recruited = "checked";
                                        }
                                        $position_url=route('player_details',['player_position_stats',$val->id]);
                                        $pitcher_url=route('player_details',['player_pitcher_stats',$val->id]);
                                        $playerstats_url=route('player_details',['player_all_stats',$val->id]);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->firstname.'</td> 
                                          <td>'.$val->lastname.'</td> 
                                          <td>'.$email->email.'</td>
                                          <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-player_id ="'.$val->id.'" class="approval"  '.$checked.'>
                                                    <span class="slider"></span>
                                                </label>
                                          </td>
                                          <td>
                                                <label class="switch">
                                                    <input type="checkbox" data-player_id ="'.$val->id.'" class="rec_approval"  '.$recruited.'>
                                                    <span class="slider"></span>
                                                </label>
                                          </td>
                                          <td>
                                            <select name="team_id" data-player_id ="'.$val->id.'" class="team_set" value="">
                                                <option selected="true" value="0" >Select Team</option>';
                                                $team= team::where("is_active" ,1)->where("is_deleted" ,0)->where("sports_id",$val->sports)->get();
                                                if ($team) {
                                                    foreach($team as $k => $i){
                                                        $selected = " ";
                                                        if ($val->team_id == $i->id) {
                                                            $selected = 'selected="true"';
                                                        }
                                                    $body.='<option value="'.$i->id.'" '.$selected.'>'.$i->name.'</option>';
                                                    }
                                                }
                                            $body.='</select>
                                          </td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <a class="btn btn-primary" href="'.$position_url.'">Position Player Stats</a>
                                             <a class="btn btn-primary" href="'.$pitcher_url.'">Pitcher Stats</a>
                                             <a class="btn btn-primary" href="'.$playerstats_url.'">All Player Stats</a>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Email</th>
                                          <th>Approve</th>
                                          <th>Recruited</th>
                                          <th>Team</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "category") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "coupon") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Coupon</th>
                                          <th>Discount Amount</th>
                                          <th>Discount Percentage</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.$val->slug.'</td>';
                                          if ($val->dis_amount == null) {
                                            $body .= '<td>-</td>';
                                            $data_amount = '';
                                          } else{
                                            $body .= '<td>'.$val->dis_amount.'</td>';
                                            $data_amount = 'data-dis_amount = "'.$val->dis_amount;

                                          }
                                          if ($val->dis_percentage == null) {
                                            $body .= '<td>-</td>';
                                            $data_percentage = '';
                                          } else{
                                            $body .= '<td>'.$val->dis_percentage.'</td>';
                                            $data_percentage = 'data-dis_percentage = "'.$val->dis_percentage;
                                          }
                                          $body .= '<td>'.date("d-M-Y H:i:s" ,strtotime($val->start_date)).'</td>
                                          <td>'.date("d-M-Y H:i:s" ,strtotime($val->end_date)).'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>

                                          <td>
                                             
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Coupon</th>
                                          <th>Discount Amount</th>
                                          <th>Discount Percentage</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "instructors") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $image = User::where('is_active',1)->where('id',$val->user_id)->first();
                                        $i=asset($image->profile_pic);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.$val->desc.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc="'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#desc").val($(this).data("desc"))
                                                $(".hideinstructor").hide()
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "colour" || $slug=="size") {
            // dd("here");
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>'.$slug.'</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $category= category::where("is_active" ,1)->where("is_deleted" ,0)->where('id',$val->category_id)->first();
                                           $body .= '<tr>
                                              <td>'.++$key.'</td> 
                                              <td>'.$category->name.'</td>
                                              <td>'.$val->name.'</td>
                                              <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                              <td>
                                              <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-category_id= "'.$val->category_id.'" data-name= "'.$val->name.'" >Edit</button>
                                              <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                              </td>
                                           </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Category</th>
                                          <th>'.$slug.'</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#category_id").val($(this).data("category_id"))
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;  
        } else if ($slug == "peaktop") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Description</th>
                                          <th>Iamge</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->desc.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->image.'" data-desc= "'.$val->desc.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                    }       
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "partners") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Iamge</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                    }       
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "instructor") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td>
                                          <td>'.$val->desc.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc= "'.$val->desc.'" data-image="'.$val->image.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "ourwork") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Link</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->link.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-link= "'.$val->link.'" data-image= "'.$val->image.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>LinkS</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#link").val($(this).data("link"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "videos") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Player</th>
                                          <th>Link</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $player = player::where("is_active" ,1)->where("is_deleted" ,0)->where('id',$val->player_id)->first();
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$player->name.'</td>
                                          <td>'.$val->link.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-link= "'.$val->link.'" data-image= "'.$val->image.'" data-player_id= "'.$val->player_id.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Player</th>
                                          <th>Link</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#player_id").val($(this).data("player_id"))
                                                $("#link").val($(this).data("link"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "customerDetails") {
            $data = 'App\Models\order_details';
            $user_id = Auth::user()->id;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->where('user_id',$user_id)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Company Name</th>
                                          <th>Address</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Coupon</th>
                                          <th>Total Amount</th>
                                          <th>Discount Amount</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $coupon = coupon::where('is_active',1)->where('is_deleted',0)->where('id',$val->coupon)->first();
                                        if ($coupon == null) {
                                            $cop = "-";
                                        } else{
                                            $cop = $coupon->name;
                                        }
                                        $order_details = route('order_details', $val->id);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->fname.' '.$val->lname.'</td>
                                          <td>'.$val->companyname.'</td>
                                          <td>'.$val->address.'</td>
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->phone.'</td>
                                          <td>'.$cop.'</td>
                                          <td>'.$val->total_amount.'</td>
                                          <td>'.$val->discount_amount.'</td>
                                          <td><a class="btn btn-warning" href="'.$order_details.'" target="_blank" style="font-weight:bold;">View Order Details</a></td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Company Name</th>
                                          <th>Address</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Coupon</th>
                                          <th>Total Amount</th>
                                          <th>Discount Amount</th>
                                          <th></th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "playerVideo") {
            $data = 'App\Models\\'.$slug;
            $player = player::where('user_id',Auth::user()->id)->first();
            $loop = videos::where("is_active" ,1)->where("is_deleted" ,0)->where('player_id',$player->id)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Link</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $i=asset($val->image);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->link.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-link= "'.$val->link.'" data-image= "'.$val->image.'" data-player_id= "'.$val->player_id.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Player</th>
                                          <th>Link</th>
                                          <th>Thumbnail</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#player_id").val($(this).data("player_id"))
                                                $("#link").val($(this).data("link"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "contact") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Section</th>
                                          <th>Title</th>
                                          <th>Address</th>
                                          <th>Contact</th>
                                          <th>Email</th>
                                          <th>Map Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->section.'</td>
                                          <td>'.$val->title.'</td>
                                          <td>'.$val->address.'</td>
                                          <td>'.$val->contact.'</td>
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->map.'</td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-section= "'.$val->section.'" data-title= "'.$val->title.'" data-address="'.$val->address.'" data-contact="'.$val->contact.'" data-email="'.$val->email.'" data-map="'.$val->map.'">Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Section</th>
                                          <th>Title</th>
                                          <th>Address</th>
                                          <th>Contact</th>
                                          <th>Email</th>
                                          <th>Map Link</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#section").val($(this).data("section"))
                                                $("#title").val($(this).data("title"))
                                                $("#address").val($(this).data("address"))
                                                $("#contact").val($(this).data("contact"))
                                                $("#email").val($(this).data("email"))
                                                $("#map").val($(this).data("map"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "packages") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Period (Month)</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td> 
                                          <td>'.$val->amount.'</td> 
                                          <td>'.$val->period.'</td> 
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-amount= "'.$val->amount.'" data-period= "'.$val->period.'" data-desc= "'.$val->desc.'" data-slug= "'.$val->slug.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Name</th>
                                          <th>Amount</th>
                                          <th>Period (Month)</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#slug").val($(this).data("slug"))
                                                $("#amount").val($(this).data("amount"))
                                                $("#period").val($(this).data("period"))
                                                $("#description").val($(this).data("desc"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "product") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();

            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Product</th>
                                          <th>Category</th>
                                          <th>Description</th>
                                          <th>Price</th>
                                          <th>SKU</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                        $cat = category::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$val->categoryid)->first();
                                        $url=route('variation_product',$val->id);
                                        $i=asset($val->picture);
                                       $body .= '<tr>
                                          <td>'.++$key.'</td>
                                          <td>'.$val->name.'</td>
                                          <td>'.$cat->name.'</td>
                                          <td>'.$val->desc.'</td>
                                          <td>$'.$val->tagprice.'</td>
                                          <td>'.$val->sku.'</td>
                                          <td><img style="width:80px;height:80px;" src="'.$i.'"></td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>';
                                          if ($cat->id ==1 || $cat->id ==5) {
                                              $body .= '<a type="button" class="btn btn-primary" href="'.$url.'">View Variations</a>';
                                          }
                                          $body .= ' 
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-sku= "'.$val->sku.'" data-desc= "'.$val->desc.'" data-categoryid= "'.$cat->id.'" data-tagprice= "'.$val->tagprice.'"  >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Product</th>
                                          <th>Category</th>
                                          <th>Description</th>
                                          <th>Price</th>
                                          <th>SKU</th>
                                          <th>Image</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#sku").val($(this).data("sku"))
                                                $("#categoryid").val($(this).data("categoryid")).change();
                                                $("#tagprice").val($(this).data("tagprice"))
                                                $("#description").val($(this).data("desc"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        }elseif ($slug == "orders") {
            $data = 'App\Models\order_details';
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Country</th>
                                          <th>Address</th>
                                          <th>City</th>
                                          <th>State</th>
                                          <th>Coupon Used</th>
                                          <th>Total Amount</th>
                                          <th>Discount Amount</th>
                                          <th>Creation Date</th>
                                          <th></th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                             if($loop) {
                             foreach($loop as $key => $val){
                                $order_details = route('order_details', $val->id);
                                $country = country::where('id',$val->country)->first();
                                if ($val->coupon == null) {
                                    $cop = "-";
                                } else{
                                    $coupon = coupon::where('is_active',1)->where('is_deleted',0)->where('id',$val->coupon)->first();
                                    $cop = $coupon->name;
                                }
                                 $body .= '<tr>
                                          <td>'.++$key.'</td>
                                          <td>'.$val->fname.'</td>
                                          <td>'.$val->lname.'</td>
                                          <td>'.$val->email.'</td>
                                          <td>'.$val->phone.'</td>
                                          <td>'.$country->name.'</td>
                                          <td>'.$val->address.'</td>
                                          <td>'.$val->city.'</td>
                                          <td>'.$val->state.'</td>
                                          <td>'.$cop.'</td>
                                          <td>'.$val->total_amount.'</td>
                                          <td>'.$val->discount_amount.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td><a class="btn btn-warning" href="'.$order_details.'" target="_blank" style="font-weight:bold;">View Order Details</a></td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Email</th>
                                          <th>Phone</th>
                                          <th>Country</th>
                                          <th>Address</th>
                                          <th>City</th>
                                          <th>State</th>
                                          <th>Coupon Used</th>
                                          <th>Total Amount</th>
                                          <th>Discount Amount</th>
                                          <th>Creation Date</th>
                                          <th></th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "faqs") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Question</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->name.'</td> 
                                          <td>'.$val->desc.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                            <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-name= "'.$val->name.'" data-desc= "'.$val->desc.'" >Edit</button>
                                            <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Question</th>
                                          <th>Description</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#name").val($(this).data("name"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("desc");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } elseif ($slug == "cms") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->get();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Page ID</th>
                                          <th>Section ID</th>
                                          <th>Content</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       foreach($loop as $key => $val){
                                       $body .= '<tr>
                                          <td>'.++$key.'</td> 
                                          <td>'.$val->pageID.'</td> 
                                          <td>'.$val->sectionID.'</td>
                                          <td>'.$val->content.'</td>
                                          <td>'.date("M d,Y" ,strtotime($val->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$val->id.'" data-pageid= "'.$val->pageID.'" data-sectionid="'.$val->sectionID.'" data-content= "'.$val->content.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$val->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>S. No</th>
                                          <th>Page ID</th>
                                          <th>Section ID</th>
                                          <th>Content</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#pageID").val($(this).data("pageid"))
                                                $("#sectionID").val($(this).data("sectionid"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                var texta = $(this).data("content");
                                                CKEDITOR.instances.description.setData(texta);
                                                $("#addevent").modal("show")
                                            })';
                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else{
            return $body;
        }
    }
    public function report_user($slug)
    {
        $user = Auth::user();
        $role_assign = role_assign::where('is_active' ,1)->where("role_id" ,$user->role_id)->first();
        if ($role_assign) {
            $validator = Helper::check_rights($slug);
            if (is_null($validator)) {
                return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
            }
        }else{
            return redirect()->back()->with('error', "Don't have sufficient rights to access this page");
        }
        $att_tag = attributes::where('is_active' ,1)->select('attribute')->distinct()->get();
        $attributes = attributes::where('is_active' ,1)->where('attribute' , $slug)->get();
        return view('reports/report_generic_user')->with(compact('attributes','att_tag','role_assign','validator','slug'));
    }
    public function custom_report()
    {
        $status['status'] = 0;
        if (isset($_POST['role_id'])) {
            $attributes = attributes::find($_POST['role_id']);
            if ($attributes->attribute == "departments") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->name)]);
                return json_encode($status);
            }elseif ($attributes->attribute == "designations") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->name)]);
                return json_encode($status);
            }elseif ($attributes->attribute == "roles") {
                $status['status'] = 1;
                $status['redirect'] = route('custom_report_user' ,[$attributes->attribute , str::slug($attributes->role)]);
                return json_encode($status);
            }else{
                $status['status'] = 0;
                return json_encode($status);
            }
        }else{
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function custom_report_user($slug='',$slug2='')
    {
        $attributes = attributes::where("attribute" , $slug)->first();
        $designation = attributes::where("is_active" , 1)->get();
        $project_id = Session::get("project_id");
        if ($attributes) {
            if ($attributes->attribute == "departments") {
                $all_user = User::where("is_active" , 1)->where("department" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }elseif ($attributes->attribute == "designations") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2));
                $attributes = attributes::where("attribute" , $slug)->where("name" , "LIKE" , $slug2)->first();
                $all_user = User::where("is_active" , 1)->where("designation" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }elseif ($attributes->attribute == "roles") {
                $slug2 = ucwords(str_replace('-', ' ', $slug2)); 
                $attributes = attributes::where("attribute" , $slug)->where("role" , "LIKE" , $slug2)->first();
                if (!$attributes) {
                    return redirect()->back()->with('error', "Didn't find any records.!");
                }
                $all_user = User::where("is_active" , 1)->where("role_id" , $attributes->id)->get();
                return view('reports/custom-user-report')->with(compact('attributes','all_user','slug','designation'));
            }else{
                return redirect()->back()->with('error', "Didn't find any records.!");
            }
        }else{
            return redirect()->back()->with('error', "Didn't find any records..");
        }
    }
    public function crud_generator($slug='' , Request $request)
    {
        $token_ignore = ['_token' => '' , 'record_id' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\\'.$slug;
        // dd($post_feilds);
        if ($slug == 'product') {
            $s = $_POST['name'];
            $s = str_replace(' ', '', $s);
            $s = strtolower($s);
            $post_feilds['slug'] = $s;
        } else if($slug == 'category'){
            $s = $_POST['name'];
            $s = strtolower($s);
            $s = str_replace(' ', '', $s);
            $post_feilds['slug'] = $s;
            // dd($s);
        }
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function blog_generator(Request $request) {
        $token_ignore = ['_token' => '' , 'record_id' => '', 'blog_image' => '', 'thumbnail' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $blog_feilds = array();
        $data = 'App\Models\blog';
        $picture = [];
        $extension=array("jpeg","jpg","png","jfif");
        if ($request->hasFile('blog_image')) {
            foreach ($request->blog_image as $key => $img_path) {
                $filename =time()."_".$img_path->getClientOriginalName();
                $path = $img_path->storeAs('uploads/blog/', $filename, 'public');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $name = 'uploads/blog/'.$filename;
                if(in_array($ext,$extension)) {
                    $picture[$key] = $name;
                } else{
                    $msg = "This File type is not Supported!";
                    return redirect()->back()->with('error', "Error Code: ".$msg);
                }
            }
            $post_feilds['link'] = null;
            $post_feilds['image'] = $picture[0];
        } elseif ($request->hasFile('thumbnail') && isset($_POST['link']) && $_POST['link'] != '') {
            $filename =time()."_".$request->thumbnail->getClientOriginalName();
            $path = $request->thumbnail->storeAs('uploads/blog/', $filename, 'public');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $name = 'uploads/blog/'.$filename;
            if(in_array($ext,$extension)) {
                $post_feilds['thumbnail'] = $name;
                $post_feilds['link'] = $_POST['link'];
            } else{
                $msg = "This File type is not Supported!";
                return redirect()->back()->with('error', "Error Code: ".$msg);
            }
        }
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                if (isset($post_feilds['image']) && $post_feilds['image'] != '') {
                    $update_feilds['is_active'] = 0;
                    $update_feilds['is_deleted'] = 1;
                    $update = blog_image::where("blog_id" , $_POST['record_id'])->update($update_feilds);
                    $feilds['thumbnail'] = null;
                    $feilds['link'] = null;
                    $update = $data::where("id" , $_POST['record_id'])->update($feilds);
                    foreach ($picture as $key => $value) {
                        $blog_feilds['blog_id'] = $_POST['record_id'];
                        $blog_feilds['image'] = $value;
                        $create_blog = blog_image::create($blog_feilds);
                    }
                } elseif(isset($post_feilds['thumbnail']) && $post_feilds['thumbnail'] != ''){
                    $update_feilds['image'] = null;
                    $update = $data::where("id" , $_POST['record_id'])->update($update_feilds);
                }
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $create = $data::create($post_feilds);
                if (isset($post_feilds['image']) && $post_feilds['image'] != '') {
                    foreach ($picture as $key => $value) {
                        $blog_feilds['blog_id'] = $create->id;
                        $blog_feilds['image'] = $value;
                        $create_blog = blog_image::create($blog_feilds);
                    }
                }
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function instructor_registration(Request $request)
     {
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $instructors = instructors::where('is_active',1)->where('id',$_POST['record_id'])->first();
                $user = User::where('is_active',1)->where('id',$instructors->user_id)->first();
                $post_feilds['name'] = $_POST['name'];
                $post_feilds['desc'] = $_POST['desc'];
                $create = instructors::where("id" , $_POST['record_id'])->update($post_feilds);
                $user_feilds['name'] = $_POST['name'];
                if ($request->profile_pic) {
                    $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,gif,svg',
                    ]);
                    $file = $request->profile_pic;
                    $file_name = $request->profile_pic->getClientOriginalName();
                    $file_name = substr($file_name, 0, strpos($file_name, "."));
                    $name = "uploads/avatar/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/avatar/';
                    $share = $request->profile_pic->move($destinationPath,$name);
                    $user_feilds['profile_pic'] = $name;
                }
                $user_update = User::where("id" , $instructors->user_id)->update($user_feilds);
                $msg = "Record has been updated";
            } else{
                $rules = [
                    'password' => 'required|string|min:8',
                    'email' => 'required|string|email|max:255|unique:users'
                ];
                $messages = [
                    'email.required' => 'The email is required.',
                    'name.required' => 'The name is required.',
                    'profile_pic.required' => 'The pic is required.',
                    'desc.required' => 'The desc is required.',
                    'email.email' => 'The email needs to have a valid format.',
                    'email.exists' => 'The email is already registered in the system.',
                ];
                $validator = Validator::make($_POST,$rules,$messages);
                if ($validator->fails()) {
                    return redirect()->back()->withInput()->withErrors($validator);
                } else{
                    $post_feilds = [];
                    $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,gif,svg',
                    ]);
                    $file = $request->profile_pic;
                    $file_name = $request->profile_pic->getClientOriginalName();
                    $file_name = substr($file_name, 0, strpos($file_name, "."));
                    $name = "uploads/avatar/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/avatar/';
                    $share = $request->profile_pic->move($destinationPath,$name);
                    // $post_feilds['profile_pic'] = $name;
                    $username = strtolower($_POST['name']);
                    $username = str_replace(' ', '', $username);
                    $user = new User;
                    $user->name = $_POST['name'];
                    $user->email = $_POST['email'];
                    $user->username = $username;
                    $user->password = Hash::make($_POST['password']);
                    $user->profile_pic = $name;
                    $user->role_id = 2;
                    $user->save();
                    if ($user) {
                        $instructor_feilds['user_id'] = $user->id;
                        $instructor_feilds['name'] = $_POST['name'];
                        $instructor_feilds['desc'] = $_POST['desc'];
                        $instructors = instructors::create($instructor_feilds);
                        $msg = "Record has been created";
                    }
                }
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function product_generator($slug='' , Request $request)
    {
        $token_ignore = ['image' => '' ,'_token' => '' , 'record_id' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
       
        if ($slug == 'product') {
            $s = $_POST['name'];
            $s = str_replace(' ', '', $s);
            $s = strtolower($s);
            $post_feilds['slug'] = $s;
        }
        if ($request->const_picture) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg',
            ]);
            $file = $request->const_picture;
            $file_name = $request->const_picture->getClientOriginalName();
            $file_name = substr($file_name, 0, strpos($file_name, "."));
            $name = "uploads/product/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/product/';
            $share = $request->const_picture->move($destinationPath,$name);
            $post_feilds['picture'] = $name;
        }
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = product::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $create = product::create($post_feilds);
                $msg = "Record has been created";
            }
            // $product = new product;
            // $product->categoryid = $_POST['categoryid'];
            // $product->tagprice = $_POST['tagprice'];
            // $pic_file = $request->picture;
            // $pic_file_name = $request->picture->getClientOriginalName();
            // $pic_file_name = substr($pic_file_name, 0, strpos($pic_file_name, "."));
            // $pic_name = "uploads/product/" .$pic_file_name."_".time().'.'.$pic_file->getClientOriginalExtension();
            // $destinationPath = public_path().'/uploads/product/';
            // $share = $request->picture->move($destinationPath,$pic_name);
            // $product->picture = $pic_name;
            // $product->name = $_POST['name'];
            // $product->desc = $_POST['desc'];
            // $product->slug = $s;
            // $product->save();
            // $pid = $product->id;
            // $price = $_POST['price'];
            // if (isset($_POST['type']) && $_POST['type'] != '') {
            //     $type = $_POST['type'];
            // }
            // $stock = $_POST['stock'];
            // $sku = $_POST['sku'];
            // $image = $request->image;
            // $j=0;
            // foreach ($price as $key => $value) {
            //     $variation = new product_list;
            //     $file = $request->image[$key];
            //     $file_name = $request->image[$key]->getClientOriginalName();
            //     $file_name = substr($file_name, 0, strpos($file_name, "."));
            //     $name = "uploads/product/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
            //     $destinationPath = public_path().'/uploads/product/';
            //     $share = $request->image[$key]->move($destinationPath,$name);
            //     $variation->product_id = $pid;
            //     $variation->price = $price[$key];
            //     if ($stock[$key]) {
            //         $variation->stock = $stock[$key];
            //     }
            //     if ($sku[$key]) {
            //         $variation->sku = $sku[$key];
            //     }
            //     $variation->image = $name;
            //     $variation->save();
            //     $plid = $variation->id;
            //     if (isset($_POST['type']) && $_POST['type'] != '') {
            //         if ($type[$j]) {
            //             for ($i=$j; $i < ((count($type)/count($price))+$j); $i++) { 
            //                 $listvar = product_variation::where("is_active" , 1)->where("is_deleted" , 0)->where("id" , $type[$i])->first();
            //                 $product_varlist = new product_varlist;
            //                 $product_varlist->product_id = $pid;
            //                 $product_varlist->product_list_id = $plid;
            //                 $product_varlist->var_id = $type[$i];
            //                 $product_varlist->type = $listvar->type;
            //                 $product_varlist->value = $listvar->value;
            //                 $product_varlist->save();
            //             }
            //             $j=$i;
            //         }
            //     }
            // }
            
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function variation_generator(Request $request)
    {
        
        $colour_feilds = [];
        $size_feilds = [];
        $pid = $_POST['product_id'];
        $colour_feilds['product_id'] = $pid;
        if (isset($request->image)) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif,svg',
            ]);
            $file = $request->image;
            $file_name = $request->image->getClientOriginalName();
            $file_name = substr($file_name, 0, strpos($file_name, "."));
            $name = "uploads/product/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/uploads/product/';
            $share = $request->image->move($destinationPath,$name);
            $colour_feilds['image'] = $name;
        }
        $colour_feilds['colour'] = $_POST['colour'];
        try {
            if (isset($_POST['product_colour_id']) && $_POST['product_colour_id'] != '') {
                $update_colour = product_colour::where("id" , $_POST['product_colour_id'])->update($colour_feilds);
                $size_feilds['size'] = $_POST['size'][0];
                $size_feilds['stock'] = $_POST['stock'][0];
                $size_feilds['sku'] = $_POST['sku'][0];
                $update_size = product_size::where("id" , $_POST['product_size_id'])->update($size_feilds);
                $msg = "Record has been updated";
            } else{
                $colour = product_colour::create($colour_feilds);
                $size_feilds['product_id'] = $pid;
                $size_feilds['product_colour_id'] = $colour->id;
                foreach ($_POST['size'] as $key => $value) {
                    if (isset($value) && $value!= '') {
                        $size_feilds['size'] = $_POST['size'][$key];
                        $size_feilds['stock'] = $_POST['stock'][$key];
                        $size_feilds['sku'] = $_POST['sku'][$key];
                        $size = product_size::create($size_feilds);
                    }
                }
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function pro_crud_generator($slug='' , Request $request)
    {
        $token_ignore = ['_token' => '' , 'record_id' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\\'.$slug;
        if ($slug == "colour" || $slug == "size") {
            // dd("yes");
            $name = strtolower($_POST['name']);
            $replace = str_replace(" ","",$name);
            $s = $_POST['category_id'] . "_" . $replace;
            $check =$data::where("is_active",1)->where("is_deleted",0)->where("slug", $s)->first();
            if ($check) {
                $msg = "This ".$slug. " has already been added";
                return redirect()->back()->with('error', $msg);
            }
            $post_feilds['slug'] = $s;
        }
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function image_crud_generator($slug='' , Request $request)
    {
        $token_ignore = ['image' => '' ,'_token' => '' , 'record_id' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\\'.$slug;
        try {
            /* Store $imageName name in DATABASE from HERE */
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                if ($request->image) {
                    $request->validate([
                        'image' => 'mimes:jpeg,png,jpg,gif,svg',
                    ]);
                    $file = $request->image;
                    $file_name = $request->image->getClientOriginalName();
                    $file_name = substr($file_name, 0, strpos($file_name, "."));
                    $name = "uploads/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                    $destinationPath = public_path().'/uploads/';
                    $share = $request->image->move($destinationPath,$name);
                    $post_feilds['image']=$name;
                }
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $request->validate([
                    'image' => 'mimes:jpeg,png,jpg,gif,svg',
                ]);
                $file = $request->image;
                // dd($file);
                $file_name = $request->image->getClientOriginalName();
                $file_name = substr($file_name, 0, strpos($file_name, "."));
                $name = "uploads/" .$file_name."_".time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path().'/uploads/';
                $share = $request->image->move($destinationPath,$name);
                $post_feilds['image']=$name;
                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function delete_record(Request $request)
    {
        $token_ignore = ['_token' => '' , 'id' => '' , 'model' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\\'.$_POST['model'];
        try{
            if ($_POST['model'] == "App\Models\product") {
                $update = product::where("id" , $_POST['id'])->update($post_feilds);
                $updateCol = product_colour::where("product_id" , $_POST['id'])->update($post_feilds);
                $updateSiz = product_size::where("product_id" , $_POST['id'])->update($post_feilds);
                $status['message'] = "Record has been deleted";
                $status['status'] = 1;
                return json_encode($status);
            } else{
                $update = $_POST['model']::where("id" , $_POST['id'])->update($post_feilds);
                $status['message'] = "Record has been deleted";
                $status['status'] = 1;
                return json_encode($status);
            }
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function delete_pitcher(Request $request)
    {
        $i = $_POST['index'];
        $data = $_POST['model'];
        $id =$_POST['id'];
        try{
            $pitcher = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$id)->first();
            $type = unserialize($pitcher->pitch_type);
            $velocity = unserialize($pitcher->pitch_velocity);
            $spinrate = unserialize($pitcher->pitch_spinrate);
            $horizontal = unserialize($pitcher->pitch_horizontal_break);
            $vertical = unserialize($pitcher->pitch_vertical_break);
            unset($type[$i]);
            unset($velocity[$i]);
            unset($spinrate[$i]);
            unset($horizontal[$i]);
            unset($vertical[$i]);
            $post_feilds['pitch_type'] = serialize($type);
            $post_feilds['pitch_velocity'] = serialize($velocity);
            $post_feilds['pitch_spinrate'] = serialize($spinrate);
            $post_feilds['pitch_horizontal_break'] = serialize($horizontal);
            $post_feilds['pitch_vertical_break'] = serialize($vertical);
            $update = $_POST['model']::where("id" , $_POST['id'])->update($post_feilds);
            $status['message'] = "Record has been deleted";
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
    }
    public function variation(Request $request)
    {
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $id = $post_feilds['id'];
        try{
            $body='<div class="col-md-12 col-sm-6 col-12" id="role-label">
                    <div class="row" id="varlist">';
                    $dis = product_variation::distinct()->where("categoryid",$id)->get(['type']);
                    foreach ($dis as $key => $value){
                $body.='<div class="col-md-6 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Select '.$value->type.':</label>
                                <div class="d-flex">
                                    <select name="type[]" class="form-control" id="">
                                        <option selected="true" disabled="disabled">Select '.$value->type.'</option>';
                                            $type= product_variation::where("categoryid",$id)->where("type", $value->type)->get();
                                            if ($type) {
                                                foreach($type as $k => $val){
                                                    $body.='<option value="'.$val->id.'">'.$val->value.'</option>';
                                                }
                                            }
                            $body.='</select>
                                </div>
                            </div>
                        </div>';
            }
            $body.='</div></div>';
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
    public function variation_of_product(Request $request)
    {
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $id = $post_feilds['id'];
        try{
            $body='<div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        <div class="form-group start-date">
                            <label for="start-date" class="">Colour:</label>
                            <div class="d-flex">
                                <select name="colour[]" id="colour[]" class="form-control profession" required="true" required value="">
                                    <option selected="true" disabled="disabled">Select Colour</option>';
                                    $colour= colour::where("is_active",1)->where("is_deleted",0)->where('category_id',$id)->get();
                                    if ($colour) {
                                        foreach($colour as $k => $val){
                                        $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                        }
                                    }
                        $body.='</select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        <div class="form-group start-date">
                            <label for="start-date" class="">Image:</label>
                            <div class="d-flex">
                                <input type="file" id="image" name="image[]" required="true" required multiple class="form-control profession">
                            </div>
                        </div>
                    </div>';
            $body.='<div class="col-md-6 col-sm-6 col-6" id="rank-label">
                        <div class="form-group start-date">
                            <label for="start-date" class="">Size:</label>
                            <div class="d-flex">
                                <select name="size[]" id="size[]" class="form-control profession" required="true" required value="">
                                    <option selected="true" disabled="disabled">Select Size</option>';
                                    $size= size::where("is_active",1)->where("is_deleted",0)->where('category_id',$id)->get();
                                    if ($size) {
                                        foreach($size as $k => $val){
                                        $body.='<option value="'.$val->id.'">'.$val->name.'</option>';
                                        }
                                    }
                        $body.='</select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-12" id="rank-label">
                        <div class="form-group start-date">
                            <label for="start-date" class="">Stock:</label>
                            <div class="d-flex">
                                <input id="stock" placeholder="Stock" name="stock" class="form-control profession" type="text" autocomplete="off" required="true" required/>
                            </div>
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
    public function setlist(Request $request)
    {
        $token_ignore = ['_token' => '' ];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $id = $post_feilds['id'];
        $body="";
        try{
            $body.='<div class="col-md-12 col-sm-6 col-12" id="role-label">
                    <div class="row" id="listset">';
                    $dis = product_varlist::where("is_active" ,1)->where("is_deleted" ,0)->where("product_list_id",$id)->get();
                    if (count($dis)) {
                        $cat = product::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$dis[0]->product_id)->first();
                        foreach ($dis as $key => $value){
                        $body.='<div class="col-md-4 col-sm-6 col-4" id="rank-label">
                                <div class="form-group start-date">
                                    <label for="start-date" class="">Select '.$value->type.':</label>
                                    <div class="d-flex">
                                        <select name="type[]" class="form-control" id="">
                                            <option disabled="disabled">Select '.$value->type.'</option>';
                                                $type= product_variation::where("categoryid",$cat->categoryid)->where("type", $value->type)->get();
                                                if ($type) {
                                                    foreach($type as $k => $val){
                                                        if ($val->value == $value->value) {
                                                            $body.='<option selected="true" value="'.$val->id.'">'.$val->value.'</option>';
                                                        } else{
                                                            $body.='<option value="'.$val->id.'">'.$val->value.'</option>';
                                                        }
                                                    }
                                                }
                                $body.='</select>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
            $body.='</div></div>';
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
    public function coupon_generator(Request $request)
    {
        $post_feilds['name'] = $_POST['name'];
        if (isset($_POST['dis_amount']) && $_POST['dis_amount'] != '') {
            $post_feilds['dis_amount'] = $_POST['dis_amount'];
            $post_feilds['dis_percentage'] = null;
        } elseif (isset($_POST['dis_percentage']) && $_POST['dis_percentage'] != '') {
            $post_feilds['dis_amount'] = null;
            $post_feilds['dis_percentage'] = $_POST['dis_percentage'];
        } else{
            $msg = "Select either amount or percentage";
            return redirect()->back()->with('error', $msg);
        }
        $s = strtolower($_POST['name']);
        $slug = str_replace(" ","",$s);
        $post_feilds['slug'] = $slug;
        $start_date=date_create($_POST['start_date']);
        $end_date=date_create($_POST['end_date']);
        $post_feilds['start_date'] =  date_format($start_date,"Y-m-d H:i:s");
        $post_feilds['end_date'] =  date_format($end_date,"Y-m-d H:i:s");
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = coupon::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $coupon = coupon::where('is_active',1)->where('is_deleted',0)->where("slug",$slug)->first();
                if ($coupon) {
                    $msg = "This Coupon is already registered";
                }
                else{
                    $create = coupon::create($post_feilds);
                    $msg = "Record has been updated";
                }
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function cms_generator(Request $request)
    {
        $token_ignore = ['_token' => ''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        try {
            $cms = web_cms::where("slug",$_POST['slug'])->first();
            if ($cms) {
                $create = web_cms::where("slug" , $_POST['slug'])->update($post_feilds);
                $msg = "Record has been updated";
            }
            else{
                $create = web_cms::create($post_feilds);
                $msg = "Record has been updated";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function modalform(Request $request)
    {
        $desc = $_POST['desc'];
        $slug = $_POST['slug'];
        $class = $_POST['class'];
        $tag = $_POST['tag'];
        $body="";
        try{
            $route_url = route('cms_generator');
            $body .='<div id="addcms" class="modal fade" role="dialog">
                        <div class="modal-dialog text-left">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form class="" id="cms_form" method="POST" action="'.$route_url.'">
                                        <div class="row">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="hidden" name="tag" id="tag" value="'.$tag.'">
                                            <input type="hidden" name="class" id="class" value="'.$class.'">
                                            <input type="hidden" name="slug" id="slug" value="'.$slug.'">
                                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                                                <div class="form-group end-date">
                                                    <div class="d-flex">
                                                        <textarea id="description"  name="desc" class="form-control" required="true" required>'.$desc.'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button id="discard" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                    <button id="cms-generic" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
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
    public function instructor_generator($slug='' , Request $request)
    {
        $token_ignore = ['_token' => '' , 'record_id' => '', 'image'=>''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $picture = [];
        $extension=array("jpeg","jpg","png");
        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $img_path) {
                $filename =time()."_".$img_path->getClientOriginalName();
                $path = $img_path->storeAs('uploads/instructor/', $filename, 'public');
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $name = 'uploads/instructor/'.$filename;
                if(in_array($ext,$extension)) {
                    $picture[$key] = $name;
                } else{
                    $msg = "This File type is not Supported!";
                    return redirect()->back()->with('error', "Error Code: ".$msg);
                }
            }
            $post_feilds['image']=serialize($picture);
        }
        $data = 'App\Models\instructor_profile';
        try {
            if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
                $msg = "Record has been updated";
            } else{
                $create = $data::create($post_feilds);
                $msg = "Record has been created";
            }
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function team_set(Request $request){
        try{
            $player_id = $_POST['player_id'];
            $team_id = $_POST['team_id'];
            $post_feilds['team_id'] = $team_id;
            $update = player::where("id" , $player_id)->update($post_feilds);
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

    public function order_details($id){
        $orders_details= orders::where("is_active" ,1)->where("is_deleted" ,0)->where("order_details_id",$id)->get();
        return view('web.order-details')->with(compact('orders_details'));
    }

}