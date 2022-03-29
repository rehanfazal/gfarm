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
use App\Models\UserAddress;
use App\Models\UserCreditCard;
use App\Models\UserDetails;
use App\Models\TokenCode;
use App\Models\Helper;
use App\Models\Jobs;
use App\Models\Country;

class GroomController extends Controller
{
	/* Jobs user posted and service provider did, handling in single function */
    public function getJobsByUserorSP(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'user_id' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $getUserRole = Users::find($request->user_id);
            if($getUserRole){
            	$uRole = $getUserRole->role_id;
            	if($uRole == 2){
            		$jobs = Helper::getJobByUserRole($uRole,$request->user_id,$request->status);
            		if(isset($jobs[0])){
	            		return $this->resp(1,"Jobs of User",['jobs' => $jobs]);
            		}
            		else{
	            		return $this->resp(0,"No job posted yet",['jobs' => NULL]);
            		}
            	}
            	if($uRole == 3){
            		$jobs = Helper::getJobByUserRole($uRole,$request->user_id,$request->status);
            		if(isset($jobs[0])){
	            		return $this->resp(1,"Jobs by service provider",['jobs' => $jobs]);
            		}
            		else{
	            		return $this->resp(0,"No jobs found",['jobs' => NULL]);
            		}
            	}
            }
	        else {
	            return $this->resp(0,"Unable to find user",['user' => NULL]);
	        }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function getJobByMainServices(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validators = Validator::make($request->all(), [
                'service_id' => 'required'
            ]);
            if ($validators->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $jobs = Helper::getJobByMainService($request->service_id);
            if(isset($jobs[0])){
            	return $this->resp(1,"Jobs Searched",['jobs' => $jobs]);
            }
            else{
            	return $this->resp(0,"No Job Found",['jobs' => NULL]);
        	}
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function getJobByQuestionCategory(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validators = Validator::make($request->all(), [
                'q_id' => 'required'
            ]);
            if ($validators->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $jobs = Helper::getQuestionCatJob($request->q_id);
            if(isset($jobs[0])){
            	return $this->resp(1,"Jobs Searched",['jobs' => $jobs]);
            }
            else{
            	return $this->resp(0,"No Job Found",['jobs' => NULL]);
        	}
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function addSPJobRequest(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'description' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $jobadded = Helper::addJobRequest($request);

            return $this->resp(1,"Job Request Added",['job_request' => $jobadded]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function getJobRequestDetails(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_request_id' => 'required',
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $jobreq = Helper::getJobRequestDet($request->job_request_id);
            if($jobreq){
            	return $this->resp(1,"Job Request Fetched",['job_request' => $jobreq]);
            }
            else{
            	return $this->resp(0,"Unable to find job request",['job_request' => NULL]);
            }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
     
    public function getAddress(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){

            $ua = UserAddress::where("user_id",$request->user_id)->get();
            if(isset($ua[0])){
                return $this->resp(1,"User Addresses",['user_address' => $ua]);
            }
            return $this->resp(0,"No User Address Found!",['user_address' => NULL]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function addAddress(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'address' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $newAdd = new UserAddress();
            if(isset($request->user_address_id)){
                $newAdd = UserAddress::find($request->user_address_id);
            }
            $newAdd->user_id = $request->user_id;
            $newAdd->address = $request->address;
            $newAdd->save();

            $allAdd = UserAddress::where("user_id",$request->user_id)->get();
            if(isset($request->user_address_id)){
                return $this->resp(1,"User Address Updated",['user_address' => $allAdd]);
            }
            return $this->resp(1,"User Address Added",['user_address' => $allAdd]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function deleteAddress(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'user_address_id' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $ua = UserAddress::find($request->user_address_id);
            if($ua){
                $ua->delete();

                $uadd = UserAddress::where("user_id",$request->user_id)->get();
                return $this->resp(1,"User Address Deleted",['user_address' => $uadd]);
            }
            return $this->resp(0,"Unable to find user address",['user_address' => NULL]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
    
    public function getCreditCard(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){

            $ua = UserCreditCard::where("user_id",$request->user_id)->get();
            if(isset($ua[0])){
                return $this->resp(1,"User Credit Card",['user_card' => $ua]);
            }
            return $this->resp(0,"No Credit Card Found!",['user_card' => NULL]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function addCreditCard(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'card_type' => 'required',
                'card_holder' => 'required',
                'card_number' => 'required',
                'card_cvv' => 'required',
                'card_expiry_date' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $newAdd = new UserCreditCard();
            if(isset($request->user_credit_card_id)){
                $newAdd = UserCreditCard::find($request->user_credit_card_id);
            }
            $newAdd->user_id = $request->user_id;
            $newAdd->card_type = $request->card_type;
            $newAdd->card_holder = $request->card_holder;
            $newAdd->card_number = $request->card_number;
            $newAdd->card_cvv = $request->card_cvv;
            $newAdd->card_expiry_date = $request->card_expiry_date;
            $newAdd->save();

            $allAdd = UserCreditCard::where("user_id",$request->user_id)->get();
            if(isset($request->user_address_id)){
                return $this->resp(1,"User Credit Card Updated",['user_card' => $allAdd]);
            }
            return $this->resp(1,"User Credit Card Added",['user_card' => $allAdd]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function deleteCreditCard(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'user_credit_card_id' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $ua = UserCreditCard::find($request->user_credit_card_id);
            if($ua){
                $ua->delete();

                $uadd = UserCreditCard::where("user_id",$request->user_id)->get();
                return $this->resp(1,"User Credit Card Deleted",['user_card' => $uadd]);
            }
            return $this->resp(0,"Unable to find user address",['user_card' => NULL]);
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
