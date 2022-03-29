<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\UserSession;
use App\Models\UserLogs;
use App\Models\Users;
use App\Models\TokenCode;
use App\Models\Helper;
use App\Models\Roles;
use App\Models\MainCategory;
use App\Models\SubCategory;

class CategoryController extends Controller
{
	public function getMainSubCategories(Request $request,$main_cat_id){
		if($request->IsMethod("get")){
			$mainCats = MainCategory::find($main_cat_id);
			if($mainCats){
				$mainCategory = $mainCats;
	        	$allCats = Helper::getSubCats($main_cat_id);
	        	if($allCats){
	            	return view('admin.subcategories',['categories' => $allCats,'mainCategory'=>$mainCategory,'page_name'=>'categories']);
	        	}
	        	else{
	            	return view('admin.subcategories',['categories' => NULL,'mainCategory'=>$mainCategory,'page_name'=>'categories']);
	        	}
			}
			else{
				Session::flash("error","Unable to fetch categories");

				return redirect()->back();
	        }
	    }
	}


    public function editMainCategories(Request $request){
        if($request->IsMethod("post")) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'category_name' => 'required'
            ]);
            if ($validator->fails()) {
                Session::flash("error","Fill the required fields!");
                return redirect()->back();
            }

            $updateThis = MainCategory::find($request->id);
            if($updateThis){
                $updateThis->category_name = $request->category_name;
                if($request->hasFile('image')){
                	unlink(URL::to("public/images/".$updateThis->image));
		            $file = $request->file('image');
		            $filename = 'category'.date("Ymd-his").'.'.$file->getClientOriginalExtension();
		            $destinationPath = "public/images/categoryImages/".$filename;
		            if (move_uploaded_file($_FILES['image']['tmp_name'],$destinationPath) && $data['image']){
		                if (file_exists($destinationPath)) {
		                    $updateThis->image = $filename;
		                }
		                else{
		                	Session::flash("error","Unable to update image!");
		                	return redirect()->back();
		                }
		            }
		        }
				else{
					$updateThis->image = NULL;
				}
		        $updateThis->save();
		        Session::flash("success","Category Edited Successfully!");
		        return redirect()->back();
            }
			else{
			    Session::flash("error","Unable to update category!");
			    return redirect()->back();
			}
        }
    }
}
