

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Jobs</h4>
                <p class="card-category">View Job</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4><?php echo e($job->title); ?></h4>
                    </div>
                    <?php $spUserInfo = \App\Models\Helper::getUserInfo($job->sp_id); ?>
                    <div class="col-md-3">
                        <?php if($spUserInfo): ?>
                        
                        <img class="img" src="
                                        <?php if($spUserInfo->profile_image): ?>
                                            <?php echo e($spUserInfo->profile_image); ?>

                                        <?php else: ?>
                                            <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                                        <?php endif; ?>" width="50px" height="50px"><?php echo e(ucwords($spUserInfo->first_name." ".$spUserInfo->last_name)); ?>

                        <a class="" title="View Profile" data-toggle="modal" data-target="#spView<?php echo e($job->id); ?>">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a> &nbsp;
                        <div class="modal" id="spView<?php echo e($job->id); ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content card card-profile">
                                    <div class="card-avatar">
                                        <a href="javascript:;">
                                            <img class="img" src="
                                        <?php if($spUserInfo->profile_image): ?>
                                            <?php echo e(URL::to('public/images/'.$spUserInfo->profile_image)); ?>

                                        <?php else: ?>
                                            <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                                        <?php endif; ?>" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-category text-gray"><?php echo e($spUserInfo->role); ?></h6>
                                        <h4 class="card-title">
                                            <?php echo e(ucwords($spUserInfo->first_name." ".$spUserInfo->last_name)); ?>

                                        </h4>
                                        <hr>
                                        <div class="card-description row" style="color:black;">
                                            <div class="col-sm-12">
                                                Email: <?php echo e($spUserInfo->email); ?><br>
                                                Phone: <?php echo e($spUserInfo->phone); ?><br>
                                            </div>
                                            <div class="col-sm-12">
                                                Location: <?php echo e($spUserInfo->location); ?><br>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-round"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3">
                        Service: <?php echo e($job->getService->name); ?>

                    </div>
                    <div class="col-md-3">
                        Total Price: <?php echo e($job->total_price); ?>

                    </div>
                    <div class="col-md-3">
                        <?php $cUserInfo = \App\Models\Helper::getUserInfo($job->user_id); ?>
                        
                        <img class="img" src="
                                        <?php if($cUserInfo->profile_image): ?>
                                            
                                            <?php echo e($cUserInfo->profile_image); ?>

                                        <?php else: ?>
                                            <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                                        <?php endif; ?>" width="50px" height="50px">Customer: <?php echo e(ucwords($cUserInfo->first_name." ".$cUserInfo->last_name)); ?>


                        <a class="" title="View Profile" data-toggle="modal" data-target="#userView<?php echo e($job->id); ?>">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a> &nbsp;
                        <div class="modal" id="userView<?php echo e($job->id); ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content card card-profile">
                                    <div class="card-avatar">
                                        <a href="javascript:;">
                                            <img class="img" src="
                                        <?php if($cUserInfo->profile_image): ?>
                                            <?php echo e($cUserInfo->profile_image); ?>

                                        <?php else: ?>
                                            <?php echo e(URL::to('public/images/userImages/no-user.png')); ?>

                                        <?php endif; ?>" />
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-category text-gray"><?php echo e($cUserInfo->role); ?></h6>
                                        <h4 class="card-title">
                                            <?php echo e(ucwords($cUserInfo->first_name." ".$cUserInfo->last_name)); ?>

                                        </h4>
                                        <hr>
                                        <div class="card-description row" style="color:black;">
                                            <div class="col-sm-12">
                                                Email: <?php echo e($cUserInfo->email); ?><br>
                                                Phone: <?php echo e($cUserInfo->phone); ?><br>
                                            </div>
                                            <div class="col-sm-12">
                                                Location: <?php echo e($cUserInfo->location); ?><br>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-round"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12"><br><br>
                        Location: <?php echo e($job->location); ?>

                    </div>
                    <div class="col-md-12 table-responsive">

                        <table class="table table-hover">
                            <thead class="text-danger">
                                <th>Question</th>
                                <th>Question Options</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                    $jobQuestions = $job->getQuestion;
                                ?>
                                <?php $__currentLoopData = $jobQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $questions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td>
                                    <li><?php echo e($questions->getQuestion->question); ?></li><br>
                                    <!-- <label>Job Info Text:</label>
                                    <p class=""><?php echo e($questions->getQuestion->info_text); ?></p> -->
                                </td>
                                <td>
                                    <?php
                                        $jQoptions = $questions->getJobQuestionOptions($job->id,$questions->q_id);
                                    ?>
                                    <?php $__currentLoopData = $jQoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $jOptionDet = $qOption->getQuestionOption;
                                        ?>
                                        <li><?php echo e($jOptionDet->option_text); ?> - <?php echo e($jOptionDet->total_price); ?></li><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td></td></tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 row"><br><br>
                        <?php 
                            $images = $job->getJobImages;
                        ?>
                        <?php if($images->isNotEmpty()): ?>
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-3">
                                    <a href="<?php echo e(asset('images/jobImages/'.$img->image)); ?>" target="_blank">
                                        <img src="<?php echo e(asset('images/jobImages/'.$img->image)); ?>" class="" width="100%" height="100%" style="overflow:hidden">
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/goncocom/public_html/gfarm/resources/views/admin/viewjob.blade.php ENDPATH**/ ?>