@extends('admin.master')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header card-header-danger">
                <h4 class="card-title">User Accounts</h4>
                <p class="card-category">All Users</p>
                <a data-toggle="modal" data-target="#myAddUserModal" class="float-right" title="Add User">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a> &nbsp;
            </div>
            <div class="card-body table-responsive">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search...">
                </div><br>
                @if(!isset($users[0]))
                <div class="text-warning">
                    No User Found!
                </div>
                @else
                <div id="userAjax">
                    @include("admin.userajax")
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $("#search").keyup(function(event) {
      console.log("Key Up, Calling Ajax");
        var search = $("#search").val();

        $.ajax({
            url: "{{ route('admin-users-search') }}",
            type: "POST",
            data: {
              'search' : search,
              '_token' : "{{ csrf_token() }}"
            },
            cache: false,
            beforeSend: function() {
                $('#userAjax').html('<img src="" style="height: 100px;margin-left: 100px;">');
            },
            success: function(data) {
              if(data.success==1){
                $('#userAjax').html(data.html);
              }
              if(data.success==0){    
                // showNotificationModal('top','right',data.message,'danger','error');
                $('#userAjax').html(data.message);
              }

            }
        }); //end ajax
    });
});
</script>


@endsection