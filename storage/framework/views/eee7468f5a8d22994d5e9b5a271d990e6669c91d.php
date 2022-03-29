<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
  <a href="<?php echo e(route('admin-users')); ?>">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">supervisor_account</i>
        </div>
        <p class="card-category">Users</p>
        <h3 class="card-title"><?php echo e($userCount); ?>

          <small></small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-success">star_rate</i>
          In Total
        </div>
      </div>
    </div>
	</a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
  <a href="<?php echo e(route('admin-main-services')); ?>">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
            <i class="material-icons">home_repair_service</i>
        </div>
        <p class="card-category">Services</p>
        <h3 class="card-title"><?php echo e($mCatCount); ?></h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i>In Total
        </div>
      </div>
    </div>
	</a>
  </div>
  <!--<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">info_outline</i>
        </div>
        <p class="card-category">Fixed Issues</p>
        <h3 class="card-title">75</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">local_offer</i> Tracked from Github
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="fa fa-twitter"></i>
        </div>
        <p class="card-category">Followers</p>
        <h3 class="card-title">+245</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">update</i> Just Updated
        </div>
      </div>
    </div>
  </div>----->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\gfarm\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>