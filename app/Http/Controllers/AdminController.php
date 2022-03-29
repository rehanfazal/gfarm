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
use App\Models\Services;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\OrderItem;
use Input;
use App;
use PDF;


class AdminController extends Controller
{
	public function adminLogin(Request $request){
		if($request->IsMethod("get")){
			return view('login');
		}
	}
    public function adminLogout(Request $request){
    	Session::forget('user');
        Session::forget('email');
    	return redirect(route('admin-login'));
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
				// $checkError = mail($request->email,"Forgot Password",$msg);
                $checkError = true;
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

    public function dashboard(Request $request){
    	$users = Users::get();
    	$userCount = count($users);
    	$mainCats = NULL;//Services::get();
    	$mCatCount = 0;

    	return view('admin.dashboard',['userCount'=>$userCount,'mCatCount'=>$mCatCount,'page_name' => 'dashboard']);
    }

    public function listServices(Request $request){
    	if($request->IsMethod("get")){
	    	$allCats = Services::paginate(15);

	    	return view('admin.services',['services'=>$allCats,'page_name' => 'services']);
	    }
	    if($request->IsMethod("post")){
	    	$validator = Validator::make($request->all(), [
	            'service_name' => 'required'
	        ]);
	        if ($validator->fails()) {
				Session::flash("error","Fill the required fields!");
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!'])->withInput();
	        }

	        $newCat = new Services();
			if(isset($request->id)){
				$newCat = Services::find($request->id);
			}
	        $newCat->name = $request->service_name;
			$filename = NULL;

			if($request->hasFile("service_image")){
				$file = $request->file('service_image');
				$filename = 'serviceImages/category'.date("Ymd-his").'.'.$file->getClientOriginalExtension();
				$destinationPath = "public/images/".$filename;
				if (move_uploaded_file($_FILES['service_image']['tmp_name'],$destinationPath)){
					if (file_exists($destinationPath)) {
						$newCat->image = $filename;
					}
				}
			}

	        $newCat->save();

			if(isset($request->id)){
				Session::flash("success","Service has updated successfully!");
			}
			else{
				Session::flash("success","Service has added successfully!");
			}
	        return redirect(route('admin-main-services'));
	    }
    }

    public function listProducts(Request $request){
    	if($request->IsMethod("get")){
	    	$allCats = Product::where("status","!=",2)->paginate(15);
	    	return view('admin.products',['products'=>$allCats,'page_name' => 'products']);
	    }

	    if($request->IsMethod("post")){
	    	$validator = Validator::make($request->all(), [
	            'product_name' => 'required',
	            'category_id' => 'required',
	            'price' => 'required'
	        ]);
	        if ($validator->fails()) {
				Session::flash("error","Fill the required fields!");
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!'])->withInput();
	        }

	        $newCat = new Product();
			if(isset($request->id)){
				$newCat = Product::find($request->id);
				$newCat->description = (isset($request->description)) ? $request->description : $newCat->description;
				$newCat->stock = (isset($request->stock)) ? $request->stock : $newCat->stock;
				$newCat->discount_quantity = (isset($request->discount_quantity)) ? $request->discount_quantity : $newCat->discount_quantity;
				$newCat->discount_amount = (isset($request->discount_amount)) ? $request->discount_amount : $newCat->discount_amount;
				$newCat->price = (isset($request->price)) ? $request->price : $newCat->price;
			}

	        $newCat->product_name = $request->product_name;
	        $newCat->category_id = $request->category_id;
	        $newCat->description = $request->description;
			$newCat->stock = $request->stock;
			$newCat->discount_quantity = $request->discount_quantity;
			$newCat->discount_amount = $request->discount_amount;
			$newCat->price = $request->price;
		
	        $newCat->status = 1;
			$filename = NULL;

			if($request->hasFile("product_image")){
				$file = $request->file('product_image');
				$filename = 'productImages/product'.date("Ymd-his").'.'.$file->getClientOriginalExtension();
				$destinationPath = "public/images/".$filename;
				if (move_uploaded_file($_FILES['product_image']['tmp_name'],$destinationPath)){
					if (file_exists($destinationPath)) {
						$newCat->image = $filename;
					}
				}
			}

	        $newCat->save();

			if(isset($request->id)){
				Session::flash("success","Product has updated successfully!");
			}
			else{
				Session::flash("success","Product has added successfully!");
			}
	        return redirect(route('admin-main-services-product'));
	    }
    }

    public function listGalleryImages(Request $request){
    	if($request->IsMethod("get")){
	    	$allCats = Gallery::where("status","!=",2)->paginate(15);
	    	return view('admin.gallery',['gallery'=>$allCats,'page_name' => 'gallery']);
	    }

	    if($request->IsMethod("post")){
			
	        $newCat = new Gallery();
			if(isset($request->id)){
				$newCat = Gallery::find($request->id);
			}
			else{
				$newCat->status = 1;
			}

			$filename = NULL;

			if($request->hasFile("image")){
				$file = $request->file('image');
				$filename = 'serviceImages/category'.date("Ymd-his").'.'.$file->getClientOriginalExtension();
				$destinationPath = "public/images/".$filename;
				if (move_uploaded_file($_FILES['image']['tmp_name'],$destinationPath)){
					if (file_exists($destinationPath)) {
						$newCat->image = $filename;
					}
				}
			}

	        $newCat->save();

			if(isset($request->id)){
				Session::flash("success","Gallery Image has updated successfully!");
			}
			else{
				Session::flash("success","Gallery Image has added successfully!");
			}
	        return redirect(route('admin-gallery-images'));
	    }
    }

    public function deleteProduct(Request $request){
    	if($request->IsMethod("get")){
	    	$validator = Validator::make($request->all(), [
	            'product_id' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }

	        $up = Product::find($request->product_id);
	        if($up){
	        	//$findSub = VehicleSubCategory::where('parent_cat_id',$request->id)->delete();
	        	$up->status = 2;
	        	$up->save();
	        	//$up->delete();

	        	Session::flash("message","Product Deleted!");

	        	return redirect(route('admin-main-services-product'));
	        }
	        else{
	        	return redirect()->back()->withErrors(['error'=>'Unable to locate product!']);
	        }
	    }
    }
	
    public function deleteGalleryImage(Request $request){
    	if($request->IsMethod("get")){
	    	$validator = Validator::make($request->all(), [
	            'image_id' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }

	        $up = Gallery::find($request->image_id);
	        if($up){
	        	//$findSub = VehicleSubCategory::where('parent_cat_id',$request->id)->delete();
	        	$up->status = 2;
	        	$up->save();
	        	//$up->delete();

	        	Session::flash("message","Gallery Image Deleted!");

	        	return redirect(route('admin-gallery-images'));
	        }
	        else{
	        	return redirect()->back()->withErrors(['error'=>'Unable to locate gallery image!']);
	        }
	    }
    }
    public function editCategory(Request $request){
    	if($request->IsMethod("post")){
	    	$validator = Validator::make($request->all(), [
	            'id' => 'required',
	            'category_name' => 'required',
	            'fr' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }

	        $up = MainCategory::find($request->id);
	        if($up){
	        	$up->category_name = $request->category_name;
	        	$up->fr = $request->fr;
	        	$up->save();

	        	Session::flash("message","Category Name Updated!");
	        	return redirect(route('categories'));
	        }
	        else{
	        	return redirect()->back()->withErrors(['error'=>'Unable to locate category!']);
	        }
	    }
    }

    public function deleteCategory(Request $request){
    	if($request->IsMethod("post")){
	    	$validator = Validator::make($request->all(), [
	            'id' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }

	        $up = VehicleCategory::find($request->id);
	        if($up){
	        	//$findSub = VehicleSubCategory::where('parent_cat_id',$request->id)->delete();
	        	$up->status = 0;
	        	$up->save();
	        	//$up->delete();

	        	Session::flash("message","Category and its Sub Categories Deleted!");

	        	return redirect(route('categories'));
	        }
	        else{
	        	return redirect()->back()->withErrors(['error'=>'Unable to locate category!']);
	        }
	    }
    }

    public function mobilelogin(Request $request){
    	if($request->IsMethod("post")){
			$validator = Validator::make($request->all(), [
	            'email' => 'required',
	            'password' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }

	        $userCheck = Users::select('*')->where('email',$request->email)->first();

	        if ($userCheck){
                if (password_verify($request->password, $userCheck->password)) {
                	Session::put('user',$userCheck);
                	Session::put('email',$userCheck->email);
    	            return redirect(route('admin-dashboard'));
                }
                else{
            		return redirect()->back()->withErrors(['error' => 'Wrong email or password!']);
                }
	        }
	        else {
            	return redirect()->back()->withErrors(['error' => 'Wrong email or password!']);
	        }
    	}
    }

    public function getStatusChanged(Request $request){
    	if($request->IsMethod("get")){
			$getCat = isset($request->cat_name) ? $request->cat_name : "";
			$getCatId = isset($request->cat_id) ? $request->cat_id : '';
			$getStatus = isset($request->status) ? $request->status : '';
			if ($getCat == '' || $getCatId == '' || $getStatus == ''){
			    return redirect()->back()->with('error','Something Went Wrong!');
            }
			if($getCat == 1){
				$getCathere = Services::find($getCatId);
				if($getCathere){
					$getCathere->status = $getStatus;
					$getCathere->save();

					Session::flash("success","Main Service Status Updated!");
					return redirect()->back();
				}
			}
			if($getCat == 2){
				$getQhere = Product::find($getCatId);
				if($getQhere){
					$getQhere->status = $getStatus;
					$getQhere->save();

					Session::flash("success","Product Status Updated!");
					return redirect()->back();
				}
			}
			if($getCat == 3){
				$getCathere = Gallery::find($getCatId);
				if($getCathere){
					$getCathere->status = $getStatus;
					$getCathere->save();

					Session::flash("success","Gallery Image Status Updated!");
					return redirect()->back();
				}
			}
			Session::flash("error","Something Went Wrong!");
			return redirect()->back();
    	}
    }

    public function getCatDeleted(Request $request){
    	if($request->IsMethod("get")){
			$getCat = $request->cat_name;
			$getCatId = $request->cat_id;

			if(intval($getCat) == 1){
				echo "CAT ID: ".$getCatId."<br>";
				$getCathere = Services::find($getCatId);
				if($getCathere){
					// Delete Question
					Question::where('service_id',$getCatId)->delete();

					// Delete QuestionOption
					QuestionOption::where('service_id',$getCatId)->delete();
					$getCathere->delete();

					Session::flash("success","Main Service Deleted!");
					return redirect()->back();
				}
				$getCathere->delete();
				Session::flash("success","Main Service Deleted!");
				return redirect()->back();
			}
			if(intval($getCat) == 2){
				$getQhere = Question::find($getCatId);
				if($getQhere){
					// Delete QuestionOption
					$delQO = QuestionOption::where('q_id',$getQhere);
					$delQO->delete();

					$getQhere->delete();

					Session::flash("success","Question Deleted!");
					return redirect()->back();
				}
				Session::flash("error","Unable to find question!");
				return redirect()->back();
			}
			if(intval($getCat) == 3){
				$getCathere = QuestionOption::find($getCatId);
				if($getCathere){
					$getCathere->delete();

					Session::flash("success","Option Deleted!");
					return redirect()->back();
				}
				Session::flash("error","Unable to find option!");
				return redirect()->back();
			}
			Session::flash("error","Something Went Wrong!");
			return redirect()->back();
    	}
    }

	public function userSearch(Request $request){
    	if($request->IsMethod("post")){
	    	$users = Users::select("*")->where('users.role_id','!=',1)->where('username',"LIKE","%".$request->search."%")
                ->join('user_details as ud','users.id','ud.user_id')->paginate(15);
	    	if($users->IsNotEmpty()){
				foreach($users as $u){
					$u->name = ucwords($u->first_name." ".$u->last_name);
					$role = Roles::find($u->role_id);
					$u->role = ucwords($role->role_name);
				}
				$rolesAll = Roles::get();
				// Session::flash("error","This is the error");
				$html = view("admin.userajax")->with("users",$users)->with('roles',$rolesAll)->render();
				return response()->json(['success'=>1,'html'=>$html,'message'=>"Users Fetched!"]);
			}
			return response()->json(['success'=>0,'html'=>NULL,'message'=>"User not found!"]);
		}
	}
	
    public function userListing(Request $request){
    	if($request->IsMethod("get")){
	    	$users = Users::select("*")->where('users.role_id','!=',1)->where('users.status','!=',2)
                ->join('user_details as ud','users.id','ud.user_id')->paginate(15);
	    	foreach($users as $u){
	    		$u->name = ucwords($u->first_name." ".$u->last_name);
	    		$role = Roles::find($u->role_id);
	    		$u->role = ucwords($role->role_name);
	    	}
	    	$rolesAll = Roles::get();
	    	// Session::flash("error","This is the error");
		    return view('admin.users',['roles'=>$rolesAll,'users'=>$users,'page_name' => 'users']);
		}
		if($request->IsMethod("post")){
			$validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'role_id' => 'required',
                'email' => 'required',
                'password' => 'required',
                'confirm_password' => 'required'
	        ]);
	        if ($validator->fails()) {
				// dd($validator);
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }
	        if ($request->password != $request->confirm_password){
	            return redirect()->back()->withErrors(['error' => 'Password Do Not Match!']);
	        }

	    	$data = $request->all();

	        $hash = password_hash($request->password, PASSWORD_DEFAULT);

	    	$dup = Users::select('*')->where('email','=',$request->email)->first();
	    	if ($dup){
	            return redirect()->back()->withErrors(['error' => 'Email already exists!']);
	    	}

	    	$newUser = new Users();
	    	$newUser->email = $request->email;
	    	$newUser->password = $hash;
	    	$newUser->role_id = $request->role_id;//1 = Admin, 2= user, 3=admin side user to create orders
	    	$newUser->status = 1;
	    	$newUser->save();

			$newUserDetails = new UserDetails();
	    	$newUserDetails->user_id = $newUser->id;
	    	$newUserDetails->first_name = $request->first_name;
	    	$newUserDetails->last_name = $request->last_name;
	    	$newUserDetails->status = 1;
	    	$newUserDetails->save();

	    	Session::flash("message","User added/updated successfully!");
	        return redirect(route('admin-users'));
		}
    }

    public function userFeedbackListing(Request $request){
    	if($request->IsMethod("get")){
	    	$users = Feedback::orderBy("id","desc")->paginate(15);
	    	// Session::flash("error","This is the error");
		    return view('admin.feedback',['feedbacks'=>$users,'page_name' => 'feedback']);
		}
	}

    public function changePass(Request $request){
    	if($request->IsMethod("post")){
			$validator = Validator::make($request->all(), [
                'current_pass' => 'required',
                'password' => 'required',
                'confirm_password' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }
	        if ($request->password != $request->confirm_password){
	            return redirect()->back()->withErrors(['error' => 'Password Do Not Match!']);
	        }

	    	$data = $request->all();

	    	$dup = Users::select('*')->where('id',Session::get('user')->id)->first();
	    	if ($dup){
	    		if (password_verify($request->current_pass, $dup->password)){
		    		$hashe = password_hash($request->password, PASSWORD_DEFAULT);

			    	$dup->password = $hashe;
			    	$dup->save();

			    	Session::flash("message","Password change successfull!");

			        return redirect(route('users'));
		        }
	        	return redirect()->back()->withErrors(['error' => 'Current password is wrong!']);
	    	}
	        return redirect()->back()->withErrors(['error' => 'Unable to locate user!']);
		}
    }

    public function editUser(Request $request){
    	if($request->IsMethod("post")){
	    	$validator = Validator::make($request->all(), [
	            'id' => 'required',
                'role_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required'
	        ]);
	        if ($validator->fails()) {
	    		Session::flash("error","Fill the required fields!");
	            return redirect()->back()->withInput();
	        }

	        $userMain = Users::find($request->id);
	    	if($userMain){
	    		$userMain->role_id = $request->role_id;
	    		$userMain->save();

	    		$user = UserDetails::select("*")->where("user_id",$request->id)->first();
				if($user){
					$user->first_name = $request->first_name;
					$user->last_name = $request->last_name;
					$user->phone = $request->phone;
					$user->birthday = $request->birthday;
					$user->location = $request->location;
					$user->save();
				}
				else{
					$user = new UserDetails();
					$user->user_id = $request->id;
					$user->first_name = $request->first_name;
					$user->last_name = $request->last_name;
					$user->phone = $request->phone;
					$user->birthday = $request->birthday;
					$user->location = $request->location;
					$user->save();
				}

	    		Session::flash("success","User updated successfully!");
	    		return redirect(route('admin-users'));
	    	}
	    	else{
	    		Session::flash("error","Unable to locate user!");
	            return redirect()->back();
	    	}
	    }
    }
    public function userDelete(Request $request){
    	if($request->IsMethod("get")){
	    	$validator = Validator::make($request->all(), [
	            'id' => 'required'
	        ]);
	        if ($validator->fails()) {
	            return redirect()->back()->withErrors(['error' => 'Fill the required fields!']);
	        }
	    	$user = Users::find($request->id);
	    	if($user){
	    		// $user->delete();
	    		$user->status = 2;
	    		$user->save();
				// dd($user);
	    		Session::flash("message","User deleted successfully!");
	    		return redirect(route('admin-users'));
	    	}
	    	else{
	            return redirect()->back()->withErrors(['error' => 'Unable to locate user!']);
	    	}
	    }
    }

	public function makeReportOfOrder(Request $request){
		set_time_limit(500); // 
		$getJobs = Order::find($request->order_id);
		if($getJobs){
			$data['order'] = $getJobs;
			$data['page_name'] = "jobs";
	
			$pdf = App::make('dompdf.wrapper');
			@$pdf->loadView('admin.reports.receipt', $data)->setOptions(['defaultFont' => 'sans-serif','isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
			// return view('admin.reports.receipt', $data);
			return @$pdf->download('supplierOrder_.pdf');
		}
		Session::flash("message","Unable to create report!");
		return redirect(route('admin-jobs'));
	
	}

	public function createOrderFromAdmin(Request $request){
		if($request->IsMethod("post")){
			$validator = Validator::make($request->all(), [
	            'total_price' => 'required',
	            'first_name' => 'required',
	            'last_name' => 'required',
	            'product_id' => 'required',
	            'quantity' => 'required',
	            'discount' => 'required',
	            'price' => 'required'
	        ]);
	        if ($validator->fails()) {
				Session::flash("error","Fill the required fields!");
				return redirect()->back();
	        }

            $newJob = new Order();
            $newJob->user_id = $request->user_id;
            $newJob->total_price = $request->total_price;
            $newJob->first_name = $request->first_name;
            $newJob->last_name = $request->last_name;
            $newJob->description = $request->description;
            // $newJob->discount = $request->discount;
            $newJob->location = $request->location;
            $newJob->phone = $request->phone;
            $newJob->save();
            
            $product_ids = $request->product_id;
            $quantity = $request->quantity;
            $discount = $request->discount;
            $price = $request->price;
            foreach($product_ids as $key=>$item){
                $newItem = new OrderItem();
                $newItem->order_id = $newJob->id;
                $newItem->product_id = $item;
                $newItem->quantity = $quantity[$key];
                $newItem->discount_given = isset($discount[$key]) ? $discount[$key] : 0;
                $newItem->price = $price[$key];
                $newItem->save();

                $this->updateStockOfProduct($item,$quantity[$key]);
            }

			Session::flash("message","Order #".$newJob->id." has been added successfully!");
			return redirect(route('admin-jobs'));
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
}
