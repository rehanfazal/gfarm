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
use App\Models\Jobs;
use App\Models\Country;

class RatingController extends Controller
{
    public function addUserRating(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'job_id' => 'required',
                'rating_user_id' => 'required',
                'rating' => 'required'
            ]);
            if ($validator->fails()){
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $addRating = Helper::addUserRating($request);

            if($addRating){
            	return $this->resp(1,"User Rated Successfully",['user_rating' => $addRating]);
            }
            else{
	            return $this->resp(0,"Unable to add rating",['user_rating' => NULL]);
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
