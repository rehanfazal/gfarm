<?php if($message = Session::get('success')): ?>
    <!-- <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e($message); ?></strong>
    </div> -->
    <script>
        showNotificationModal('top','right','<?php echo e($message); ?>','success','check_circle');
    </script>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
    <!-- <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e($message); ?></strong>
    </div> -->
    <script>
        showNotificationModal('top','right','<?php echo e($message); ?>','danger','error');
    </script>
<?php endif; ?>


<?php if($message = Session::get('warning')): ?>
    <!-- <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e($message); ?></strong>
    </div> -->
    <script>
        showNotificationModal('top','right','<?php echo e($message); ?>','warning','error');
    </script>
<?php endif; ?>


<?php if($message = Session::get('info')): ?>
    <!-- <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo e($message); ?></strong>
    </div> -->
    <script>
        showNotificationModal('top','right','<?php echo e($message); ?>','info','error');
    </script>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php $errorList = ""; ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="padding: 5px;"><?php echo e($error); ?></li>
            <?php $errorList .= "<br>".$error;?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\gfarm\resources\views/pages/flash-message.blade.php ENDPATH**/ ?>