<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Gallery Stats</h4>
                <p class="card-category">Gallery Images</p>
                <a data-toggle="modal" data-target="#myAddGalleryModal" class="float-right" title="Add Gallery Image">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a> &nbsp;
            </div>
            <div class="card-body table-responsive">
                <?php if(!isset($gallery[0])): ?>
                <div class="text-warning">
                    No Gallery Image Found!
                </div>
                <?php else: ?>
                <table class="table table-hover">
                    <thead class="text-danger">
                        <th>S.#</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sCats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($counter); ?></td>
                            <td>
                                <a href="<?php if($sCats->image): ?>
                                    <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                <?php else: ?> 
                                    <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                <?php endif; ?>" target="_blank">
                                <img src="
                                <?php if($sCats->image): ?>
                                    <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                <?php else: ?> 
                                    <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="100px" height="100px"></a>
                            </td>
                            <td>
                                <?php if($sCats->status == 1): ?>
                                <?php echo e('Active'); ?>

                                <?php elseif($sCats->status == 0): ?>
                                <?php echo e("Deactive"); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($sCats->status == 1): ?>
                                <a href="<?php echo e(route('admin-change-status',['cat_name'=>3,'cat_id'=>$sCats->id,'status'=>0])); ?>"
                                    msg="Are you sure to deactivate this service?" title="Deactivate">
                                    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                </a>
                                &nbsp;
                                <?php elseif($sCats->status == 0): ?>
                                <a href="<?php echo e(route('admin-change-status',['cat_name'=>3,'cat_id'=>$sCats->id,'status'=>1])); ?>"
                                    msg="Are you sure to activate this service?" title="Activate">
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
                                            <form action="<?php echo e(route('admin-gallery-add-images')); ?>" method="post"
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
                                                    <label>Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        accept="image/*"
                                                        onchange="javascript:getUploadImageName(this,'outputhere');">
                                                    <div class="form-group">
                                                        <img src="<?php if($sCats->image): ?>
                                                            <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                                            <?php else: ?> 
                                                            <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                                            <?php endif; ?>" class="img-raised rounded-circle img-fluid"
                                                            width="100px" height="100px">
                                                    </div>
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
                                                <h5 class="modal-title">Delete Gallery Image</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this image?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo e(route('admin-delete-gallery-image',['image_id'=>$sCats->id])); ?>"
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
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\gfarm\resources\views/admin/gallery.blade.php ENDPATH**/ ?>