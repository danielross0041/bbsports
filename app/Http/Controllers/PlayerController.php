<?php
namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Requests\RequestAttributes;
use Auth;
use App\Models\product;
use App\Models\product_list;
use App\Models\User;
use App\Models\player;
use App\Models\attributes;
use App\Models\role_assign;
use App\Models\category;
use App\Models\product_variation;
use App\Models\product_varlist;
use Illuminate\Support\Str;
use Session;
use Helper;

class PlayerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function player_details($slug='',$id=''){
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
            
            $form = $this->generated_form($slug,$id);
            $table = $this->generated_table($slug,$id);
        }
        return view('roles/crud')->with(compact('attributes','att_tag','role_assign','validator','slug','is_hide','eloquent','form','table'));
    }

    private function generated_form($slug = '',$id='')
    {
        if ($slug == 'player_position_stats') {
            $route_url = route('player_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="player_id" id="player_id" value="'.$id.'">
                    <div class="row">
                        <div id="assignrole"></div>

                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Avg Exit Velo:</label>
                                <div class="d-flex">
                                    <input id="avg_exit_velo" placeholder="Avg Exit Velo" name="avg_exit_velo" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Max Exit Velo:</label>
                                <div class="d-flex">
                                    <input id="max_exit_velo" placeholder="Max Exit Velo" name="max_exit_velo" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Max Distance:</label>
                                <div class="d-flex">
                                    <input id="max_distance" placeholder="Max Distance" name="max_distance" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Bat Speed:</label>
                                <div class="d-flex">
                                    <input id="bat_speed" placeholder="Bat Speed" name="bat_speed" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Hand Speed:</label>
                                <div class="d-flex">
                                    <input id="hand_speed" placeholder="Hand Speed" name="hand_speed" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Impact Momentum:</label>
                                <div class="d-flex">
                                    <input id="impact_momentum" placeholder="Impact Momentum" name="impact_momentum" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Max Acceleration:</label>
                                <div class="d-flex">
                                    <input id="max_acceleration" placeholder="Max Acceleration" name="max_acceleration" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">OF Velo:</label>
                                <div class="d-flex">
                                    <input id="of_velo" placeholder="OF Velo" name="of_velo" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Pop Time:</label>
                                <div class="d-flex">
                                    <input id="pop_time" placeholder="Pop Time" name="pop_time" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'player_all_stats') {
            $route_url = route('player_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="player_id" id="player_id" value="'.$id.'">
                    <div class="row">
                        <div id="assignrole"></div>

                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Vertical Jump:</label>
                                <div class="d-flex">
                                    <input id="vertical_jump" placeholder="Vertical Jump" name="vertical_jump" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Broad Jump:</label>
                                <div class="d-flex">
                                    <input id="broad_jump" placeholder="Broad Jump" name="broad_jump" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">20 Yard Dash:</label>
                                <div class="d-flex">
                                    <input id="yard20_dash" placeholder="20 Yard Dash" name="yard20_dash" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">Grip Strength:</label>
                                <div class="d-flex">
                                    <input id="grip_strength" placeholder="Grip Strength" name="grip_strength" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">10 lb Overhead Med Ball Toss:</label>
                                <div class="d-flex">
                                    <input id="lb10_overhead_med_ball_toss" placeholder="10 lb Overhead Med Ball Toss" name="lb10_overhead_med_ball_toss" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
                            <div class="form-group start-date">
                                <label for="start-date" class="">10 lb Rotational Med Ball Toss:</label>
                                <div class="d-flex">
                                    <input id="lb10_rotational_med_ball_toss" placeholder="10 lb Rotational Med Ball Toss" name="lb10_rotational_med_ball_toss" class="form-control" type="text" autocomplete="off" required="" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>';
            return $body;
        } else if ($slug == 'player_pitcher_stats') {
            $route_url = route('player_crud_generator', $slug);
            $body = '<form class="" id="generic-form" method="POST" enctype="multipart/form-data" action="'.$route_url.'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="record_id" id="record_id" value="">
                    <input type="hidden" name="pitchcount" id="pitchcount" value="1">
                    <input type="hidden" name="player_id" id="player_id" value="'.$id.'">';
                    
                    $body.='<div class="row">
                        <div id="assignrole"></div>
                            <div class="col-md-12 col-sm-6 col-12">
                            <span id="addpitch" class="btn btn-outline-primary">Add</span>
                            </div>
                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="row" id="pitchvar">
                            <div class="col-md-12 col-sm-6 col-12" id="role-label">
                            <div class="row" id="pitchrepeted">
                        	<div class="col-md-6 col-sm-6 col-6" id="rank-label">
	                            <div class="form-group start-date">
	                                <label for="start-date" class="">Pitch Type:</label>
	                                <div class="d-flex">
	                                    <input id="pitch_type" placeholder="Pitch Type" name="pitch_type[]" class="form-control" type="text" autocomplete="off" required="" required/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-6 col-sm-6 col-6" id="rank-label">
	                            <div class="form-group start-date">
	                                <label for="start-date" class="">Pitch Velocity:</label>
	                                <div class="d-flex">
	                                    <input id="pitch_velocity" placeholder="Pitch Velocity" name="pitch_velocity[]" class="form-control" type="text" autocomplete="off" required="" required/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
	                            <div class="form-group start-date">
	                                <label for="start-date" class="">Pitch Spin Rate:</label>
	                                <div class="d-flex">
	                                    <input id="pitch_spinrate" placeholder="Pitch Spin Rate" name="pitch_spinrate[]" class="form-control" type="text" autocomplete="off" required="" required/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
	                            <div class="form-group start-date">
	                                <label for="start-date" class="">Pitch Horizontal Break:</label>
	                                <div class="d-flex">
	                                    <input id="pitch_horizontal_break" placeholder="Pitch Horizontal Break" name="pitch_horizontal_break[]" class="form-control" type="text" autocomplete="off" required="" required/>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-4 col-sm-6 col-4" id="rank-label">
	                            <div class="form-group start-date">
	                                <label for="start-date" class="">Pitch Vertical Break:</label>
	                                <div class="d-flex">
	                                    <input id="pitch_vertical_break" placeholder="Pitch Vertical Break" name="pitch_vertical_break[]" class="form-control" type="text" autocomplete="off" required="" required/>
	                                </div>
	                            </div>
	                        </div>
                            </div>
                            </div>
                            </div>
                            </div>
                    </div>
                    <br><br>';
                	
                $body .= '</form>';
            return $body;
        } else{
            return $body;
        }
    }



    private function generated_table($slug = '',$id='')
    {
        $body = '';
        if ($slug == "player_position_stats") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("player_id",$id)->orderBy('id','desc')->first();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          
                                          <th>Name</th>
                                          <th>Avg Exit Velo</th>
                                          <th>Max Exit Velo</th>
                                          <th>Max Distance</th>
                                          <th>Bat Speed</th>
                                          <th>Hand Speed</th>
                                          <th>Impact Momentum</th>
                                          <th>Max Acceleration</th>
                                          <th>OF Velo</th>
                                          <th>Pop Time</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       	$name = player::where("is_active",1)->where("is_deleted",0)->where("id",$id)->first();
                                       $body .= '<tr>
                                          
                                          <td>'.$name->name.'</td>
                                          <td>'.$loop->avg_exit_velo.'</td>
                                          <td>'.$loop->max_exit_velo.'</td>
                                          <td>'.$loop->max_distance.'</td>
                                          <td>'.$loop->bat_speed.'</td>
                                          <td>'.$loop->hand_speed.'</td>
                                          <td>'.$loop->impact_momentum.'</td>
                                          <td>'.$loop->max_acceleration.'</td>
                                          <td>'.$loop->of_velo.'</td>
                                          <td>'.$loop->pop_time.'</td>
                                          <td>'.date("M d,Y" ,strtotime($loop->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$loop->id.'" data-player_id= "'.$loop->player_id.'"  data-avg_exit_velo= "'.$loop->avg_exit_velo.'" data-max_exit_velo= "'.$loop->max_exit_velo.'" data-max_distance= "'.$loop->max_distance.'" data-bat_speed= "'.$loop->bat_speed.'" data-hand_speed= "'.$loop->hand_speed.'" data-impact_momentum= "'.$loop->impact_momentum.'" data-max_acceleration= "'.$loop->max_acceleration.'" data-of_velo= "'.$loop->of_velo.'" data-pop_time= "'.$loop->pop_time.'">Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$loop->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          
                                          <th>Name</th>
                                          <th>Avg Exit Velo</th>
                                          <th>Max Exit Velo</th>
                                          <th>Max Distance</th>
                                          <th>Bat Speed</th>
                                          <th>Hand Speed</th>
                                          <th>Impact Momentum</th>
                                          <th>Max Acceleration</th>
                                          <th>OF Velo</th>
                                          <th>Pop Time</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#avg_exit_velo").val($(this).data("avg_exit_velo"))
                                                $("#max_exit_velo").val($(this).data("max_exit_velo"))
                                                $("#max_distance").val($(this).data("max_distance"))
                                                $("#bat_speed").val($(this).data("bat_speed"))
                                                $("#hand_speed").val($(this).data("hand_speed"))
                                                $("#impact_momentum").val($(this).data("impact_momentum"))
                                                $("#max_acceleration").val($(this).data("max_acceleration"))
                                                $("#of_velo").val($(this).data("of_velo"))
                                                $("#pop_time").val($(this).data("pop_time"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#player_id").val($(this).data("player_id"))
                                                $("#addevent").modal("show")
                                            })';

                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "player_all_stats") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("player_id",$id)->orderBy('id','desc')->first();
            if ($loop) {
            $body = '<thead>
                                       <tr>
                                          <th>Name</th>
                                          <th>Vertical Jump</th>
                                          <th>Broad Jump</th>
                                          <th>20 Yard Dash</th>
                                          <th>Grip Strength</th>
                                          <th>10 lb Overhead Med Ball Toss</th>
                                          <th>10 lb Rotational Med Ball Toss</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       	$name = player::where("is_active",1)->where("is_deleted",0)->where("id",$id)->first();
                                       $body .= '<tr>
                                          
                                          <td>'.$name->name.'</td>
                                          <td>'.$loop->vertical_jump.'</td>
                                          <td>'.$loop->broad_jump.'</td>
                                          <td>'.$loop->yard20_dash.'</td>
                                          <td>'.$loop->grip_strength.'</td>
                                          <td>'.$loop->lb10_overhead_med_ball_toss.'</td>
                                          <td>'.$loop->lb10_rotational_med_ball_toss.'</td>
                                          <td>'.date("M d,Y" ,strtotime($loop->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$loop->id.'" data-player_id= "'.$loop->player_id.'"  data-vertical_jump= "'.$loop->vertical_jump.'" data-broad_jump= "'.$loop->broad_jump.'" data-yard20_dash= "'.$loop->yard20_dash.'" data-grip_strength= "'.$loop->grip_strength.'" data-lb10_overhead_med_ball_toss= "'.$loop->lb10_overhead_med_ball_toss.'" data-lb10_rotational_med_ball_toss= "'.$loop->lb10_rotational_med_ball_toss.'" >Edit</button>
                                             <button type="button" class="btn btn-danger delete-record" data-model="'.$data.'" data-id= "'.$loop->id.'" >Delete</button>
                                          </td>
                                       </tr>';
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                          <th>Name</th>
                                          <th>Vertical Jump</th>
                                          <th>Broad Jump</th>
                                          <th>20 Yard Dash</th>
                                          <th>Grip Strength</th>
                                          <th>10 lb Overhead Med Ball Toss</th>
                                          <th>10 lb Rotational Med Ball Toss</th>
                                          <th>Creation Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </tfoot>';
                                }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#vertical_jump").val($(this).data("vertical_jump"))
                                                $("#broad_jump").val($(this).data("broad_jump"))
                                                $("#yard20_dash").val($(this).data("yard20_dash"))
                                                $("#grip_strength").val($(this).data("grip_strength"))
                                                $("#lb10_overhead_med_ball_toss").val($(this).data("lb10_overhead_med_ball_toss"))
                                                $("#lb10_rotational_med_ball_toss").val($(this).data("lb10_rotational_med_ball_toss"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#player_id").val($(this).data("player_id"))
                                                $("#addevent").modal("show")
                                            })';

                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
        } else if ($slug == "player_pitcher_stats") {
            $data = 'App\Models\\'.$slug;
            $loop = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("player_id",$id)->orderBy('id','desc')->first();
            if ($loop) {
                $record_id = $loop->id;
            $type = unserialize($loop->pitch_type);
            $velocity = unserialize($loop->pitch_velocity);
            $spinrate = unserialize($loop->pitch_spinrate);
            $horizontal_break = unserialize($loop->pitch_horizontal_break);
            $vertical_break = unserialize($loop->pitch_vertical_break);
            $body = '<thead>
                                       <tr>
                                       	  <th>Name</th>
                                          <th>Pitch Type</th>
                                          <th>Pitch Velocity</th>
                                          <th>Pitch Spin Rate</th>
                                          <th>Pitch Horizontal Break</th>
                                          <th>Pitch Vertical Break</th>
                                       	  <th>Creation Date</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                                       if($loop) {
                                       	$name = player::where("is_active",1)->where("is_deleted",0)->where("id",$id)->first();
                                        $count = 0;
                                        foreach ($velocity as $i => $value) {
                                           
                                       $body .= '<tr>
                                       		<td>'.$name->name.'</td>';
                                            
                                                $body .=
                                                '<td>'.$type[$i].'</td>
                                                <td>'.$velocity[$i].'</td>
                                                <td>'.$spinrate[$i].'</td>
                                                <td>'.$horizontal_break[$i].'</td>
                                                <td>'.$vertical_break[$i].'</td>';
                                            $count = $count+1 ;
                                          $body .= '<td>'.date("M d,Y" ,strtotime($loop->created_at)).'</td>
                                          <td>
                                             <button type="button" class="btn btn-primary editor-form" data-edit_id= "'.$loop->id.'" data-player_id= "'.$loop->player_id.'" data-type="'.$type[$i].'" data-velocity="'.$velocity[$i].'" data-spinrate="'.$spinrate[$i].'" data-horizontalbreak="'.$horizontal_break[$i].'" data-verticalbreak="'.$vertical_break[$i].'" data-pitchcount="'.$i.'">Edit</button>
                                             <button type="button" class="btn btn-danger delete-pitcher" data-model="'.$data.'" data-id= "'.$loop->id.'" data-index='.$i.' >Delete</button>
                                          </td>
                                       </tr>';
                                       }
                                   }
                                    $body .= '</tbody>
                                    <tfoot>
                                       <tr>
                                       	  <th>Name</th>
                                          <th>Pitch Type</th>
                                          <th>Pitch Velocity</th>
                                          <th>Pitch Spin Rate</th>
                                          <th>Pitch Horizontal Break</th>
                                          <th>Pitch Vertical Break</th>
                                       	  <th>Creation Date</th>
                                          <th>Action</th>
                                        </tr>

                                    </tfoot>';
                                    if ($count<5) {
                                        $body .= '<div class="row"><div class="col-md-4 col-sm-6 col-4">
                                                    <button type="button" class="btn btn-primary" data-edit_id= "'.$record_id.'" id="addpitchtype">Add Pitch Type</button>
                                                </div></div>';
                                    }
                                 $script = '$("body").on("click" ,".editor-form",function(){
                                                $("#pitchcount").val($(this).data("pitchcount"))
                                                $(this).closest("#mypitch").find("#addpitch").remove()
                                                $("#pitch_type").val($(this).data("type"))
                                                $("#pitch_velocity").val($(this).data("velocity"))
                                                $("#pitch_spinrate").val($(this).data("spinrate"))
                                                $("#pitch_horizontal_break").val($(this).data("horizontalbreak"))
                                                $("#pitch_vertical_break").val($(this).data("verticalbreak"))
                                                $("#record_id").val($(this).data("edit_id"))
                                                $("#player_id").val($(this).data("player_id"))
                                                $("#addevent").modal("show")
                                                
                                            })
                                            $("body").on("click" ,"#addpitchtype",function(){
                                                $(this).closest("#mypitch").find("#addpitch").remove()
                                                $(this).closest("#mypitch").find("#player_id").val($(this).data("player_id"))
                                                $(this).closest("#mypitch").find("#record_id").val($(this).data("edit_id"))
                                                $("#addevent").modal("show")
                                                
                                            })';

                                $resp['body'] = $body;
                                $resp['script'] = $script;
                                return $resp;
            }
        } else{
            return $body;
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
    public function player_crud_generator($slug='' , Request $request)
    {
        $token_ignore = ['_token' => '' , 'record_id' => '' , 'pitchcount' =>''];
        $post_feilds = array_diff_key($_POST , $token_ignore);
        $data = 'App\Models\\'.$slug;
        try {
        	if ($slug=='player_pitcher_stats') {
        		if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
                    $id = $_POST['record_id'];
                    $pitcher = $data::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$id)->first();
                    $type = unserialize($pitcher->pitch_type);
                    $velocity = unserialize($pitcher->pitch_velocity);
                    $spinrate = unserialize($pitcher->pitch_spinrate);
                    $horizontal = unserialize($pitcher->pitch_horizontal_break);
                    $vertical = unserialize($pitcher->pitch_vertical_break);
                    $pitch_type = $_POST['pitch_type'];
                    $pitch_velocity = $_POST['pitch_velocity'];
                    $pitch_spinrate = $_POST['pitch_spinrate'];
                    $pitch_horizontal_break = $_POST['pitch_horizontal_break'];
                    $pitch_vertical_break = $_POST['pitch_vertical_break'];
                    if (isset($_POST['player_id']) && $_POST['player_id'] != '') {
                        $i = $_POST['pitchcount'];
                        unset($type[$i]);
                        unset($velocity[$i]);
                        unset($spinrate[$i]);
                        unset($horizontal[$i]);
                        unset($vertical[$i]);
                    }
                    array_push($type,$pitch_type[0]);
                    array_push($velocity,$pitch_velocity[0]);
                    array_push($spinrate,$pitch_spinrate[0]);
                    array_push($horizontal,$pitch_horizontal_break[0]);
                    array_push($vertical,$pitch_vertical_break[0]);
                    $edit_feilds['pitch_type'] = serialize($type);
                    $edit_feilds['pitch_velocity'] = serialize($velocity);
                    $edit_feilds['pitch_spinrate'] = serialize($spinrate);
                    $edit_feilds['pitch_horizontal_break'] = serialize($horizontal);
                    $edit_feilds['pitch_vertical_break'] = serialize($vertical);
                    $update = $data::where("id" , $id)->update($edit_feilds);
                    $msg = "Record has been created";
	            } else{
	            	$post_feilds['pitch_type'] = serialize($_POST['pitch_type']);
	            	$post_feilds['pitch_velocity'] = serialize($_POST['pitch_velocity']);
	            	$post_feilds['pitch_spinrate'] = serialize($_POST['pitch_spinrate']);
	            	$post_feilds['pitch_horizontal_break'] = serialize($_POST['pitch_horizontal_break']);
	            	$post_feilds['pitch_vertical_break'] = serialize($_POST['pitch_vertical_break']);
	                $create = $data::create($post_feilds);
	                $msg = "Record has been created";
	            }
        	}
        	else{
        		if (isset($_POST['record_id']) && $_POST['record_id'] != '') {
	                $create = $data::where("id" , $_POST['record_id'])->update($post_feilds);
	                $msg = "Record has been updated";
	            } else{
	                $create = $data::create($post_feilds);
	                $msg = "Record has been created";
	            }
        	}
          return redirect()->back()->with('message', $msg);
        } catch(Exception $e) {
          $error = $e->getMessage();
          return redirect()->back()->with('error', "Error Code: ".$error);
        }
    }
    public function approve_player(Request $request){
        try{
            $player_id = $_POST['player_id'];
            $player = player::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$player_id)->first();
            if ($player->is_approved == 0) {
                $post_feilds['is_approved'] = 1;
                $status['message'] = "Player has been approved";
            } else{
                $post_feilds['is_approved'] = 0;
                $status['message'] = "Player has been refused";
            }
            $update = player::where("id" , $player_id)->update($post_feilds);
            
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
        
    }
    public function recruited_player(Request $request){
        try{
            $player_id = $_POST['player_id'];
            $player = player::where("is_active" ,1)->where("is_deleted" ,0)->where("id",$player_id)->first();
            if ($player->is_recruited == 0) {
                $post_feilds['is_recruited'] = 1;
                $status['message'] = "Player has been Recruited";
            } else{
                $post_feilds['is_recruited'] = 0;
                $status['message'] = "Player has been removed from Recruits";
            }
            $update = player::where("id" , $player_id)->update($post_feilds);
            $status['status'] = 1;
            return json_encode($status);
        }catch(Exception $e) {
            $error = $e->getMessage();
            $status['message'] = $error;
            $status['status'] = 0;
            return json_encode($status);
        }
        
    }
}
