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
use App\Models\Country;
use App\Models\Gallery;
use URL;
use Exception;

class MobileController extends Controller
{
	public function mobileSignUp(Request $request){
		$validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'account_type' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->resp(0,"Registration Failed",['error' => 'Fill the required fields!']);
        }
        if ($request->password != $request->confirm_password){
            return $this->resp(0,"Registration Failed",['error' => 'Password Do Not Match!']);
        }

    	$data = $request->all();

        $hash = password_hash($request->password, PASSWORD_DEFAULT);

        $emailDup = Helper::checkEmailDup($request->email);
        if($emailDup){
            return $this->resp(0,"Email Already Exist!",['error' => 'Email Already Exist!']); 
        }

        $dup1 = Users::select('*')->where('username','=',$request->username)->first();
        if ($dup1){
            return $this->resp(0,"Username Already Exist!",['error' => 'Username Already Exist!']);           
        }

        $phoneDup = Helper::checkPhoneDup($request->phone);
        if($phoneDup){
            return $this->resp(0,"Phone Already Exist!",['error' => 'Phone Already Exist!']); 
        }

        $checkAccountType = Helper::checkAccountType($request->account_type);
        if($checkAccountType){
            return $this->resp(0,"Unable to create account!",['error' => 'Unable to create account!']); 
        }

    	$newUser = new Users();
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->username = $request->username;
        $newUser->role_id = $request->account_type;
    	$newUser->password = $hash;
    	$newUser->status = 1;
    	$newUser->save();

        $uDetail = new UserDetails();
        $uDetail->user_id = $newUser->id;
        $uDetail->first_name = $request->name;
        $uDetail->status = 1;
        $uDetail->save();

        //Role type: admin = 1, user = 2, service provider = 3, organization = 4 (under organization sp will be individual)
        if($request->account_type == 4 && isset($request->names) && isset($request->emails) && isset($request->phones) && isset($request->usernames)){
            $user_names = $request->names;
            $emails = $request->emails;
            $phones = $request->phones;
            $usernames = $request->usernames;
            $passwords = $request->passwords;

            for($i = 0; $i < count($emails); $i++){
                $hash = password_hash($passwords[$i], PASSWORD_DEFAULT);
                $test = Helper::checkEmailDup($emails[$i]);
                if(!isset($test)){
                    $childUser = new Users();
                    $childUser->email = $emails[$i];
                    $childUser->phone = $phones[$i];
                    $childUser->username = $usernames[$i];
                    $childUser->role_id = 3;
                    $childUser->password = $hash;
                    $childUser->status = 1;
                    $childUser->organization = $newUser->id;
                    $childUser->save();
    
                    $childUseruDetail = new UserDetails();
                    $childUseruDetail->user_id = $childUser->id;
                    $childUseruDetail->first_name = $user_names[$i];
                    $childUseruDetail->status = 1;
                    $childUseruDetail->save();
                }
            }
        }

	    $six_digit_random_number = 111222;//mt_rand(100000, 999999);
		$token = new TokenCode();
		$token->tokenforemail = $six_digit_random_number;
		$token->user_id = $newUser->id;
		$token->save();

        $str=rand(); 
    	$result = md5($str);
    	$logintoken = $result;

    	$mobileloginuser = new UserSession();
    	$mobileloginuser->user_id = $newUser->id;
    	$mobileloginuser->remember_token = $logintoken;
    	$mobileloginuser->save();

        $checkDup = Helper::getUserInfo($newUser->id);
        $checkDup->user_id = $newUser->id;

    	$checkDup->token = $logintoken;

