<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Helper;
use App\Models\User;
use App\Models\attributes;
use App\Models\leave_application;
use App\Imports\AttendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Session;
use DateTime;

class LeaveApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function leave_show()
    {
    	
    	$user = Auth::user();

    	// if ($user->role_id != 1 && Auth::user()->role_id != 36) {
    	// 	return redirect()->back()->with('error', 'No Page Found');
    	// }
        
        $project_id = Session::get("project_id");        
        $leave_application = leave_application::where("is_active" , 1)->where("is_deleted" , 0)->where("emp_id" , $user->emp_id)->where('project_id' ,$project_id)->get();
    	return view('applications/show')->with(compact('user','leave_application'));
    }

    public function leave_teamshow()
    {
        $user = Auth::user();
        $project_id = Session::get("project_id");  

        if ($user->role_id == 1) {
            $leave_application = leave_application::where("is_active" , 1)->where("is_deleted" , 0)->where('project_id' ,$project_id)->get();
        }else{
            $leave_application = leave_application::where("is_active" , 1)->where("is_deleted" , 0)->where("tl_id" , $user->emp_id)->where('project_id' ,$project_id)->get();
        }
        if ($leave_application->isEmpty()) {
            return redirect()->back()->with('error', 'No Application Exist');
        }
        return view('applications/leave_teamshow')->with(compact('user','leave_application'));
    }

    public function update_leave_form(Request $request)
    {
        $user = Auth::user();
        $leave_application = leave_application::where("is_active" , 1)->where("is_deleted" , 0)->where('id' ,$request->leave_application_id)->first();
        if ($leave_application) {
            $leave_application->update_by = $user->emp_id;
            $leave_application->status = $request->status;
            $leave_application->update_reason = $request->update_reason;
            $leave_application->save();
            return redirect()->back()->with('message', 'Leave Application has been updated.');
        }else{
            return redirect()->back()->with('error', 'No Application Exist');
        }
    }

    public function all_leave_application()
    {
        
        $user = Auth::user();

        if ($user->role_id != 1 && Auth::user()->role_id != 36) {
         return redirect()->back()->with('error', 'No Page Found');
        }
        
        $project_id = Session::get("project_id");        
        $leave_application = leave_application::where("is_active" , 1)->where("is_deleted" , 0)->where('project_id' ,$project_id)->get();
        return view('applications/view_all')->with(compact('user','leave_application'));
    }


    public function leave_submit(Request $request)
    {
        
        $user = User::find(Auth::user()->id);
        if (!isset($user->report_manager)) {
            return redirect()->back()->with('error', 'No record found against your reporting line manager, Kindly contact system administrator.');
        }
        $leave_application = new leave_application;
        $project_id = Session::get("project_id");
        $fdate = $request->start_date;
        $tdate = $request->end_date;
        
        if (strtotime($fdate) > strtotime($tdate)){
            return redirect()->back()->with('error', 'Start date must not be greater than end date.');
        }
        
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a'); //now do whatever you like with $days
        
        $diffInSeconds = $interval->s; //45
        $diffInMinutes = $interval->i; //23
        $diffInHours   = $interval->h; //8

        $pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 10);
        $leave_application->code = strtoupper($pass);
        $leave_application->project_id = $project_id;
        $leave_application->emp_id = $user->emp_id;
        $leave_application->tl_id = $user->report_manager->emp_id;
        $leave_application->department = $user->department;
        $leave_application->designation = $user->designation;
        $leave_application->title = $request->title;
        $leave_application->leave_type = $request->leave_type;
        $leave_application->start_date = $datetime1;
        $leave_application->end_date = $datetime2;
        $leave_application->reason = $request->reason;
        $leave_application->day = $days+1;
        $leave_application->save();
        return redirect()->back()->with('message', 'Leave has been successfully submitted.');
    }

    public function application_delete()
    {
        if(isset($_GET) && $_GET['id'] != 0){
            $id = $_GET['id'];
            $user = Auth::user();
            $leave_application = leave_application::find($id);
            if ($leave_application) {
                $leave_application = leave_application::where("id" , $id)->where("emp_id" , $user->emp_id)->first();
                if ($leave_application) {
                    $leave_application->is_active = 0;
                    $leave_application->is_deleted = 1;
                    $leave_application->save();
                    $response['status'] = 1;
                    $response['msg'] = "Leave Application has been deleted.";
                    return json_encode($response);
                }else{
                    $response['status'] = 0;
                    $response['msg'] = "You can't delete another person record";
                    return json_encode($response); 
                }
            }else{
                $response['status'] = 0;
                $response['msg'] = "No record found";
                return json_encode($response);   
            }
        }
    }

    public function leave_form_validate(Request $request)
    {
        $from = date('Y-m-d',strtotime($request->start_date));
        $to = date('Y-m-d',strtotime($request->end_date));
        //dd($from,$to);
        if (!isset($request->start_date) ||  !isset($request->end_date) || !isset($request->leave_type) || !isset($request->title) || !isset($request->reason)) {
            $response['status'] = 0;
            $response['msg'] = "Note: Please fill all fields to submit this leave form";
            return json_encode($response); 
        }

        $user = Auth::user();
        $leave_application = leave_application::where("emp_id" , $user->emp_id)
        ->whereDate('start_date','>=', $from)
        ->whereDate('end_date','<=', $to)
        ->where("is_active" , 1)
        ->where("is_deleted" , 0)
        ->orWhereDate('start_date','=', $from)
        ->where("is_active" , 1)
        ->where("is_deleted" , 0)
        ->OrwhereDate('end_date','=', $to)
        ->where("emp_id" , $user->emp_id)
        ->where("is_active" , 1)
        ->where("is_deleted" , 0)
        ->first();
        //dd($leave_application);
        if ($leave_application) {
            $response['status'] = 0;
            $response['msg'] = "Note: You already have submitted the leave application of ".$from." days";
            return json_encode($response); 
        }else{
            if (strtotime($request->start_date) > strtotime($request->end_date)){
                $response['status'] = 0;
                $response['msg'] = "Note: Start date must not be greater than end date";
                return json_encode($response); 
            }
            $response['status'] = 1;
            return json_encode($response); 
        }
        
    }
}
