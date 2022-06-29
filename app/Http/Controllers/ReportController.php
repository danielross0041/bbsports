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
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function registered_user_report()
    {
    	
    	$user = Auth::user();

    	if ($user->role_id != 1 && Auth::user()->role_id != 36) {
    		return redirect()->back()->with('error', 'No Page Found');
    	}

        $all_user = User::where('id' ,'!=', 1)->where('is_active' , 1)->where('is_deleted' , 0)->get();
        $roles = attributes::where("attribute" , "roles")->where('is_active' , 1)->where('is_deleted' , 0)->get();
        
    	return view('reports/registered-user-report')->with(compact('all_user','user','roles'));
    }

    public function all_registered_user_report($slug = '')
    {
        
        $user = Auth::user();

        if ($user->role_id != 1 && Auth::user()->role_id != 36) {
            return redirect()->back()->with('error', 'No Page Found');
        }
        $project_id = Session::get("project_id");
        $all_user = User::where('is_deleted' , 0)->where('project_id' , $project_id)->get();
        
        $designation = attributes::where("is_active" , 1)->get();
        
        return view('reports/all-registered-user-report')->with(compact('all_user','user','designation','slug'));
        
    }


    public function attendance_sheet_import()
    {
        $user = Auth::user();
        if ($user->role_id != 1 && Auth::user()->role_id != 36) {
            return redirect()->back()->with('error', 'No Page Found');
        }
        
        return view('reports/attendance-sheet-import')->with(compact('user'));
    }

    public function attendance_import_submit(Request $request)
    {
        if (!$request->has('file')) {
            return redirect()->back()->with('error', 'No file is attached.');
        }
        $extensions = array("xls","xlsx");
        $result = array($request->file('file')->getClientOriginalExtension());

        if(in_array($result[0],$extensions)){
            Excel::import(new AttendanceImport,request()->file('file'));
            return redirect()->back()->with('message', 'Attendance Sheet has been uploaded successfully');
        }else{
           return redirect()->back()->with('error', 'Only xlsx extension is allowed.');
        }
    }

    public function all_leave_application_report()
    {
        $project_id = Session::get("project_id");
        $leave_application = leave_application::where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get(); 
        return view('reports/all-leave-application-report')->with(compact('leave_application'));
    }

    public function birthday_list()
    {
        $project_id = Session::get("project_id");
        $bday_currentmonth = User::whereMonth('dob', '=', Carbon::now()->format('m'))->whereDay('dob', '>=', Carbon::now()->format('d'))->where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get();
        $bday_upcoming = User::whereMonth('dob', '>=', Carbon::now()->format('m'))->whereDay('dob', '>=', Carbon::now()->format('d'))->where("project_id" ,$project_id)->where("is_active" ,1)->where("is_deleted" ,0)->get();
        $departments = attributes::where("is_active" , 1)->where('attribute',"departments")->get();
        return view('reports/birthday-list')->with(compact('bday_currentmonth','bday_upcoming','departments'));
    }
    

}
