@extends('admin.master')

@section('content')
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
                @if(!isset($jobs[0]))
                    <div class="text-warning">
                      No Order Found!
                    </div>
                @else
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
                      @php $counter = 1; @endphp
                      @foreach($jobs as $sUser)
                      <tr>
                        <td>{{ $counter }}</td>
                        <td>
                            {{ ucwords($sUser->first_name." ".$sUser->last_name) }}
                        </td>
                        <td>{{ $sUser->description }}</td>
                        <td>{{ date("Y-m-d H:i:s",strtotime($sUser->created_at)) }}</td>
                        <td>{{ $sUser->getOrderStatus($sUser->status) }}</td>
                        <td>{{ $sUser->total_price }}</td>
                        <td>
                            <div class=" btn-group">
                                <a data-toggle="modal" data-target="#myEditModal{{ $sUser->id }}" class="btn btn-sm btn-info"
                                    title="View Order Items">
                                    View
                                    <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                </a> &nbsp;
                                @if($sUser->status == 1)
                                <a href="{{ route('admin-order-status',['order_id'=>$sUser->id,'status'=>2]) }}" class="btn btn-sm btn-primary"
                                    title="{{$sUser->getOrderStatus(2)}}">
                                    {{ $sUser->getOrderStatus(2) }}
                                </a> &nbsp;
                                @elseif($sUser->status == 2)
                                <a href="{{ route('admin-order-status',['order_id'=>$sUser->id,'status'=>3]) }}" class="btn btn-sm btn-primary"
                                    title="{{$sUser->getOrderStatus(3)}}">
                                    {{ $sUser->getOrderStatus(3) }}
                                </a> &nbsp;
                                @elseif($sUser->status == 3)
                                <a href="{{ route('admin-order-status',['order_id'=>$sUser->id,'status'=>4]) }}" class="btn btn-sm btn-primary"
                                    title="{{$sUser->getOrderStatus(4)}}">
                                    {{ $sUser->getOrderStatus(4) }}
                                </a> &nbsp;
                                @elseif($sUser->status == 4)
                                <a href="{{ route('admin-order-status',['order_id'=>$sUser->id,'status'=>5]) }}" class="btn btn-sm btn-primary"
                                    title="{{$sUser->getOrderStatus(5)}}">
                                    {{ $sUser->getOrderStatus(5) }}
                                </a> &nbsp;
                                @endif
                                @if(($sUser->status != 6) && ($sUser->status != 5))
                                <a href="{{ route('admin-order-status',['order_id'=>$sUser->id,'status'=>6]) }}" class="btn btn-sm btn-danger"
                                    title="{{$sUser->getOrderStatus(6)}}">
                                    {{ $sUser->getOrderStatus(6) }}
                                </a> &nbsp;
                                @endif

                                <a href="{{ route('admin-order-receipt',['order_id'=>$sUser->id]) }}" class="btn btn-sm btn-info"
                                    title="Order Receipt">
                                    Receipt
                                    <!-- <i class="fa fa-eye" aria-hidden="true"></i> -->
                                </a> &nbsp;
                            </div>
                            
                            <div class="modal" id="myEditModal{{ $sUser->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                            <input type="text" value="{{ $sUser->id }}" name="id" hidden>
                                            <div class="modal-header">
                                                <h5 class="modal-title">View Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @php 
                                                    $orderItems = $sUser->getOrderItems;
                                                @endphp
                                                @if(isset($orderItems[0]))
                                                
                                                <table class="table table-hover">
                                                    <thead class="text-danger">
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Discount %</th>
                                                    </thead>
                                                    <tbody>
                                                @foreach($orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->getProduct->product_name }}</td>
                                                    <td>{{  $item->quantity }}</td>
                                                    <td>{{ $item->discount_amount }}                                                    </td>
                                                </tr>
                                                @endforeach
                                                    </tbody>
                                                </table>
                                                @endif
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
                    @php $counter++; @endphp
                    @endforeach
                </tbody>
            </table>
            @if($jobs->links())
                {{ $jobs->links() }}
            @endif
            @endif
        </div>
    </div>
</div>
</div>
<script>
    var addMore = '<div class="row form-group"><div class="col-sm-3">';
    @php 
        $allProducts = \App\Models\Helper::getAllProducts();
    @endphp
    addMore += '<select name="product_id[]" onchange="productSelectedChange(this)" class="form-control product_id" required><option value="">Select Product:</option>';
    @foreach($allProducts as $pro)
    addMore += '<option value="{{ $pro->id }}" unit_price="{{ $pro->price }}">{{ ucwords($pro->product_name)}}</option>';
    @endforeach
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
@endsection