        $msg = "Email Confirmation Code: ".$six_digit_random_number;
        try {
            $sendMail = Helper::sendEmailToUser($newUser->email,$msg);
            if($sendMail){
                return $this->resp(1,"Sign Up Successful",['user' => $checkDup]);
            }
            else{
                return $this->resp(0,"Sign Up Successful without Email",['user' => $checkDup]);
            }
        }
        catch(Exception $e){
            return $this->resp(0,"Sign Up Successful without Email",['user' => $newUser]);
        }
	}

	public function checkUsername(Request $request){
    	$validator = Validator::make($request->all(), [
            'username' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
        }

        $checkDup = Helper::usernameDuplicateCheck($request->username);
        if($checkDup){
            return $this->resp(0,"Username already exists",['error' => "Username already exists!"]);
        }
        else{
            return $this->resp(1,"Username does not exists",['error' => NULL]);
        }
	}
    
    public function getUserData(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'userid' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $checkDup = Helper::getUserInfo($request->userid);
            if($checkDup){
                $checkDup->token = $request->token;
                return $this->resp(1,"User Data Fetched",['user' => $checkDup]);
            }
            else{
                return $this->resp(0,"User not found!",['error' => "User not found!"]);
            }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
    
    public function getUserDataUpdated(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->resp(0,"Fill the required field!",['error' => 'Fill the required fields!']);
            }

            $user = Users::find($request->user_id);
            if($user){
                $user->save();

                $userdet = UserDetails::where('user_id',$user->id)->first();
                if($userdet){
                    $userdet->first_name = $request->first_name;
                    $userdet->last_name = $request->last_name;
                    // $userdet->birthday = (isset($request->birthday)) ? $request->birthday : $userdet->birthday;
                    // $userdet->gender = (isset($request->gender)) ? $request->gender : $userdet->gender;
                    $userdet->location = (isset($request->location)) ? $request->location : $userdet->location;
                    // $userdet->country_id = (isset($request->country_id)) ? $request->country_id : $userdet->country_id;
                    $userdet->language = (isset($request->language)) ? $request->language : $userdet->language;
                    if($request->hasFile('profile_image')){
                        $file = $request->profile_image;
                        $filename = 'userImage'.date("Ymd-hisa").rand(0,999).'.'.$file->getClientOriginalExtension();
                        $destinationPath = "public/images/userImages/".$filename;
                        if (move_uploaded_file($file, $destinationPath)){
                            if (file_exists($destinationPath)){
                                $userdet->profile_image = $filename;
                            }
                        }
                    }
                    $userdet->save();
                }
                else{
                    $userdet = new UserDetails();
                    $userdet->user_id = $request->user_id;
                    $userdet->first_name = $request->name;
                    $userdet->birthday = (isset($request->birthday)) ? $request->birthday : NULL;
                    $userdet->gender = (isset($request->gender)) ? $request->gender : NULL;
                    $userdet->location = (isset($request->location)) ? $request->location : NULL;
                    $userdet->country_id = (isset($request->country_id)) ? $request->country_id : NULL;
                    $userdet->language = (isset($request->language)) ? $request->language : NULL;
                    $userdet->save();
                }

                $updatedInfo = Helper::getUserInfo($request->user_id);
                $updatedInfo->token = $request->token;
                return $this->resp(1,"User Data Updated!",['user' => $updatedInfo]);
            }
            else{
                return $this->resp(0,"User not found!",['error' => "User not found!"]);
            }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

	public function otpConfirmViaEmail(Request $request){
		$tokenValue = $request->confirmtoken;
		$userid = $request->user_id;
		$tokenmatch = TokenCode::select('*')->where('user_id','=',$userid)->where('tokenforemail','=',$tokenValue)->first();
		if($tokenmatch){
			$useractive = Users::find($userid);
			$useractive->status = 1;
			$useractive->save();

			$delTokenCode = TokenCode::find($tokenmatch)->first()->delete();

    		return $this->resp(1,"Signup Successful",['user' => $useractive]);
		}
		else {
    		return $this->resp(0,"Invalid Pin",['user' => NULL]);
		}
	}

    public function mobilelogin(Request $request){
    	if($request->IsMethod("post")){
	    	//$checkpass = crypt($request->password, md5($request->email));

	        $userCheck = Users::select('*')->where('email',$request->email)->first();
	        
	        if ($userCheck){
                // if(!isset($request->remember_token) || !isset($request->email)){
                //     return $this->resp(0,"Invalid email or password!",['error' => 'Wrong email or password!']);
                // }
	        	/*if(!$userCheck->status){
	        		return $this->resp(0,"Login Failed",['error' => 'Account not active!']);
	        	}*/
                // if (password_verify($request->password, $userCheck->password)) {
                // if ($request->remember_token == $userCheck->remember_token) {
    	            $str=rand(); 
    	            $result = md5($str);
    	            $logintoken = $result;

    	            $mobileloginuser = new UserSession();
    	            $mobileloginuser->user_id = $userCheck->id;
    	            $mobileloginuser->remember_token = $logintoken;
    	            $mobileloginuser->save();

    	            $userCheck->token = $logintoken;
                    
                    $checkDup = Helper::getUserInfo($userCheck->id);
                    $checkDup->user_id = $userCheck->id;

    	            $checkDup->token = $logintoken;

                    $checkDup->role_name = Helper::getUserRoleName($userCheck->role_id);

    	            $token = $logintoken;

    	            return $this->resp(1,"Login Successful",['user' => $checkDup]);
                // }
                // else{
                //     return $this->resp(0,"Invalid email or password!",['error' => 'Wrong email or password!']);
                // }
	        }
	        else {
                // Register an account here

                $emailDup = Helper::checkEmailDup($request->email);
                if($emailDup){
                    return $this->resp(0,"Email Already Exist!",['error' => 'Email Already Exist!']); 
                }
                
                $newUser = new Users();
                $newUser->email = $request->email;
                // $newUser->username = $request->username;
                $newUser->role_id = 2;
                $newUser->password = $request->remember_token;
                $newUser->remember_token = $request->remember_token;
                $newUser->status = 1;
                $newUser->save();
                
                $uDetail = new UserDetails();
                $uDetail->user_id = $newUser->id;
                $uDetail->first_name = $request->first_name;
                $uDetail->last_name = $request->last_name;
                $uDetail->status = 1;
                $uDetail->save();

                $str=rand(); 
                $result = md5($str);
                $logintoken = $result;
                $mobileloginuser = new UserSession();
                $mobileloginuser->user_id = $newUser->id;
                $mobileloginuser->remember_token = $logintoken;
                $mobileloginuser->save();

                $checkDup = Helper::getUserInfo($newUser->id);
                $checkDup->user_id = $newUser->id;

                $checkDup->token = $logintoken;

                $checkDup->role_name = Helper::getUserRoleName($newUser->role_id);

                $token = $logintoken;

                return $this->resp(1,"Login Successful",['user' => $checkDup]);
	        }
    	}
    }

    public function mobileloginForUser(Request $request){
    	if($request->IsMethod("post")){
	    	//$checkpass = crypt($request->password, md5($request->email));

	        $userCheck = Users::select('*')->where('email',$request->email)->first();
	        
	        if ($userCheck){
                // if(!isset($request->remember_token) || !isset($request->email)){
                //     return $this->resp(0,"Invalid email or password!",['error' => 'Wrong email or password!']);
                // }
	        	/*if(!$userCheck->status){
	        		return $this->resp(0,"Login Failed",['error' => 'Account not active!']);
	        	}*/
                if (password_verify($request->password, $userCheck->password)) {
                // if ($request->remember_token == $userCheck->remember_token) {
    	            $str=rand(); 
    	            $result = md5($str);
    	            $logintoken = $result;

    	            $mobileloginuser = new UserSession();
    	            $mobileloginuser->user_id = $userCheck->id;
    	            $mobileloginuser->remember_token = $logintoken;
    	            $mobileloginuser->save();

    	            $userCheck->token = $logintoken;
                    
                    $checkDup = Helper::getUserInfo($userCheck->id);
                    $checkDup->user_id = $userCheck->id;

    	            $checkDup->token = $logintoken;

                    $checkDup->role_name = Helper::getUserRoleName($userCheck->role_id);

    	            $token = $logintoken;

    	            return $this->resp(1,"Login Successful",['user' => $checkDup]);
                }
                else{
                    return $this->resp(0,"Invalid email or password!",['error' => 'Wrong email or password!']);
                }
	        }
            return $this->resp(0,"Invalid email or password!",['error' => 'Wrong email or password!']);
    	}
    }
    
    public function mobileloginForGuest(Request $request){
    	if($request->IsMethod("post")){
    	    $str=rand(); 
    	    $result = md5($str);
    	    $logintoken = $result;

    	    $mobileloginuser = new UserSession();
    	    $mobileloginuser->user_id = rand(10000,99999);//$userCheck->id;
    	    $mobileloginuser->remember_token = $logintoken;
    	    $mobileloginuser->save();

    	    $mobileloginuser->token = $logintoken;

    	    return $this->resp(1,"Login Successful",['user' => $mobileloginuser]);
    	}
    }
    
    public function forgetPassword(Request $request){
    	if($request->IsMethod("post")){
    		$email = $request->email;

	    	$newUser = Users::select('*')->where('email','=',$email)->first();
	    	if($newUser){
	    		$six_digit_random_number = 111222;//mt_rand(100000, 999999);
		    	$token = new TokenCode();
		    	$token->tokenforemail = $six_digit_random_number;
		    	$token->user_id = $newUser->id;
		    	$token->save();
				$newUser->tokenotp = $six_digit_random_number;
		    	// the message
				$msg = "Forget Password\nKindly Enter the Below Verification Code to verify it's You\n".$six_digit_random_number;

				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);

				// send email
				$checkError = mail($request->email,"Forgot Password",$msg);
                // $checkError = true;
				if($checkError){
					$newUser->emailstatus = "Email Sent";
		        	return $this->resp(1,"Code Sent Successfully",['user' => $newUser]);
				}
				else{
					$newUser->emailstatus = "Email Not Sent";
		        	return $this->resp(0,"Unable to Send Code",['user' => $newUser]);
				}
	    	}
	    	else{
	    		return $this->resp(0,"User Does Not Exist",['user' => NULL]);
	    	}    		
    	}
    }
    
    public function getGalleryData(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){

            $checkDup = Gallery::where("status",1)->get();
            if($checkDup){
                foreach($checkDup as $image){
                    $image->image_url = URL::to("public/images/".$image->image);
                }
                return $this->resp(1,"Gallery Images Fetched",['image' => $checkDup]);
            }
            else{
                return $this->resp(0,"Images not found!",['error' => "User not found!"]);
            }
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function matchforgotpasswordCode(Request $request){
    	if($request->IsMethod("post")){
            $tokenValue = $request->confirmtoken;
    		$userid = $request->user_id;

    		$tokenmatch = TokenCode::select('*')->where('user_id',$userid)->where('tokenforemail',$tokenValue)->first();

    		$userCheck = Users::select('*')->where('id','=',$userid)->first();
    		if($tokenmatch){
    			if(!$userCheck){
        			return $this->resp(0,"User Does Not Exist",['user' => NULL]);
    			}
    	       	$str=rand(); 
    	        $result = md5($str);
    	        $logintoken = $result;

    	        $mobileloginuser = new UserSession();
    	        $mobileloginuser->user_id = $userCheck->id;
    	        $mobileloginuser->remember_token = $logintoken;
    	        $mobileloginuser->save();

    	        $userCheck->token = $logintoken;

    	       	$token = $logintoken;

    	       	$userCheck->token = $token;

    			$delTokenCode = TokenCode::find($tokenmatch)->first()->delete();

        		return $this->resp(1,"Email Verified",['user' => $userCheck]);
    		}
    		else {
        		return $this->resp(0,"Invalid Pin",['user' => NULL]);
    		}
        }
    }

    public function newPassword(Request $request){
    	$data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$validator = Validator::make($request->all(), [
                'password' => 'required',
                'confirm_password' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return $this->resp(0,"Change Password Failed",['error' => 'Fill the required fields!']);
	        }
	        if ($request->password != $request->confirm_password){
	            return $this->resp(0,"Change Password Failed",['error' => 'Password Do Not Match!']);
	        }

	    	$newUser = Users::find($request->user_id);
	    	if(!$newUser){
            	return $this->resp(0,"User Does not exist",['user' => NULL]);
	    	}
	    	$checkpass = password_hash($request->password, PASSWORD_DEFAULT);
	    	//$newUser = Users::select('*')->where('id','=',$request->id)->first();
	    	$newUser->password = $checkpass;
	    	$newUser->save();
            return $this->resp(1,"Password Change Successful",['user' => $newUser]);
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

    public function mobileUsers(Request $request){
        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token'],$data['user_id']) == 1){
        	$users = Users::select('id','first_name','last_name','email')->where('status','=',1)->get();

            return $this->resp(1,"Users Record",['user' => $users]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function userAccountActive(Request $request){

        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token']) == 1){
        	$userid = $request->id;
        	$userwId = Users::select('*')->where('id','=',$userid)->first();
        	if($userwId){
        		$userwId->status = 1;
        		$userwId->save();
            
            	return $this->resp(1,"Account Activated",['user' => $userwId]);
        	}
        	else {
            	return $this->resp(0,"Account Not Found",['user' => NULL]);
        	}
        }
        else{
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }

    public function userAccountUnActive(Request $request){

        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token']) == 1){
        	$userid = $request->id;
        	$userwId = Users::select('*')->where('id','=',$userid)->first();
        	if($userwId){
        		$userwId->status = 0;
        		$userwId->save();
            
            	return $this->resp(1,"Account Deactivated",['user' => $userwId]);
        	}
        	else {
            	return $this->resp(0,"Account Not Found",['user' => NULL]);
        	}
        }
        else{
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
    }
    
    public function mobilelogout(Request $request){

        $data = $request->all();
        if(!isset($data['token'])){
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
        }
        if($this->checkToken($data['token']) == 1){

            $userentry = UserSession::where('remember_token','=',$data['token'])->delete();

            return $this->resp(1,"Logout Successfull",['user' => NULL]);
        }
        else {
            return $this->resp(0,"Token Mismatch",['user' => NULL]);
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
