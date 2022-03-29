    <?php switch($page_name):
    case ("services"): ?>:
    <!-- Main Category Add Modal -->
    <div class="modal" id="myAddMainServiceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="<?php echo e(route('admin-main-add-service')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
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
                  <input type="file" name="category_image"  accept="image/*" onchange="javascript:getUploadImageName(this,'outputhere');">

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-warning btn-round">Add</button>
                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
      $(document).ready(function(){
        getQuestions();
      });
      </script>
      <?php break; ?>
      
      <?php default: ?>:
      <script>console.log("No User Modal");</script>
      <?php endswitch; ?>

      <script>

      function getQuestions() {
        var service_id = $('#service_id option:selected').val();
        console.log("Going");
        if($('#service_id option:selected').val() != 0){
          var sub_cat_id = $('#service_id option:selected').val();
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('admin-get-question-cat')); ?>",
                data: { service_id:service_id, '_token': $('meta[name="csrf-token"]').attr('content') },
                success: function(data) {
                    $('#q_id').html(data.html);
                    console.log("Success Recieved");
                },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
        }
        else{
        }
        console.log("Nothing Happened");
      }
      </script>
<?php /**PATH E:\xampp\htdocs\gfarm\resources\views/admin/all-modals.blade.php ENDPATH**/ ?>