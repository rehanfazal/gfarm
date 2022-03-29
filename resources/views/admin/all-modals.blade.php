<!-- Main Category Add Modal -->
<div class="modal" id="myAddMainServiceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin-main-add-service') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Main Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" placeholder="" name="service_name" required>
                    </div>
                    <label>Image</label>
                    <input type="file" name="category_image" accept="image/*"
                        onchange="javascript:getUploadImageName(this,'outputhere');">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-round">Add</button>
                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main Category Add Modal -->
<div class="modal" id="myAddMainProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin-main-add-product') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Product Name:</label>
                        <input type="text" class="form-control" placeholder="" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select name="category_id" class="form-control" id="category_id">
                            @php 
                                $getMainCats = \App\Models\Helper::getMainServices();
                            @endphp
                            @if(isset($getMainCats[0]))
                            @foreach($getMainCats as $mC)
                                <option value="{{ $mC->id }}" @if(isset($sCats->service_id) && $mC->id == $sCats->service_id) {{ 'selected' }} @endif>{{ $mC->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Product Description:</label>
                        <textarea placeholder="Enter Product Description" class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Of Products In Stock:</label>
                        <input type="number" class="form-control" placeholder="" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label>Discount Quantity (Discount applied when quantity equal to or above):</label>
                        <input type="number" class="form-control" placeholder="" name="discount_quantity" required>
                    </div>
                    <div class="form-group">
                        <label>Discount %:</label>
                        <input type="number" class="form-control" placeholder="" name="discount_amount" required>
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="number" class="form-control" placeholder="" name="price" required>
                    </div>
                        <label>Image</label>
                        <input type="file" name="product_image" accept="image/*" class="form-control"
                            onchange="javascript:getUploadImageName(this,'outputhere');">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-round">Add</button>
                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main Category Add Modal -->
<div class="modal" id="myAddGalleryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin-gallery-add-images') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Gallery Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                        <label>Add Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control"
                        onchange="javascript:getUploadImageName(this,'outputhere');">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-round">Add</button>
                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Main User Add Modal -->
<div class="modal" id="myAddUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin-users') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add User Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Account Type:</label>
                        <select name="role_id" class="form-control">
                            <option value="1">Admin</option>
                            <option value="3">Manager</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>First Name:</label>
                        <input type="text" class="form-control" placeholder="" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" placeholder="" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" placeholder="" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" placeholder="" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="" name="confirm_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-round">Add</button>
                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Main User Add Modal -->
<div class="modal" id="myAddOrderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('admin-add-order') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Customer:</label>
                        @php 
                            $allcustomer = \App\Models\Helper::getAllCustomers();
                        @endphp
                        <select name="user_id" class="form-control" id="user_id">
                            @foreach($allcustomer as $customer)
                            <option value="{{ $customer->id }}" first_name="{{ $customer->getUserDetails->first_name }}" last_name="{{ $customer->getUserDetails->last_name }}">{{ ucwords($customer->getUserDetails->first_name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Enter First Name:" name="first_name" required></div>
                        <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Enter Last Name:" name="last_name" required></div>
                    </div>
                    <div class="form-group" id="order_items">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4">
                                <button id="addmore" class="float-right" title="Add More Items In Order">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button> 
                                <button id="removemore" class="float-right" title="Remove Last Item In Order">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </button>  
                            </div>
                        </div>
                        <div class="row" id="productsList">
                            <div class="row form-group">
                                <div class="col-sm-3">
                                    @php 
                                        $allProducts = \App\Models\Helper::getAllProducts();
                                    @endphp
                                    <select name="product_id[]" class="form-control product_id" required>
                                        <option value="">Select Product:</option>
                                        @foreach($allProducts as $pro)
                                        <option value="{{ $pro->id }}">{{ ucwords($pro->product_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="Add Quantity" name="quantity[]" required>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="Add Discount" name="discount[]" >
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" placeholder="" name="price[]" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Enter Total Amount:" name="total_price" required></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning btn-round">Add Order</button>
                    <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
