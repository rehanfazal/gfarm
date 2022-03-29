<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\UserSession;
use App\Models\Users;
use App\Models\UserDetails;
use App\Models\TokenCode;
use App\Models\Helper;
use App\Models\Product;
use URL;


class CategoryController extends Controller
{
	
	public function getAllServices(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$allCats = Helper::getMainServices();
        	if($allCats){
            	return $this->resp(1,"Services Found!",['services' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Service Found!",['services' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getAllProducts(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$allCats = Product::where("status",1)->get();
			if(isset($request->cat_id)){
				$allCats = Product::where("status",1)->where("category_id",$request->cat_id)->get();
			}
        	if(isset($allCats[0])){
				foreach($allCats as $pro){
					$pro->image= (isset($pro->image)) ? URL::to("public/images/".$pro->image) : NULL;
					$pro->product_image= (isset($pro->image)) ? URL::to("public/images/".$pro->image) : NULL;
					$pro->category_data = $pro->getCategory;
					$pro->category_data->image = (isset($pro->getCategory->image)) ? URL::to("public/images/".$pro->getCategory->image) : NULL;
				}
            	return $this->resp(1,"Products Found!",['products' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Service Found!",['services' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getAllQuestions(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$allCats = Helper::getAllQuestion();
        	if($allCats){
            	return $this->resp(1,"Questions Found!",['questions' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Found!",['questions' => NULL]);
        	}

	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getMainServiceQuestions(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			if(!isset($request->service_id)){
            	return $this->resp(0,"Fill the required fields!",['questions' => NULL]);
			}
        	$allCats = Helper::getMainServiceQuestion($request->service_id);
        	if($allCats){
            	return $this->resp(1,"Questions Found!",['questions' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Found!",['questions' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getAllQuestionOptions(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$allCats = Helper::getAllQuestionOption();
        	if($allCats){
            	return $this->resp(1,"Question Option Found!",['question_option' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Option Found!",['question_option' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getMainServiceQuestionOptions(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			if(!isset($request->service_id)){
            	return $this->resp(0,"Fill the required fields!",['questions' => NULL]);
			}
        	$allCats = Helper::getMainServiceQuestionOption($request->service_id,$request->q_id);
        	if($allCats){
            	return $this->resp(1,"Question Option Found!",['question_option' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Option Found!",['question_option' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}

	public function getQuestionOptionActivity(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			if(!isset($request->q_o_id)){
            	return $this->resp(0,"Fill the required fields!",['questions' => NULL]);
			}
        	$allCats = Helper::getQuestionOptionActivities($request->q_o_id);
        	if($allCats){
            	return $this->resp(1,"Question Option Activities Found!",['activities' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Option Classification Found!",['activities' => NULL]);
        	}
	    }
	    else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
	}
	
	public function getQuestionOptionClassification(Request $request){
		$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
			if(!isset($request->q_o_id)){
            	return $this->resp(0,"Fill the required fields!",['questions' => NULL]);
			}
        	$allCats = Helper::getQuestionOptionClassifications($request->q_o_id);
        	if($allCats){
            	return $this->resp(1,"Question Option Classification Found!",['classification' => $allCats]);
        	}
        	else{
            	return $this->resp(0,"No Question Option Classification Found!",['classification' => NULL]);
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
