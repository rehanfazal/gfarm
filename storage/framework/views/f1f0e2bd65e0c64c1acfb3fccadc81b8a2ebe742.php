

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">Orders</h4>
                <p class="card-category">All Orders</p>
                <a data-toggle="modal" data-target="#myAddOrderModal" class="float-right" title="Add Order">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a> &nbsp;
           </div>
            <div class="card-body table-responsive">
                <?php if(!isset($jobs[0])): ?>
                    <div class="text-warning">
                      No Order Found!
                    </div>
                <?php else: ?>
                <table class="table table-hover">
                    <thead class="text-danger">
                      <th>S.#</th>
                      <th>Customer Name</th>
                      <th>Description</th>
                      <th>Date Created</th>
                      <th>Status</th>
                      <th>Total Price</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php $counter = 1; ?>
                      <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($counter); ?></td>
                        <td>
                            <?php echo e(ucwords($sUser->first_name." ".$sUser->last_name)); ?>

                        </td>
                        <td><?php echo e($sUser->description); ?></td>
                        <td><?php echo e(date("Y-m-d H:i:s",strtotime($sUser->created_at))); ?></td>
                        <td><?php echo e($sUser->getOrderStatus($sUser->status)); ?></td>
                        <td><?php echo e($sUser->total_price); ?></td>
                        <td>
                            <div class=" btn-group">
                                <a data-toggle="modal" data-target="#myEditModal<?php echo e($sUser->id); ?>" class="btn btn-sm btn-info"
                                    title="View Order Items">
                                    View
                                    <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                </a> &nbsp;
                                <?php if($sUser->status == 1): ?>
                                <a href="<?php echo e(route('admin-order-status',['order_id'=>$sUser->id,'status'=>2])); ?>" class="btn btn-sm btn-primary"
                                    title="<?php echo e($sUser->getOrderStatus(2)); ?>">
                                    <?php echo e($sUser->getOrderStatus(2)); ?>

                                </a> &nbsp;
                                <?php elseif($sUser->status == 2): ?>
                                <a href="<?php echo e(route('admin-order-status',['order_id'=>$sUser->id,'status'=>3])); ?>" class="btn btn-sm btn-primary"
                                    title="<?php echo e($sUser->getOrderStatus(3)); ?>">
                                    <?php echo e($sUser->getOrderStatus(3)); ?>

                                </a> &nbsp;
                                <?php elseif($sUser->status == 3): ?>
                                <a href="<?php echo e(route('admin-order-status',['order_id'=>$sUser->id,'status'=>4])); ?>" class="btn btn-sm btn-primary"
                                    title="<?php echo e($sUser->getOrderStatus(4)); ?>">
                                    <?php echo e($sUser->getOrderStatus(4)); ?>

                                </a> &nbsp;
                                <?php elseif($sUser->status == 4): ?>
                                <a href="<?php echo e(route('admin-order-status',['order_id'=>$sUser->id,'status'=>5])); ?>" class="btn btn-sm btn-primary"
                                    title="<?php echo e($sUser->getOrderStatus(5)); ?>">
                                    <?php echo e($sUser->getOrderStatus(5)); ?>

                                </a> &nbsp;
                                <?php endif; ?>
                                <?php if(($sUser->status != 6) && ($sUser->status != 5)): ?>
                                <a href="<?php echo e(route('admin-order-status',['order_id'=>$sUser->id,'status'=>6])); ?>" class="btn btn-sm btn-danger"
                                    title="<?php echo e($sUser->getOrderStatus(6)); ?>">
                                    <?php echo e($sUser->getOrderStatus(6)); ?>

                                </a> &nbsp;
                                <?php endif; ?>

                                <a href="<?php echo e(route('admin-order-receipt',['order_id'=>$sUser->id])); ?>" class="btn btn-sm btn-info"
                                    title="Order Receipt">
                                    Receipt
                                    <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                </a> &nbsp;
                            </div>
                            
                            <div class="modal" id="myEditModal<?php echo e($sUser->id); ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                            <input type="text" value="<?php echo e($sUser->id); ?>" name="id" hidden>
                                            <div class="modal-header">
                                                <h5 class="modal-title">View Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php 
                                                    $orderItems = $sUser->getOrderItems;
                                                ?>
                                                <?php if(isset($orderItems[0])): ?>
                                                
                                                <table class="table table-hover">
                                                    <thead class="text-danger">
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Discount %</th>
                                                    </thead>
                                                    <tbody>
                                                <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($item->getProduct->product_name); ?></td>
                                                    <td><?php echo e($item->quantity); ?></td>
                                                    <td><?php echo e($item->discount_amount); ?>                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                                <?php endif; ?>
                                                <!-- <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-warning btn-round">Edit</button>
                                                    <button type="button" class="btn btn-danger btn-round"
                                                        data-dismiss="modal">Close</button>
                                                </div> -->
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $counter++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if($jobs->links()): ?>
                <?php echo e($jobs->links()); ?>

            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<script>
    var addMore = '<div class="row form-group"><div class="col-sm-3">';
    <?php 
        $allProducts = \App\Models\Helper::getAllProducts();
    ?>
    addMore += '<select name="product_id[]" onchange="productSelectedChange(this)" class="form-control product_id" required><option value="">Select Product:</option>';
    <?php $__currentLoopData = $allProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    addMore += '<option value="<?php echo e($pro->id); ?>" unit_price="<?php echo e($pro->price); ?>"><?php echo e(ucwords($pro->product_name)); ?></option>';
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    addMore += '</select></div><div class="col-sm-3">';
    addMore += '<input type="text" class="form-control quantity" placeholder="Add Quantity" name="quantity[]" required>';
    addMore += '</div>';
    addMore += '<div class="col-sm-3">';
    addMore += '<input type="text" class="form-control discount" placeholder="Add Discount" name="discount[]" >';
    addMore += '</div>';
    addMore += '<div class="col-sm-3">';
    addMore += '<input type="text" class="form-control price" placeholder="" name="price[]"  required>';
    addMore += '</div></div>';

$(document).ready(function(){
    $("#user_id").change(function(){
        console.log($("#user_id").prop("first_name"));
        $("input[name='first_name']").val($("#user_id").prop("first_name"));
        $("input[name='last_name']").val($("#user_id").prop("last_name"));
    });
    
    $("#addmore").click(function(){
        console.log("add called!");
        $("#productsList").append(addMore);
    });
    $("#removemore").click(function(){
        console.log("removed called!");
        $("#productsList").children().last().remove();
    });
});

function productSelectedChange(element){

}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/goncocom/public_html/gfarm/resources/views/admin/jobs.blade.php ENDPATH**/ ?>