<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\UserSession;
use App\Models\UserLogs;
use App\Models\Users;
use App\Models\UserDetails;
use App\Models\TokenCode;
use App\Models\Helper;
use App\Models\Services;
use App\Models\UserLocation;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Feedback;
use URL;

class JobsController extends Controller
{
	public function getJobsList(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$allJobs = Helper::getJobsListing();
        	if($allJobs){
            	return $this->resp(1,"Jobs Listing",['jobs' => $allJobs]);
        	}
        	else{
            	return $this->resp(0,"Job does not exist!",['jobs' => NULL]);
            }
        }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    public function getSPJobsList(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $allJobs = Helper::getSPJobsListing($request->user_id);
            if($allJobs){
                return $this->resp(1,"Jobs Listing",['jobs' => $allJobs]);
            }
            else{
                return $this->resp(0,"Job does not exist!",['jobs' => NULL]);
            }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
    
    //  New Add Job Code
    public function addOrder(Request $request){
		$data = $request->all();
        // dump($data);
        // // $data = json_decode($data);
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			$validator = Validator::make($request->all(), [
	            'order_item' => 'required',
	            'total_price' => 'required',
	            'first_name' => 'required',
	            'last_name' => 'required',
	            // 'description' => 'required',
	            'discount' => 'required',
	            'phone' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return $this->resp(0,"Add Job Failed",['error' => 'Fill the required fields!']);
	        }

            $newJob = new Order();
            $newJob->user_id = $request->user_id;
            $newJob->total_price = $request->total_price;
            $newJob->first_name = $request->first_name;
            $newJob->last_name = $request->last_name;
            $newJob->description = $request->description;
            $newJob->discount = $request->discount;
            $newJob->location = $request->location;
            $newJob->phone = $request->phone;
            $newJob->save();
            
            $orderItems = $request->order_item;
            foreach($orderItems as $item){
                $newItem = new OrderItem();
                $newItem->order_id = $newJob->id;
                $newItem->product_id = $item['id'];
                $newItem->quantity = $item['quantity'];
                $newItem->discount_given = $item['discount_given'];
                $newItem->price = $item['price'];
                $newItem->save();

                $this->updateStockOfProduct($item['id'],$item['quantity']);
            }

            $order = Order::find($newJob->id);
            $orderItems = $order->getOrderItems;
            foreach($orderItems as $i){
                $i->product_detail = Product::find($i->product_id);
            }
            $order->order_items = $orderItems;

		    return $this->resp(1,"Order added successfully!",['job' => $order]);
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    //  New Add Job Code
    public function addFeedback(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			$validator = Validator::make($request->all(), [
	            'customer_name' => 'required',
	            'description' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return $this->resp(0,"Add Feedback Failed",['error' => 'Fill the required fields!']);
	        }

            $f = new Feedback();
            $f->user_id = $request->user_id;
            $f->customer_name = $request->customer_name;
            $f->feedback = $request->description;
            $f->save();
            
		    return $this->resp(1,"Feedback added successfully!",['feedback' => $f]);
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    //  New Add Job Code
    public function getOrderDetails(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			$validator = Validator::make($request->all(), [
	            'order_id' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return $this->resp(0,"Add Feedback Failed",['error' => 'Fill the required fields!']);
	        }

            $order = Order::find($request->order_id);
            if($order){
                $orderitem = $order->getOrderItems;
                foreach($orderitem as $item){
                    $item->product_details = $item->getProduct;
                }
                $order->order_items = $orderitem;
                return $this->resp(1,"Order Details!",['order' => $order]);
            }
		    return $this->resp(0,"Unable to find order!",['order' => NULL]);
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    //  New Add Job Code
    public function getUserOrders(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){

            $orders = Order::where("user_id",$request->user_id)->orderBy("created_at","desc")->get();
            if(isset($orders[0])){
                foreach($orders as $order){
                    $orderitem = $order->getOrderItems;
                    foreach($orderitem as $item){
                        $item->product_details = $item->getProduct;
                    }
                    $order->order_items = $orderitem;
                }
                return $this->resp(1,"User Orders!",['orders' => $orders]);
            }
		    return $this->resp(0,"Unable to find order!",['orders' => NULL]);
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    function updateStockOfProduct($product_id,$quantity){
        $pro = Product::find($product_id);
        if($pro){
            $pro->stock -= intval($quantity);
            $pro->save();
        }
        return;
    }

    public function changeJobStatus(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'status' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $getJob = Jobs::find($request->job_id);
            if($getJob){
                $getJob->status = $request->status;
                $getJob->save();

                $jobsarr = Helper::getJobDetails($request->job_id);

                return $this->resp(1,"Job Status Updated!",['job' => $jobsarr]);
            }
            return $this->resp(0,"Unable to find job",['error' => "Unable to find job"]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function getJobPriceCal(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->resp(0,"Add Job Failed",['error' => 'Fill the required fields!']);
            }

            $job = Helper::getJobPriceCalculated($request->job_id);
            return $this->resp(1,"Job Price",['price' => $job]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
    
	public function updateLatLongOfSP(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->resp(0,"SP Location Update Failed",['error' => 'Fill the required fields!']);
            }
            $newLoc = new UserLocation();
            $newLoc->user_id = $request->user_id;
            $newLoc->latitude = $request->latitude;
            $newLoc->longitude = $request->longitude;
            $newLoc->job_id = $request->job_id;
            $newLoc->save();
            
            return $this->resp(1,"SP Location Update",['location' => $newLoc]);
        }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

	public function getLatLongOfSP(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->resp(0,"SP Location Failed",['error' => 'Fill the required fields!']);
            }
            $job = Jobs::find($request->job_id);
            if($job){
                // echo "SP_ID: ".$job->sp_id." Job ID: ".$job->id."\n";
                $latestLoc = UserLocation::where("job_id",$job->id)->where("user_id",$job->sp_id)->orderBy("id","desc")->first();
                if($latestLoc){
                    return $this->resp(1,"SP Location",['location' => $latestLoc]);
                }
                else{
                    return $this->resp(0,"SP location does not exist!",['location' => NULL]);
                }
            }
            else{
                return $this->resp(0,"Unable to find job!",['location' => NULL]);
            }
        }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

    function checkToken($token,$userid){
        $checkt = UserSession::where('remember_token','=',$token)->where('user_id','=',$userid)->first();
        if($checkt){
            return 1;
        }
        else {
            return 0;
        }
    }

    function resp($success, $message, $data = [])
    {
        $resp ['success'] = $success;
        $resp['message'] = $message;
        if (!empty($data)){
            $resp['data'] = $data;
        }
        return response()->json($resp);
    }
}
