<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserSession;
use App\Models\UserLogs;
use App\Models\Users;
use App\Models\TokenCode;
use App\Models\Roles;
use App\Models\Jobs;
use App\Models\JobImages;
use App\Models\Country;
use App\Models\JobRequests;
use App\Models\UserRating;
use App\Models\Activities;
use App\Models\Classification;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\JobQuestionOption;
use App\Models\ClassificationQuestionOption;
use App\Models\ActivitiesQuestionOption;
use URL;

class Helper extends Model
{
    public static function usernameDuplicateCheck($username){
        $user = Users::select("*")->where("username",$username)->first();
        if($user){
            return $user;
        }
        else{
            return NULL;
        }
    }

    public static function getJobStatusName($status_int){
        $statuses = ["In-Active","Active","In-Progress","Completed","Cancelled"];
        return $statuses[$status_int];
    }

    public static function getUserRoleName($role_id){
        if($role_id == 1 || $role_id == 2 || $role_id == 3 || $role_id == 4){
            $roles = ["","admin","user","service-provider","organization"];
            return $roles[$role_id];
        }
        else{
            return NULL;
        }
    }

    public static function sendEmailToUser($email,$msg){
		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);

		// send email
		$checkError = mail($email,"Forgot Password",$msg);
        // $checkError = true;
		if($checkError){
            return true;
		}
		else{
		    return false;
		}
    }

    public static function getUserInfo($userid){
        $user = Users::select("users.email","users.role_id","ud.user_id","users.status","ud.first_name","ud.last_name","ud.profile_image")->where("users.id",$userid)->join("user_details as ud",'users.id','ud.user_id')->first();
        if($user){
            if(isset($user->profile_image)){
                $user->profile_image = URL::to('public/images/userImages/'.$user->profile_image);
            }
            else{
                $user->profile_image = NULL;
            }
            $user->role_name = Helper::getUserRoleName($user->role_id);
            // $user->ratings = Helper::getUserRating($userid);
            return $user;
        }
        else{
            return NULL;
        }
    }

    public static function getUserRating($user_id){
        $user = Users::find($user_id);
        if($user){
            $getRating = UserRating::select("*")->where("rating_user_id",$user_id)->get();
            if(isset($getRating[0])){
                $totalRates = $getRating->count();
                $allRateCount = 0;
                foreach($getRating as $sing){
                    $allRateCount += (int)($sing->rating);
                }
                $finalRating = "";
                if($totalRates != 0){
                    $finalRating = (float)($allRateCount/$totalRates);
                }
                else{
                    $finalRating = (float)($allRateCount);
                }
                return array("total_rating"=>$finalRating,"rating_data"=>$getRating);
            }
        }
        return NULL;
    }

    public static function getJobPriceCalculated($jobid){
        $job = Jobs::find($jobid);
        if($job){
            $qOptions = $job->getQuestionOption;
            $price = 0;
            foreach($qOptions as $q){
                $price += floatval($q->total_price);
            }

            return $price;
        }
        else{
            return NULL;
        }
    }

    public static function getJobDetails($jobid){
        $job = Jobs::find($jobid);
        $total_time_in_hrs=0;
        $total_price=0;
        if($job){
            $getMainCat = Services::find($job->service_id);
            $job->service_name = (isset($getMainCat)) ? $getMainCat->name : NULL;

            $jQuestions = $job->getQuestion;
            foreach($jQuestions as $jQ){
                $jQoptions = $jQ->getJobQuestionOptions($job->id,$jQ->q_id);
                foreach($jQoptions as $jqOp){
                    $jOptionDet = $jqOp->getQuestionOption;
                    $total_time_in_hrs += floatval($jOptionDet->time_in_hrs);
                    $total_price += floatval($jOptionDet->total_price);
                    $jqOp->q_option = $jqOp->getQuestionOption;
                }
                $jQ->details = $jQ->getQuestion;
                $jQ->options = $jQoptions;
            }
            $job->question_detail = $jQuestions;
            // $job->q_options = $job->getQuestionOption;
            // foreach ($job->q_options as $op){
            //     $op->option_details = $op->getQuestionOption;
            //     $total_time_in_hrs += floatval($op->getQuestionOption->time_in_hrs);
            //     $total_price += floatval($op->getQuestionOption->total_price);
            // }

            $job->total_time_in_hrs = $total_time_in_hrs;
            // $job->total_price = $total_price; //commented for change asked

            $userdata = Helper::getUserInfo($job->user_id);
            $job->user_data = (isset($userdata)) ? $userdata : NULL;
            $spdata = Helper::getUserInfo($job->sp_id);
            $job->sp_data = (isset($spdata)) ? $spdata : NULL;
            $job->status_name = Helper::getJobStatusName($job->status);
            $job->images = Helper::getJobImages($job->id);

            return $job;
        }
        else{
            return NULL;
        }
    }

    public static function getJobByUserRole($role_id,$user_id,$status){
        /* If user is Simple User */
        if($role_id == 2){
            $jobs = Jobs::select("*")->where('user_id',$user_id)->where('status',$status)->get();
            if($jobs){
                $jobsarr = [];
                foreach($jobs as $j){
                    $jobsarr[] = Helper::getJobDetails($j->id);
                }
                return $jobsarr;
            }
            else{
                return NULL;
            }
        }
        /* If user is Service Provider */
        if($role_id == 3){
            $jobs = Jobs::select("*")->where('sp_id',$user_id)->where('status',$status)->get();
            if($jobs){
                $jobsarr = [];
                foreach($jobs as $j){
                    $jobsarr[] = Helper::getJobDetails($j->id);
                }
                return $jobsarr;
            }
            else{
                return NULL;
            }
        }
    }

    public static function getJobRequest($job_id){
        $getJReq = JobRequests::select("*")->where("job_id",$job_id)->get();
        if(isset($getJReq[0])){
            return array("count"=>count($getJReq),"job_requests"=>$getJReq);
        }
        else{
            return array("count"=>0,"job_requests"=>NULL);
        }
    }

    public static function addJobRequest($request){
        $addJR = new JobRequests();
        $addJR->job_id = $request->job_id;
        $addJR->user_id = $request->user_id;
        $addJR->description = $request->description;
        $addJR->price = $request->price;
        $addJR->save();

        return $addJR;
    }


    public static function addUserRating($request){
        $checkJob = Jobs::find($request->job_id);
        if($checkJob){
            $checkUser = Users::find($request->rating_user_id);
            if($checkUser){
                $addJR = new UserRating();
                $addJR->job_id = $request->job_id;
                $addJR->user_id = $request->user_id;
                $addJR->rating_user_id = $request->rating_user_id;
                $addJR->rating = $request->rating;
                $addJR->title = (isset($request->title)) ? $request->title : NULL;
                $addJR->description = (isset($request->description)) ? $request->description : NULL;
                $addJR->save();

                return $addJR;
            }
        }
        return NULL;
    }


    public static function getJobRequestDet($jr_id){
        $jReq = JobRequests::find($jr_id);
        if($jReq){
            $jReq->job_details = Helper::getJobDetails($jReq->job_id);
            $jReq->user_details = Helper::getUserInfo($jReq->user_id);
            return $jReq;
        }
        else{
            return NULL;
        }
    }

    public static function getMainServices(){
        $mainCats = Services::select("*")->where("status",1)->get();
        if(isset($mainCats[0])){
            foreach($mainCats as $sCat){

                $sCat->image = (isset($sCat->image) || $sCat->image != '') ? URL::to("public/images/".$sCat->image) : NULL;
            }
            return $mainCats;
        }
        else{
            return NULL;
        }
    }

    public static function getMainServiceViaId($id){
        $mainCats = Services::find($id);
        if($mainCats){
            $mainCats->image = URL::to("public/images/".$mainCats->image);
            return $mainCats;
        }
        else{
            return NULL;
        }
    }

    public static function getAllQuestion(){
        $subCats = Question::select("*")->where("status",1)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getMainServiceQuestion($service_id){
        $subCats = Question::select("*")->where("status",1)->where("service_id",$service_id)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getAllQuestionOption(){
        $subCats = QuestionOption::select("*")->where("status",1)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getAllActivities(){
        $subCats = Activities::select("*")->where("status",1)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getAllClassifications(){
        $subCats = Classification::select("*")->where("status",1)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getMainServiceQuestionOption($service_id,$q_id=''){
        $subCats = "";
        if(isset($q_id)){
            $subCats = QuestionOption::select("*")->where("service_id",$service_id)->where("q_id",$q_id)->where("status",1)->get();
        }
        else{
            $subCats = QuestionOption::select("*")->where("service_id",$service_id)->where("status",1)->get();
        }
        if(isset($subCats[0])){
            foreach($subCats as $a){
                $a->main_service_details = Helper::getMainServiceViaId($a->service_id);
                $a->question_category_details = $a->getQuestion;
            }
            return $subCats;
        }
        else{
            return NULL;
        }
    }

    public static function getQuestionOptionActivities($q_o_id){
        $subCats = ActivitiesQuestionOption::select("*")->where("q_o_id",$q_o_id)->get();
        if(isset($subCats[0])){
            $arr = [];
			foreach($subCats as $aC){
				$arr[] = $aC->getActivity;
			}
            return $arr;
        }
        else{
            return NULL;
        }
    }

    public static function getQuestionOptionClassifications($q_o_id){
        $subCats = ClassificationQuestionOption::select("*")->where("q_o_id",$q_o_id)->get();
        if(isset($subCats[0])){
            $arr = [];
			foreach($subCats as $aC){
				$arr[] = $aC->getClassification;
			}
            return $arr;
        }
        else{
            return NULL;
        }
    }


    public static function getQuestions($subCatId){
        $subCats = Question::select("*")->where("service_id",$subCatId)->get();
        if(isset($subCats[0])){
            return $subCats;
        }
        else{
            return NULL;
        }
    }


    public static function getMainServiceJob($mainCatId){
        $mainCats = Services::find($mainCatId);
        if($mainCats){
            $getJobs = Jobs::select("*")->where("service_id",$mainCats->id)->get();
            $getJobMain = [];
            foreach($getJobs as $j){
                $getJobMain[] = Helper::getJobDetails($j->id);
            }
            return $getJobMain;
        }
        else{
            return NULL;
        }
    }


    public static function getQuestionCatJob($mainCatId){
        $mainCats = Question::find($mainCatId);
        if($mainCats){
            $getJobs = Jobs::select("*")->where("q_id",$mainCats->id)->get();
            $getJobMain = [];
            foreach($getJobs as $j){
                $getJobMain[] = Helper::getJobDetails($j->id);
            }
            return $getJobMain;
        }
        else{
            return NULL;
        }
    }

    public static function getJobByMainService($mainCatId){
        $mainCats = Services::find($mainCatId);
        if($mainCats){
            $getJobs = Jobs::select("*")->where("service_id",$mainCats->id)->get();
            $getJobMain = [];
            foreach($getJobs as $j){
                $getJobMain[] = Helper::getJobDetails($j->id);
            }
            return $getJobMain;
        }
        else{
            return NULL;
        }
    }

    public static function getJobsListing(){
        $allJobs = Jobs::select("*")->where("status",0)->where("sp_id",NULL)->get();
        if(isset($allJobs[0])){
            foreach($allJobs as $sJob){
                $mainCat = Services::find($sJob->service_id);
                $sJob->service_name = (isset($mainCat)) ? $mainCat->name : NULL;
                $mainUser = Users::where('users.id',$sJob->user_id)->join('user_details as ud','users.id','ud.user_id')->first();
                $sJob->name = (isset($mainUser)) ? ucwords($mainUser->name) : NULL;
                // $sJob = Helper::getJobDetails($sJob->id);
                $sJob->images = Helper::getJobImages($sJob->id);
            }
            return $allJobs;
        }
        else{
            return NULL;
        }
    }

    public static function getSPJobsListing($sp_id){
        $allJobs = Jobs::select("*")->where("sp_id",$sp_id)->get();
        if(isset($allJobs[0])){
            foreach($allJobs as $sJob){
                $mainCat = Services::find($sJob->service_id);
                $sJob->service_name = (isset($mainCat)) ? $mainCat->name : NULL;
                $mainUser = Users::where('users.id',$sJob->user_id)->join('user_details as ud','users.id','ud.user_id')->first();
                $sJob->name = (isset($mainUser)) ? ucwords($mainUser->name) : NULL;
                $sJob->status_name = Helper::getJobStatusName($sJob->status);
                // $sJob = Helper::getJobDetails($sJob->id);
                $sJob->images = Helper::getJobImages($sJob->id);
            }
            return $allJobs;
        }
        else{
            return NULL;
        }
    }

    public static function checkPhoneDup($phonenumber){
        $dup1 = Users::select('*')->where('phone',$phonenumber)->first();
        if($dup1){
            return $dup1;
        }
        return NULL;
    }

    /* Account Type 2 - User, 3 - Service Provider
    *  So that only User's create account and SP, Not Admin Account
    */
    public static function checkAccountType($account_type){
        if($account_type == 2 || $account_type==3 || $account_type==4){
            return false;
        }
        else{
            return true;
        }
    }

    public static function checkEmailDup($email){
        $dup = Users::select('*')->where('email',$email)->first();
        if($dup){
            return $dup;
        }
        return NULL;
    }
    public static function getJobImages($job_id){
        $allImages = JobImages::select("*")->where("job_id",$job_id)->get();
        if(isset($allImages[0])){
            foreach($allImages as $sImage){
                if($sImage->image){
                    $sImage->image = URL::to("public/images/jobImages/".$sImage->image);
                }
            }
            return $allImages;
        }
        else{
            return NULL;
        }
    }

    public static function addJob($request){
        $newJob = new Jobs();
        $getMainCat = Question::select("*")->where('id',$request->q_id)->first();
        $main_cat = "";
        if($getMainCat){
            $getMainFields = Services::select("*")->where('id',$getMainCat->service_id)->first();
            $main_cat = (isset($getMainFields)) ? $getMainFields->id : NULL;
            $newJob->service_id = $main_cat;
            $newJob->q_id = (isset($getMainCat)) ? $getMainCat->id : NULL;
            $newJob->user_id = $request->user_id;
            $newJob->title = $request->title;
            $newJob->details = $request->details;
            $newJob->location = (isset($request->location)) ? $request->location : NULL;
            $newJob->latitude = (isset($request->latitude)) ? $request->latitude : NULL;
            $newJob->longitude = (isset($request->longitude)) ? $request->longitude : NULL;
            $newJob->urgent = (isset($request->urgent)) ? $request->urgent : NULL;
            $newJob->status = 0;
            $newJob->save();

            //Insert Values in Job Question Options (QOptions saving against Jobs)
            $getQOption = $request->q_o_id;
            $total_price = 0;
            foreach($getQOption as $q){
                $qPrice = QuestionOption::where("id",$q)->first();
                if($qPrice){
                    $qo = new JobQuestionOption();
                    $qo->job_id = $newJob->id;
                    $qo->q_option_id = $q;
                    $qo->save();

                    $total_price += $qPrice->total_price;
                }
            }
            
            $latJob = Jobs::find($newJob->id);
            $latJob->total_price = $total_price;
            $latJob->save();

            return $latJob;
        }
        else{
            return NULL;
        }
    }

    public static function addJobImages($request,$job_id){
        $files = $request->image;
        $array = [];
        if(isset($files)){
            foreach($files as $file){
                $filename = 'JobImages'.date("Ymd-hisa").rand(0,999).'.'.$file->getClientOriginalExtension();
                $destinationPath = "public/images/jobImages/".$filename;
                if (move_uploaded_file($file, $destinationPath)){
                    if (file_exists($destinationPath)){
                        $addImage = new JobImages();
                        $addImage->job_id = $job_id;
                        $addImage->image = $filename;
                        $addImage->status = 1;
                        $addImage->save();

                        $array[] = $addImage;
                    }
                }
            }
        }
        return $array;
    }
    public static function getAllCustomers(){
        $dup1 = Users::select('*')->where('role_id',2)->get();
        if($dup1){
            return $dup1;
        }
        return NULL;
    }
    public static function getAllProducts(){
        $dup1 = Product::select('*')->where('status',1)->get();
        if($dup1){
            return $dup1;
        }
        return NULL;
    }
}
