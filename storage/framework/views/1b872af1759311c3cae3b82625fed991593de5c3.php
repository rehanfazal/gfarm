

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Products Stats</h4>
                <p class="card-category">Products with Categories</p>
                <a data-toggle="modal" data-target="#myAddMainProductModal" class="float-right" title="Add Product">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a> &nbsp;
            </div>
            <div class="card-body table-responsive">
                <?php if(!isset($products[0])): ?>
                <div class="text-warning">
                    No Product Found!
                </div>
                <?php else: ?>
                <table class="table table-hover">
                    <thead class="text-danger">
                        <th>S.#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Stock Available</th>
                        <!-- <th>Image</th> -->
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sCats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($counter); ?></td>
                            <td><?php echo e($sCats->product_name); ?></td>
                            <td><?php echo e($sCats->getCategory->name); ?></td>
                            <td><?php echo e($sCats->stock); ?></td>
                            <!-- <td>
                                <img src="
                                <?php if($sCats->image): ?>
                                    <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                <?php else: ?> 
                                    <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="100px" height="100px">
                            </td> -->
                            <td>
                                <?php if($sCats->status == 1): ?>
                                <?php echo e('Active'); ?>

                                <?php elseif($sCats->status == 0): ?>
                                <?php echo e("Deactive"); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                            <?php if($sCats->status == 1): ?>
                            <a href="<?php echo e(route('admin-change-status',['cat_name'=>2,'cat_id'=>$sCats->id,'status'=>0])); ?>" msg="Are you sure to deactivate this service?" title="Deactivate">
                            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                            </a>
                                &nbsp;
                            <?php elseif($sCats->status == 0): ?>
                            <a href="<?php echo e(route('admin-change-status',['cat_name'=>2,'cat_id'=>$sCats->id,'status'=>1])); ?>" msg="Are you sure to activate this service?" title="Activate">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                            </a> &nbsp;
                            <?php endif; ?>
                                <a data-toggle="modal" data-target="#myEditModal<?php echo e($sCats->id); ?>" class=""
                                    title="Edit Main Categories">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a> &nbsp;
                                <div class="modal" id="myEditModal<?php echo e($sCats->id); ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="<?php echo e(route('admin-main-add-product')); ?>" method="post"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <input type="text" value="<?php echo e($sCats->id); ?>" name="id" hidden>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Product Name:</label>
                                                        <input type="text" class="form-control" placeholder=""
                                                            name="product_name" required
                                                            value="<?php echo e($sCats->product_name); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category:</label>
                                                        <select name="category_id" class="form-control"
                                                            id="category_id">
                                                            <?php $getMainCats = \App\Models\Helper::getMainServices();
                                                            $mainCatId = $getMainCats[0]->id;
                                                            ?>
                                                            <?php $__currentLoopData = $getMainCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($mC->id); ?>" <?php if(isset($sCats->category_id)
                                                                && $mC->id == $sCats->category_id): ?> <?php echo e('selected'); ?> <?php
                                                                $mainCatId= $mC->id; ?> <?php endif; ?>><?php echo e($mC->name); ?>

                                                            </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Product Description:</label>
                                                        <textarea placeholder="Enter Product Description" name="description" class="form-control"><?php echo e($sCats->description); ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No. Of Products In Stock:</label>
                                                        <input type="number" class="form-control" placeholder="" name="stock" value="<?php echo e($sCats->stock); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Discount Quantity (Discount applied when quantity equal to or above):</label>
                                                        <input type="number" class="form-control" placeholder="" name="discount_quantity" value="<?php echo e($sCats->discount_quantity); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Discount %:</label>
                                                        <input type="number" class="form-control" placeholder="" name="discount_amount" value="<?php echo e($sCats->discount_amount); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Price:</label>
                                                        <input type="number" class="form-control" placeholder="" name="price" value="<?php echo e($sCats->price); ?>" required>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" name="category_image"
                                                            onchange="javascript:getUploadImageName(this,'outputhere');">
                                                    </div>
                                                    <div class="form-group">
                                                        <img src="<?php if($sCats->image): ?>
                                                            <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                                            <?php else: ?> 
                                                            <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                                            <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="100px"
                                                            height="100px">
                                                    </div> -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-warning btn-round">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-round"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <a data-toggle="modal" data-target="#myDeleteModal<?php echo e($sCats->id); ?>" class=""
                                    title="Edit Main Categories">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a> &nbsp;
                                <div class="modal" id="myDeleteModal<?php echo e($sCats->id); ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <input type="text" value="<?php echo e($sCats->id); ?>" name="id" hidden>
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this product?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo e(route('admin-delete-product',['product_id'=>$sCats->id])); ?>"
                                                    class="btn btn-warning btn-round">Delete</a>
                                                <button type="button" class="btn btn-danger btn-round"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/goncocom/public_html/gfarm/resources/views/admin/products.blade.php ENDPATH**/ ?>