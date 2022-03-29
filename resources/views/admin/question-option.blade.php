@extends('admin.master')

@section('content')
<div class="row">

  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header card-header-danger">
        <h4 class="card-title">{{ $mainCategory->name }} Service</h4>
        <p class="card-category">{{ $question->info_text }}</p>
        <p class="card-category">{{ $question->question }}</p>

        <a data-toggle="modal" data-target="#myAddSubCategoryQOptionModal" class="float-right" title="Add Main Categories">
          <i class="fa fa-plus" aria-hidden="true"></i>
        </a>
      </div>
      <div class="card-body table-responsive">
        @if(!isset($questionOption[0]))
        <div class="text-warning">
          No Question Option Found!
        </div>
        @else
        <table class="table table-hover">
          <thead class="text-danger">
            <th>S.#</th>
            <th>Option Text</th>
            <!-- <th>Image</th> -->
            <th>Status</th>
            <th>Action</th>
          </thead>
          <tbody>
            @php $counter = 1; @endphp
            @foreach($questionOption as $sCats)
            <tr>
              <td>{{ $counter }}</td>
              <td>{{ $sCats->option_text }}</td>
              <!-- <td><img src="
                          @if($sCats->image)
                            {{ URL::to('public/images/'.$sCats->image) }}
                          @else
                            {{ URL::to('public/images/categoryImages/no-category.png') }}
                          @endif" class="img-raised rounded-circle img-fluid" width="50px" height="50px">
              </td> -->
              <td>
                @if($sCats->status == 0)
                {{ 'Deactive' }}
                @elseif($sCats->status == 1)
                {{ 'Active' }}
                @endif
              </td>
              <td>
                <a href="#"   data-id="{{$sCats->id}}"  class="getQuestionData">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
				 @if($sCats->status == 1)
                <a href="{{ route('admin-change-status',['cat_name'=>3,'cat_id'=>$sCats->id,'status'=>0]) }}" class="ac_deactivate_status" msg="Are you sure to deactivate this?" title="Deactivate">
                  <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                </a> &nbsp;
                @elseif($sCats->status == 0)
                <a href="{{ route('admin-change-status',['cat_name'=>3,'cat_id'=>$sCats->id,'status'=>1]) }}" class="ac_deactivate_status" msg="Are you sure to activate this?" title="Activate">
                  <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </a> &nbsp;
                @endif
				 <a href="#"   data-id="{{$sCats->id}}"  class="EditQuestionData">
                  <i class="fa fa-edit " aria-hidden="true"></i>
                </a>
                  <a href="{{ route('admin-delete-question',['option_id'=>$sCats->id]) }}" class="delete_record" msg="Are you sure to delete this?" title="Delete">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                  {{--                    <a data-toggle="modal" data-target="#myDeleteModal{{ $sCats->id }}" class="" title="Delete Question">--}}
{{--                      <i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                    </a> &nbsp; --}}
{{--                    <div class="modal" id="myDeleteModal{{ $sCats->id }}" tabindex="-1" role="dialog">--}}
{{--                      <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <input type="text" value="{{ $sCats->id }}" name="id" hidden>--}}
{{--                            <div class="modal-header">--}}
{{--                              <h5 class="modal-title">Delete Question Service</h5>--}}
{{--                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <i class="material-icons">clear</i>--}}
{{--                              </button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                Are you sure you want to delete this ?--}}
{{--                                <p class="text-danger">Note: All the question and options under this service would be deleted and this action is not reversible.</p>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                              <a href="{{ route('admin-delete-question',['option_id'=>$sCats->id]) }}" class="btn btn-warning btn-round">Delete</a>--}}
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
<!-- Sub Category show Question Add Modal -->
      <div class="modal" id="myAddSubCategorySOptionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="{{ route('admin-main-sub-question-option-submit',['service_id'=>(isset($mainCategory->id)) ? $mainCategory->id : 0]) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">Question Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="material-icons">clear</i>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label>Select Main Service:</label>
                    <select name="service_id" class="form-control" id="sservice_id" onchange="showQuestions()" required>
                        @php $getMainCats = \App\Models\Helper::getMainServices();
                             $mainCatId = $getMainCats[0]->id;
                        @endphp
                        @foreach($getMainCats as $mC)
                            <option value="{{ $mC->id }}" @if(isset($mainCategory->id) && $mC->id == $mainCategory->id) {{ 'selected' }}@endif>{{ $mC->name }}</option>
                        @endforeach
                    </select>
                   </div>

                  <div class="form-group">
                    <label>Select Question:</label>
                    <select name="q_id" class="form-control" id="sq_id" required>
                      @if(!isset($getSubCats[0]))
                        <option value="0">No Question Available</option>
                      @else
                        @php $questions = $getSubCats; @endphp
                        @include('admin.question-select',['questions'=>$questions])
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Option Text:</label>
                    <input type="text" class="form-control" placeholder="" id="soption_text" name="option_text" required>
                  </div>

                  <div class="form-group">
                    <label>Select Classification:</label>
                    <!-- <select name="q_id" class="form-control" id="classification_id" required> -->
                      @php $getClassification = \App\Models\Helper::getAllClassifications(); @endphp
                      @if(!isset($getClassification[0]))
                        <!-- <option value="0">No Classification Available</option> -->
                      @else
                        @foreach($getClassification as $c)
                          <label>{{ $c->name }}</label>
                          <input type="checkbox" name="classification_id[]" id="sclassification_id{{$c->id}}" value="{{ $c->id }}">
                          <!-- <option value="{{ $c->id }}">{{ $c->name}}</option> -->
                        @endforeach
                      @endif
                    <!-- </select> -->
                  </div>

                  <div class="form-group">
                    <label>Select Activity:</label>
                    <!-- <select name="q_id" class="form-control" id="activity_id" required> -->
                    @php $activities = \App\Models\Helper::getAllActivities(); @endphp
                      @if(!isset($activities[0]))
                        <option value="0">No Activity Available</option>
                      @else
                        @foreach($activities as $cb)
                          <label>{{ $cb->name }}</label>
                          <input type="checkbox" name="activities_id[]" id="sactivitie_id{{$cb->id}}"  value="{{ $cb->id }}">
                          <!-- <option value="{{ $cb->id }}">{{ $cb->name}}</option> -->
                        @endforeach
                      @endif
                    <!-- </select> -->
                  </div>
                  <div class="form-group">
                    <label>Time in HRS:</label>
                    <input type="number" min="0" required class="form-control" placeholder="" id="stime_in_hrs" name="time_in_hrs">
                  </div>
                  <div class="form-group">
                    <label>Base Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="sbase_price" name="base_price">
                  </div>
                  <div class="form-group">
                    <label>Retail Product:</label>
                    <input type="text" required class="form-control" placeholder="" id="sretail_product" name="retail_product">
                  </div>
                  <div class="form-group">
                    <label>Customer Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="scustomer_price" name="customer_price">
                  </div>
                  <div class="form-group">
                    <label>Product Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="sproduct_pricing" name="product_pricing">
                  </div>
                  <div class="form-group">
                    <label>Total Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="stotal_price" name="total_price">
                  </div>
              </div>

            </form>
          </div>
        </div>
      </div>
	  <!-- Sub Category Edit Question Add Modal -->
      <div class="modal" id="myEditubCategorySOptionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="{{ route('admin-main-sub-question-option',['service_id'=>(isset($mainCategory->id)) ? $mainCategory->id : 0]) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title">Edit Question Option</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="material-icons">clear</i>
                </button>
              </div>
              <div class="modal-body">
			  <input type="hidden" name="questionoption_id" id="equestionoption_id">
			  <input type="hidden" name="old_question_id" id="eold_question_id">
                  <div class="form-group">
                    <label>Select Main Service:</label>
                    <select name="service_id" class="form-control" id="eservice_id" onchange="getEditQuestions()" required>
                        @php $getMainCats = \App\Models\Helper::getMainServices();
                             $mainCatId = $getMainCats[0]->id;
                        @endphp
                        @foreach($getMainCats as $mC)
                            <option value="{{ $mC->id }}" @if(isset($mainCategory->id) && $mC->id == $mainCategory->id) {{ 'selected' }}@endif>{{ $mC->name }}</option>
                        @endforeach
                    </select>
                   </div>
                 <div class="form-group">
                    <label>Select Question:</label>
                    <select name="q_id" class="form-control" id="eq_id" required>
                      @if(!isset($getSubCats[0]))
                        <option value="0">No Question Available</option>
                      @else
                        @php $questions = $getSubCats; @endphp
                        @include('admin.question-select',['questions'=>$questions])
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Option Text:</label>
                    <input type="text" class="form-control" placeholder="" id="eoption_text" name="option_text" required>
                  </div>

                  <div class="form-group">
                    <label>Select Classification:</label>
                    <!-- <select name="q_id" class="form-control" id="classification_id" required> -->
                      @php $getClassification = \App\Models\Helper::getAllClassifications(); @endphp
                      @if(!isset($getClassification[0]))
                        <!-- <option value="0">No Classification Available</option> -->
                      @else
                        @foreach($getClassification as $c)
                          <label>{{ $c->name }}</label>
                          <input type="checkbox" name="classification_id[]" id="eclassification_id{{$c->id}}" value="{{ $c->id }}">
                          <!-- <option value="{{ $c->id }}">{{ $c->name}}</option> -->
                        @endforeach
                      @endif
                    <!-- </select> -->
                  </div>

                  <div class="form-group">
                    <label>Select Activity:</label>
                    <!-- <select name="q_id" class="form-control" id="activity_id" required> -->
                    @php $activities = \App\Models\Helper::getAllActivities(); @endphp
                      @if(!isset($activities[0]))
                        <option value="0">No Activity Available</option>
                      @else
                        @foreach($activities as $cb)
                          <label>{{ $cb->name }}</label>
                          <input type="checkbox" name="activities_id[]" id="eactivitie_id{{$cb->id}}"  value="{{ $cb->id }}">
                          <!-- <option value="{{ $cb->id }}">{{ $cb->name}}</option> -->
                        @endforeach
                      @endif
                    <!-- </select> -->
                  </div>
                  <div class="form-group">
                    <label>Time in HRS:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="etime_in_hrs" name="time_in_hrs">
                  </div>
                  <div class="form-group">
                    <label>Base Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="ebase_price" name="base_price">
                  </div>
                  <div class="form-group">
                    <label>Retail Product:</label>
                    <input type="text" required class="form-control" placeholder="" id="eretail_product" name="retail_product">
                  </div>
                  <div class="form-group">
                    <label>Customer Price:</label>
                    <input type="number" min="0" step="any" required class="form-control" placeholder="" id="ecustomer_price" name="customer_price">
                  </div>
                  <div class="form-group">
                    <label>Product Price:</label>
                    <input type="number" required min="0" step="any" class="form-control" placeholder="" id="eproduct_pricing" name="product_pricing">
                  </div>
                  <div class="form-group">
                    <label>Total Price:</label>
                    <input type="number" required min="0"step="any" class="form-control" placeholder="" id="etotal_price" name="total_price">
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



      <script>
	  $(document).on('click','.getQuestionData',function(e){
		  e.preventDefault();
		  showQuestions();
		  var question_id=$(this).data('id');
		  var data={'question_id':question_id};
		  $.ajax({
			  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
			  type:'POST',
			  dataType:'JSON',
			  data:data,
			  url:"{{route('admin-get-question-data')}}",
			  success:function(res){
				  if(res.status==200){
					   console.log($('#sservice_id').val());
					  var classification=res.classification;
					  console.log(classification);
					  var activities=res.activities;
					  for(var i=0; i<activities.length; i++){
						  var activitie_id=activities[i][0]['id'];
						  $('#sactivitie_id'+activitie_id).prop("checked", true);
					  }
					  for(var i=0; i<classification.length; i++){
						 var classification_id=classification[i][0]['id'];
								 $('#sclassification_id'+classification_id).prop("checked", true);
					  }

					//  $('#sservice_id').val(res.data.service_id);
					   $('[name=service_id] option').filter(function() {
        return ($(this).val() == res.data.service_id);
    }).prop('selected', true);
					   $('#sq_id').val(res.data.q_id);
					  $('#stime_in_hrs').val(res.data.time_in_hrs);
					  $('#sbase_price').val(res.data.base_price);
					  $('#soption_text').val(res.data.option_text);
					  $('#scustomer_price').val(res.data.customer_price);
					  $('#sretail_product').val(res.data.retail_product);
					  $('#sproduct_pricing').val(res.data.product_pricing);
					  $('#stotal_price').val(res.data.total_price);
					  $('#myAddSubCategorySOptionModal').modal('show');
				  }
			  }
		  });
	  })
	  $(document).on('click','.EditQuestionData',function(e){
		  e.preventDefault();
		  getEditQuestions();
		  var question_id=$(this).data('id');
		  var data={'question_id':question_id};
		  $.ajax({
			  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
			  type:'POST',
			  dataType:'JSON',
			  data:data,
			  url:"{{route('admin-get-question-data')}}",
			  success:function(res){

				  if(res.status==200){
					    console.log($('#eservice_id').val());
					  var classification=res.classification;
					  var activities=res.activities;
					  for(var i=0; i<activities.length; i++){
						  var activitie_id=activities[i][0]['id'];
						  $('#eactivitie_id'+activitie_id).prop("checked", true);
					  }
					  for(var i=0; i<classification.length; i++){
						 var classification_id=classification[i][0]['id'];
								 $('#eclassification_id'+classification_id).prop("checked", true);
					  }
					    //$('#eservice_id').val(res.data.service_id);
						$('[name=service_id] option').filter(function() {
							return ($(this).val() == res.data.service_id);
						}).prop('selected', true);
					  $('#equestionoption_id').val(res.data.id);
					  $('#eold_question_id').val(res.data.id);
					  $('#eq_id').val(res.data.q_id);

					  //$('#eq_id option[value='++']').prop('selected', true);
					  $('#etime_in_hrs').val(res.data.time_in_hrs);
					  $('#ebase_price').val(res.data.base_price);
					  $('#eoption_text').val(res.data.option_text);
					  $('#ecustomer_price').val(res.data.customer_price);
					  $('#eretail_product').val(res.data.retail_product);
					  $('#eproduct_pricing').val(res.data.product_pricing);
					  $('#etotal_price').val(res.data.total_price);
					  $('#myEditubCategorySOptionModal').modal('show');
				  }
			  }
		  });
	  })

	   function getEditQuestions() {
        var service_id = $('#eservice_id option:selected').val();
        console.log("Going to eidt");
        if($('#eservice_id option:selected').val() != 0){
          var sub_cat_id = $('#eservice_id option:selected').val();
            $.ajax({
                type: "POST",
                url: "{{ route('admin-get-question-cat')}}",
                data: { service_id:service_id, '_token': $('meta[name="csrf-token"]').attr('content') },
                success: function(data) {
                    $('#eq_id').html(data.html);
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
      function showQuestions() {
        var service_id = $('#sservice_id option:selected').val();
        console.log("Going to eidt");
        if($('#sservice_id option:selected').val() != 0){
          var sub_cat_id = $('#sservice_id option:selected').val();
            $.ajax({
                type: "POST",
                url: "{{ route('admin-get-question-cat')}}",
                data: { service_id:service_id, '_token': $('meta[name="csrf-token"]').attr('content') },
                success: function(data) {
                    $('#sq_id').html(data.html);
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
@endsection
