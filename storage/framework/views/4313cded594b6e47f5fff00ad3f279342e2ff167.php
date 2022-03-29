<table class="table table-hover">
    <thead class="text-danger">
        <th>S.#</th>
        <th>Name</th>
        <th>Image</th>
        <th>Location</th>
        <th>Role</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php $counter = 1; ?>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($counter); ?></td>
            <td><?php echo e($sUser->username); ?></td>
            <td><img src="<?php if($sUser->profile_image): ?><?php echo e(URL::to('public/images/userImages/'.$sUser->profile_image)); ?>

                        <?php else: ?>
                        <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                        <?php endif; ?>" class="img-raised rounded-circle img-fluid" width="50px" height="50px"></td>
            <td><?php echo e($sUser->location); ?></td>
            <td><?php echo e($sUser->role); ?></td>
            <td>
                <a href="<?php echo e(URL::to('admin/mainsubcategory/'.$sUser->id)); ?>" class="" title="View Profile"
                    data-toggle="modal" data-target="#myModal<?php echo e($sUser->id); ?>">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a> &nbsp;
                <div class="modal" id="myModal<?php echo e($sUser->id); ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content card card-profile">
                            <div class="card-avatar">
                                <a href="javascript:;">
                                    <img class="img" src="
                                      <?php if($sUser->profile_image): ?>
                                        <?php echo e(URL::to('public/images/userImages/'.$sUser->profile_image)); ?>

                                      <?php else: ?>
                                        <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                                      <?php endif; ?>" />
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray"><?php echo e($sUser->role); ?></h6>
                                <h4 class="card-title"><?php echo e($sUser->name); ?></h4>
                                <hr>
                                <div class="card-description row" style="color:black;">
                                    <div class="col-sm-6">
                                        Gender: <?php echo e($sUser->gender); ?><br>
                                        Birthday: <?php echo e($sUser->birthday); ?><br>
                                    </div>
                                    <div class="col-sm-6">
                                        Email: <?php echo e($sUser->email); ?><br>
                                        Phone: <?php echo e($sUser->phone); ?><br>
                                    </div>
                                    <div class="col-sm-12">
                                        Location: <?php echo e($sUser->location); ?><br>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-round"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(URL::to('admin/mainsubcategory/'.$sUser->id)); ?>" class="" title="Edit User"
                    data-toggle="modal" data-target="#myEditModal<?php echo e($sUser->id); ?>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a> &nbsp;
                <div class="modal" id="myEditModal<?php echo e($sUser->id); ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="<?php echo e(route('admin-edit-users')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="text" value="<?php echo e($sUser->id); ?>" name="id" hidden>
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="material-icons">clear</i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label>User Role:</label>
                                        <select class="form-control" name="role_id" required>
                                            <?php if(isset($roles)): ?>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($role->id); ?>" <?php if($sUser->role_id
                                                ==$role->id): ?>
                                                <?php echo e('selected'); ?><?php endif; ?>><?php echo e($role->role_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <option value="0">Select Role</option>
                                            <?php endif; ?>
                                    </div>
                                    <div class="form-group row">
                                        <input type="text" class="col-sm-6 form-control" placeholder="Enter First Name"
                                            name="first_name" value="<?php echo e($sUser->first_name); ?>" required>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Enter Last Name"
                                            value="<?php echo e($sUser->last_name); ?>" name="last_name" required>
                                    </div>
                                    <div class="form-group row">
                                        <input type="email" class="col-sm-6 form-control" placeholder="Email"
                                            name="email" value="<?php echo e($sUser->email); ?>" disabled>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Phone"
                                            value="<?php echo e($sUser->phone); ?>" name="phone" required>
                                    </div>
                                    <div class="form-group row">
                                        <input type="date" class="col-sm-6 form-control" placeholder="Birthday"
                                            value="<?php echo e($sUser->birthday); ?>" autocomplete="" name="birthday" required>
                                        <input type="text" class="col-sm-6 form-control" placeholder="Location"
                                            value="<?php echo e($sUser->location); ?>" autocomplete="" name="location" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning btn-round">Edit
                                        User</button>
                                    <button type="button" class="btn btn-danger btn-round"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="<?php echo e(URL::to('admin/mainsubcategory/'.$sUser->id)); ?>" class="delete_record"
                    msg="Are you sure to delete this user?" title="Delete User">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
        <?php $counter++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH E:\xampp\htdocs\gfarm\resources\views/admin/userajax.blade.php ENDPATH**/ ?>