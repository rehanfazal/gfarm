<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\UserSession;
use App\Models\UserLogs;
use App\Models\Users;
use App\Models\UserDetails;
use App\Models\TokenCode;
use App\Models\Helper;
use App\Models\Roles;
use App\Models\Jobs;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Gallery;
use PDF;

class JobsController extends Controller
{
    function getAllJobs(Request $request){
        if($request->IsMethod("get")){
            $getJobs = Order::orderBy("id","desc")->paginate(30);
            $data['jobs'] = $getJobs;
            $data['page_name'] = "jobs";
            return view("admin.jobs",$data);
        }
    }
    public function viewJob(Request $request){
    	if($request->IsMethod("get")){
            $jobid = $request->job_id;
            $job = Order::find($jobid);
            if($job){
                // $job = Helper::getJobDetails($jobid);
                $data['job'] = $job;
                $data['page_name'] = "jobs";
                return view("admin.viewjob",$data);
            }
        }
        return redirect()->back();
    }
    
    public function changeOrderStatus(Request $request){
    	if($request->IsMethod("get")){
            $jobid = $request->order_id;
            $job = Order::find($jobid);
            if($job){
                // 1 = Active, 2 = Confirmed, 3 = Ready, 4 = Delivered, 5 = Completed, 6 = Cancelled
                $job->status = $request->status;
                $job->save();
                Session::flash("success","Order status has been updated successfully!");

                return redirect()->back();
            }
        }
        Session::flash("error","Something Went Wrong!");
        return redirect()->back();
    }
}
