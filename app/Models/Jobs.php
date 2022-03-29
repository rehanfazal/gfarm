<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
	protected $table = "jobs";

	public function getQuestionOption(){
        return $this->belongsToMany(QuestionOption::class,'jobs_question_options','q_option_id','job_id');
	    // return $this->hasManyThrough(QuestionOption::class,JobQuestionOption::class,'q_option_id','job_id','id','job_id');
	}
	// protected function getQuestion(){
    //     return $this->hasOne(Question::class,'id','q_id');
	//     // return $this->hasManyThrough(QuestionOption::class,JobQuestionOption::class,'q_option_id','job_id','id','job_id');
	// }
	protected function getService(){
        return $this->hasOne(Services::class,'id','service_id');
	}
	protected function getQuestion(){
        return $this->hasMany(JobQuestion::class,'job_id','id');
	}
	protected function getUser(){
        return $this->hasOne(Users::class,'id','user_id');
	    // return $this->hasManyThrough(QuestionOption::class,JobQuestionOption::class,'q_option_id','job_id','id','job_id');
	}
	protected function getSP(){
        return $this->hasOne(Users::class,'id','sp_id');
	    // return $this->hasManyThrough(QuestionOption::class,JobQuestionOption::class,'q_option_id','job_id','id','job_id');
	}
	protected function getJobImages(){
		    return $this->hasMany(JobImages::class,'job_id','id');
		    // return $this->hasManyThrough(QuestionOption::class,JobQuestionOption::class,'q_option_id','job_id','id','job_id');
	}
}
