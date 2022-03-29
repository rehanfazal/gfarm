@extends('admin.master')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">{{ $mainCategory->name }} Sub Categories Stats</h4>
        <p class="card-category">{{ $mainCategory->name }} Sub Categories Listing</p>

        <a data-toggle="modal" data-target="#myAddSubCategoryQuestionModal" class="float-right" title="Add Main Categories">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
      </div>
      <div class="card-body table-responsive">
        @if(!isset($questions[0]))
        <div class="text-warning">
          No Sub Category Found!
        </div>
        @else
        <table class="table table-hover">
          <thead class="text-danger">
            <th>S.#</th>
            <th>Name</th>
            <!-- <th>Image</th> -->
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            @php $counter = 1; @endphp
            @foreach($questions as $sCats)
            <tr>
              <td>{{ $counter }}</td>
              <td>{{ $sCats->info_text }}</td>
              <td>
                @if($sCats->status == 0)
                {{ 'Deactive' }}
                @elseif($sCats->status == 1)
                {{ 'Active' }}
                @endif
              </td>
              <td>
                <a href="{{ route('admin-main-sub-question-option',['q_id'=>$sCats->id]) }}" class="" title="View Options">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>

                @if($sCats->status == 1)
                <a href="{{ route('admin-change-status',['cat_name'=>2,'cat_id'=>$sCats->id,'status'=>0]) }}" class="ac_deactivate_status" msg="Are you sure to deactivate this question?" title="Deactivate">
                  <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                </a> &nbsp;
                @elseif($sCats->status == 0)
                <a href="{{ route('admin-change-status',['cat_name'=>2,'cat_id'=>$sCats->id,'status'=>1]) }}" class="ac_deactivate_status" msg="Are you sure to activate this service question?" title="Activate">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </a> &nbsp;
                @endif

                    <a data-toggle="modal" data-target="#myEditModal{{ $sCats->id }}" class="" title="Edit Question">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a> &nbsp;
                    <div class="modal" id="myEditModal{{ $sCats->id }}" tabindex="-1" role="dialog">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <form action="{{ route('admin-add-service-question') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" value="{{ $sCats->id }}" name="id" hidden>
                            <div class="modal-header">
                              <h5 class="modal-title">Edit Question</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Select Main Service:</label>
                                <select name="service_id" class="form-control" id="service_id">
                                    @php $getMainCats = \App\Models\Helper::getMainServices();
                                        $mainCatId = $getMainCats[0]->id;
                                    @endphp
                                    @foreach($getMainCats as $mC)
                                        <option value="{{ $mC->id }}" @if(isset($sCats->service_id) && $mC->id == $sCats->service_id) {{ 'selected' }} @php $mainCatId= $mC->id; @endphp @endif>{{ $mC->name }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Option Text:</label>
                                <input type="text" class="form-control" placeholder="Enter Info Text" name="info_text" required value="{{ $sCats->info_text }}">
                              </div>
                              <div class="form-group">
                                <label>Question Text:</label>
                                <input type="text" class="form-control" placeholder="Enter Question" name="question" value="{{ $sCats->question }}">
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

                  <a href="{{ route('admin-delete-sub-category',['cat_name'=>2, 'cat_id'=>$sCats->id]) }}" class="delete_record" msg="Are you sure to delete this service question?" title="Delete">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
{{--                    <a data-toggle="modal" data-target="#myDeleteModal{{ $sCats->id }}" class="" title="Edit Main Categories">--}}
{{--                      <i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                    </a> &nbsp; --}}
{{--                    <div class="modal" id="myDeleteModal{{ $sCats->id }}" tabindex="-1" role="dialog">--}}
{{--                      <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <input type="text" value="{{ $sCats->id }}" name="id" hidden>--}}
{{--                            <div class="modal-header">--}}
{{--                              <h5 class="modal-title">Delete Service Question</h5>--}}
{{--                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <i class="material-icons">clear</i>--}}
{{--                              </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                Are you sure you want to delete this service question?--}}
{{--                                <p class="text-danger">Note: All the question options under this service question would be deleted and this action is not reversible.</p>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                              <a href="{{ route('admin-delete-sub-category',['cat_name'=>2, 'cat_id'=>$sCats->id]) }}" class="btn btn-warning btn-round">Delete</a>--}}
{{--                              <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Cancel</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}



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
