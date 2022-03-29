<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">Main Services</h4>
        <p class="card-category">Main Services Stats</p>
        <a data-toggle="modal" data-target="#myAddMainServiceModal" class="float-right" title="Add Main Categories">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a> &nbsp;
      </div>
      <div class="card-body table-responsive">
        <?php if(!isset($services[0])): ?>
          <div class="text-warning">
            No Service Found!
          </div>
        <?php else: ?>
          <table class="table table-hover">
            <thead class="text-danger">
              <th>S.#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $counter = 1; ?>
              <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sCats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($counter); ?></td>
                  <td><?php echo e($sCats->name); ?></td>
                  <td>
                    <img src="
                      <?php if($sCats->image): ?>
                        <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                      <?php else: ?>
                        <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                      <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="100px" height="100px">
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
                    <a href="<?php echo e(route('admin-change-status',['cat_name'=>1,'cat_id'=>$sCats->id,'status'=>0])); ?>" class="ac_deactivate_status" msg="Are you sure to deactivate this service?" title="Deactivate">
                      <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                    </a>
                          &nbsp;
                    <?php elseif($sCats->status == 0): ?>
                    <a href="<?php echo e(route('admin-change-status',['cat_name'=>1,'cat_id'=>$sCats->id,'status'=>1])); ?>" class="ac_deactivate_status" msg="Are you sure to activate this service?" title="Activate">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </a> &nbsp;
                    <?php endif; ?>
                    <a data-toggle="modal" data-target="#myEditModal<?php echo e($sCats->id); ?>" class="" title="Edit Main Categories">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a> &nbsp;
                    <div class="modal" id="myEditModal<?php echo e($sCats->id); ?>" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form action="<?php echo e(route('admin-main-add-service')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="text" value="<?php echo e($sCats->id); ?>" name="id" hidden>
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Main Service</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Name:</label>
                                  <input type="text" class="form-control" placeholder="Enter Service Name" name="service_name" value="<?php echo e($sCats->name); ?>" required>
                                </div>

                                <label>Image</label>
                                <input type="file" name="service_image" accept="image/*" onchange="javascript:getUploadImageName(this,'outputhere');">

                                <div class="form-group">
                                  <img src="<?php if($sCats->image): ?>
                                              <?php echo e(URL::to('public/images/'.$sCats->image)); ?>

                                            <?php else: ?>
                                              <?php echo e(URL::to('public/images/categoryImages/no-category.png')); ?>

                                            <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="100px" height="100px">
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-warning btn-round">Edit</button>
                              <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                      <a href="<?php echo e(route('admin-delete-sub-category',['cat_name'=>1,'cat_id'=>$sCats->id])); ?>" class="delete_record" msg="Are you sure to delete this service?" title="Delete">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                      </a> &nbsp;
                  </td>
                </tr>
              <?php $counter++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
              <?php echo e($services->links()); ?>

        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\gfarm\resources\views/admin/services.blade.php ENDPATH**/ ?>