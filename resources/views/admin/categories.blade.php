@extends('admin.master')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">Main Categories Stats</h4>
        <p class="card-category">Main Categories with Sub-Categories</p>
        <a data-toggle="modal" data-target="#myAddMainCategoryModal" class="float-right" title="Add Main Categories">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a> &nbsp; 
      </div>
      <div class="card-body table-responsive">
        @if(!isset($categories[0]))
          <div class="text-warning">
            No Main Category Found!
          </div>
        @else
          <table class="table table-hover">
            <thead class="text-danger">
              <th>S.#</th>
              <th>Name</th>
              <th>Image</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>
              @php $counter = 1; @endphp
              @foreach($categories as $sCats)
                <tr>
                  <td>{{ $counter }}</td>
                  <td>{{ $sCats->category_name }}</td>
                  <td>
                    <img src="
                      @if($sCats->image)
                        {{ URL::to('public/images/'.$sCats->image) }}
                      @else 
                        {{ URL::to('public/images/categoryImages/no-category.png') }}
                      @endif" class="img-raised rounded-circle img-fluid" width="100px" height="100px">
                  </td>
                  <td>
                    @if($sCats->status == 1)
                      {{ 'Active' }}
                    @elseif($sCats->status == 0)
                      {{ "Deactive" }}
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin-main-sub-category',['main_cat_id'=>$sCats->id]) }}" class="" title="View Sub Categories">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a> &nbsp;
                     
                    @if($sCats->status == 1)
                    <a href="{{ route('admin-change-status',['cat_name'=>1,'cat_id'=>$sCats->id,'status'=>0]) }}" class="" title="Deactivate">
                      <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                    </a> &nbsp;
                    @elseif($sCats->status == 0)
                    <a href="{{ route('admin-change-status',['cat_name'=>1,'cat_id'=>$sCats->id,'status'=>1]) }}" class="" title="Activate">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </a> &nbsp;
                    @endif
                    <a data-toggle="modal" data-target="#myEditModal{{ $sCats->id }}" class="" title="Edit Main Categories">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a> &nbsp; 
                    <div class="modal" id="myEditModal{{ $sCats->id }}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form action="{{ route('admin-add-main-category') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="{{ $sCats->id }}" name="id" hidden>
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Main Category</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Category Name:</label>
                                  <input type="text" class="form-control" placeholder="Enter Category Name" name="category_name" value="{{ $sCats->category_name }}" required>
                                </div>
                                
                                <label>Image</label>
                                <input type="file" name="category_image" onchange="javascript:getUploadImageName(this,'outputhere');">
                                
                                <div class="form-group">
                                  <img src="@if($sCats->image)
                                              {{ URL::to('public/images/'.$sCats->image) }}
                                            @else 
                                              {{ URL::to('public/images/categoryImages/no-category.png') }}
                                            @endif" class="img-raised rounded-circle img-fluid" width="100px" height="100px">
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
                                        
                    <a data-toggle="modal" data-target="#myDeleteModal{{ $sCats->id }}" class="" title="Edit Main Categories">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a> &nbsp; 
                    <div class="modal" id="myDeleteModal{{ $sCats->id }}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <input type="text" value="{{ $sCats->id }}" name="id" hidden>
                            <div class="modal-header">
                              <h5 class="modal-title">Delete Main Category</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this main category?
                                <p class="text-danger">Note: All the sub-categories and options under this category would be deleted and this action is not reversible.</p>
                            </div>
                            <div class="modal-footer">
                              <a href="{{ route('admin-delete-sub-category',['cat_name'=>1,'cat_id'=>$sCats->id]) }}" class="btn btn-warning btn-round">Delete</a>
                              <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @php $counter++; @endphp
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection