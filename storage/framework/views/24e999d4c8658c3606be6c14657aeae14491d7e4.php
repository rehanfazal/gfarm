

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">User Feedbacks</h4>
        <p class="card-category">User Feedbacks Stats</p>
      </div>
      <div class="card-body table-responsive">
        <?php if(!isset($feedbacks[0])): ?>
          <div class="text-warning">
            No Feedback Found!
          </div>
        <?php else: ?>
          <table class="table table-hover">
            <thead class="text-danger">
              <th>S.#</th>
              <th>Name</th>
              <th>Feedback</th>
            </thead>
            <tbody>
              <?php $counter = 1; ?>
              <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($counter); ?></td>
                  <td><?php echo e($feedback->customer_name); ?></td>
                  <td>
                      <p class="text-wrap"><?php echo e($feedback->feedback); ?></p>
                  </td>
                </tr>
              <?php $counter++; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
              <?php echo e($feedbacks->links()); ?>

        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/goncocom/public_html/gfarm/resources/views/admin/feedback.blade.php ENDPATH**/ ?>